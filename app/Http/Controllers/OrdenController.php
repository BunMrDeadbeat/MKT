<?php

namespace App\Http\Controllers;

use App\Mail\FormatoOrden;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\CartProductOption;
use App\Models\Gallery;
use App\Models\Orden;
use App\Models\Product;
use DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OrdenController extends Controller
{
    // OrderController.php

    public function show($id)
    {
        $order = Orden::with(['user', 'product'])->findOrFail($id);

        // Parse personalization JSON
        $personalization = json_decode($order->opciones_personalizacion, true);

        return response()->json([
            'id' => $order->id,
            'user' => $order->user,
            'product' => $order->product,
            'producto_id' => $order->producto_id,
            'monto' => $order->monto,
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at,

            // Personalization fields
            'alto' => $personalization['alto'] ?? null,
            'ancho' => $personalization['ancho'] ?? null,
            'diametro' => $personalization['diametro'] ?? null,
            'tamano' => $personalization['tamano'] ?? null,
            'cara' => $personalization['cara'] ?? null,
            'cantidad' => $personalization['cantidad'] ?? 1,
        ]);
    }
    public function loadOrdersAdmin()
    {
        // Load orders with relationships to avoid N+1 queries
        $orders = Orden::with(['user', 'product'])->latest()->paginate(10);

        return view('adminOrders', compact('orders'));
    }
    public function storeLegacy(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->back()->with(['success' => false, 'message' => 'Necesita registrarse o ingresar para realizar ésta orden'], 401);
            }

            // Validate all the possible forma fildos (all nullable except 'producto_id')
            $validated = $request->validate([
                'alto' => 'nullable|numeric|min:1',
                'ancho' => 'nullable|numeric|min:1',
                'design' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB max 
                'cantidad' => 'nullable|integer|min:1',
                'tamano' => 'nullable|string',
                'diametro' => 'nullable|numeric|min:1',
                'cara' => 'nullable|string|in:una-cara,doble-cara',
                'tipo_vinilo' => 'nullable|string|in:cortado,impreso,microperforado',
                'detalles_extra' => 'nullable|string|max:5000',
                'idea' => 'nullable|string|max:5000',
                'design_choice' => 'nullable|string|in:professional,upload',
                'professional_design' => 'nullable|boolean',
                'producto_id' => 'required|exists:products,id', // Only required field
                'no_cotizacion' => 'sometimes|boolean', // Optional flag for option 11
            ]);

            // Handle file upload for 'design'
            if ($request->hasFile('design')) {
                $path = $request->file('design')->store('designs', 'public');
                $validated['design'] = $path; // Store file path instead of file object
            } else {
                $validated['design'] = null;
            }

            // Prepare customization options (exclude 'producto_id' and 'no_cotizacion')
            $customization = $validated;
            unset($customization['producto_id']);
            unset($customization['no_cotizacion']);

            // Create the order
            $orden = Orden::create([
                'user_id' => $user->id,
                'producto_id' => $validated['producto_id'],
                'opciones_personalizacion' => json_encode($customization),
                'monto' => null, // Replace with actual price calculation logic later
            ]);


            if ($request->has('no_cotizacion')) {
                // Redirect to payment processor with order ID
               // return redirect()->route('payment.process', ['orden_id' => $orden->id]);
            } else {
                // Send email to store with order details
                Mail::to($user->email)->send(new FormatoOrden($orden));
                // Optionally send a receipt to the user
                // Mail::to($user->email)->send(new ReceiptEmail($orden));
                return redirect()->back()->with('success', 'Orden creada exitosamente. Se ha enviado un mensaje a su correro. Procure revisar su sección de spam');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error de lado del servidor: ' . $e->getMessage());
        }
    }
    public function storeCart(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            if (!$user) {
                DB::rollBack();
                return redirect()->back()->with(['success' => false, 'message' => 'Necesita registrarse o ingresar para realizar ésta orden'], 401);
            }

            // Validate all the possible forma fildos (all nullable except 'producto_id')
            $validated = $request->validate([
                'alto' => 'nullable|numeric|min:1',
                'ancho' => 'nullable|numeric|min:1',
                'design' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB max 
                'cantidad' => 'nullable|integer|min:1',
                'tamano' => 'nullable|string',
                'diametro' => 'nullable|numeric|min:1',
                'cara' => 'nullable|string|in:una-cara,doble-cara',
                'tipo_vinilo' => 'nullable|string|in:cortado,impreso,microperforado',
                'color' => 'nullable|string|max:100',
                'detalles_extra' => 'nullable|string|max:5000',
                'idea' => 'nullable|string|max:5000',
                'design_choice' => 'nullable|string|in:professional,upload',
                'professional_design' => 'nullable|boolean',
                'producto_id' => 'required|exists:products,id', // Only required field
                'no_cotizacion' => 'sometimes|boolean', // Optional flag for option 11
            ],
            [
                'alto.numeric' => 'El alto debe ser un número válido.',
                'alto.min' => 'El alto debe ser al menos 1 metro.',
                'ancho.numeric' => 'El ancho debe ser un número válido.',
                'ancho.min' => 'El ancho debe ser al menos 1 metro.',
                'diametro.numeric' => 'El diámetro debe ser un número válido.',
                'diametro.min' => 'El diámetro debe ser al menos 1 centímetro.',
                'tamano.string' => 'El tamaño debe ser una cadena de texto.',
                'cantidad.integer' => 'La cantidad debe ser un número entero.',
                'cantidad.min' => 'La cantidad debe ser al menos 1.',
                'design.mimes' => 'El archivo de diseño debe ser un archivo de imagen valido.',
                'design.max' => 'El archivo de diseño no puede exceder los 10 MB.',
            ]);
            

            $producto = Product::findOrFail($validated['producto_id']);
            $cantidad = $validated['cantidad'] ?? 1;
            
            $carrito = Cart::firstOrCreate(['user_id' => $user->id, 'status' => 'activo']);

            $productoCarrito = CartProduct::create([
                'cart_id' => $carrito->id,
                'product_id' => $producto->id,
                'quantity' => $cantidad,
                'unit_price' => $producto->price??0,
            ]);


            $opciones = $validated;
            unset($opciones['producto_id']);
            unset($opciones['cantidad']);

            if ($request->hasFile('design')) { 
                $path = $request->file('design')->store('designs', 'public');
                $validated['design'] = $path; // Store file path instead of file object
                if($opciones['design']){
                $opciones['design'] = $path;
                }
                
            } else {
                $validated['design'] = null;
            }

            
            foreach ($opciones as $key => $value) {
                if (!is_null($value)) {
                    CartProductOption::create([
                        'cart_product_id' => $productoCarrito->id,
                        'option_name' => $key,
                        'option_value' => $value,
                    ]);
                }
            }

            $carrito->total_price += $producto->price * $cantidad;
            $carrito->save();

            

            DB::commit();

            return redirect()->back()->with('success', 'Se añadió al carrito con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Hay un problema: ' . $e->getMessage());
        }
        
        
    }
    public function crear(Request $request)
    {
        dd($request->all());
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuario no autenticado'], 401);
        }

        $data = $request->all();
        $opciones = json_encode($data); // Convertir datos a JSON

        $orden = Orden::create([
            'user_id' => $user->id,
            'producto_id' => $data['producto_id'],
            'opciones_personalizacion' => $opciones,
            'monto' => null, // Agrega lógica para calcular el monto si aplica
        ]);

        return response()->json(['success' => true, 'orden' => $orden]);
    }
    public function obtenerCantidadTotalProductos()
    {
        $user = Auth::user();
        $carrito = Cart::where('user_id', $user->id)->where('status', 'activo')->first();

        $totalCantidad = 0;
        if ($carrito) {
            // Asumiendo que la relación se llama 'productos' y tiene el campo 'cantidad'
            $totalCantidad = $carrito->productos->sum('cantidad');
        }
        // $totalCantidad ahora contiene la suma total de productos en el carrito del usuario
    }

    public function loadCart()
    {
        $user =auth()->user();
        $userId = $user->id;
        $carrito = Cart::where('user_id', $userId)
        ->with(['productos.producto.featuredImage'])
        ->first();
   

        if (!$carrito) {
            return response()->json(['success' => false, 'message' => 'Carrito no encontrado'], 404);
        }

        foreach ($carrito->productos as $producto) {
            // Decodificar las opciones JSON
            if($producto->producto->price!=null && $producto->unit_price != $producto->producto->price){
                $producto->unit_price = $producto->producto->price;
                $producto->save();
            }
            
        }
        return view('Carrito', [
            'cart' => $carrito,
            'cartItems' => $carrito->productos->load(['producto', 'opciones' ]),
        ]);
    }
    public function destroyCartProduct(CartProduct $cartProduct)
    {
        DB::beginTransaction();

        try{
            $designOption = $cartProduct->opciones()->where('option_name', 'design')->first();
            $designPath = $designOption ? $designOption->option_value : null;
            

            if ($designPath) {
                Storage::disk('public')->delete($designPath);
            }
            
            $cart = $cartProduct->cart;
            $cart->total_price -= $cartProduct->producto->price * $cartProduct->quantity;
            $cartProduct->delete();
            $cart->save();
            DB::commit();

            return response()->json([
            'success' => true,
            'message' => 'artículo eliminado del carrito con éxito.',
            'newCount' => $cart->countItems(), 
            'newSubtotal' => number_format($cart->total_price, 2)
            ]);
        }
        catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Hubo un problema al eliminar el artículo: ' . $e->getMessage(),
        ], 500); 
    }
    }

    public function update(Request $request, CartProduct $cartProduct)
    {
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $previousQuantity = $cartProduct->quantity;
        $cart = $cartProduct->cart;
        $cart->total_price -= $cartProduct->producto->price * $previousQuantity;

        $cartProduct->update([
            'quantity' => $validated['quantity']
        ]);

        $cart->total_price += $cartProduct->producto->price * $cartProduct->quantity;
        $cart->save();
        $cart->refresh();

        // Devuelve los nuevos totales para actualizar la interfaz
        return response()->json([
            'success' => true,
            'newCount' => $cart->countItems(),
            'newSubtotal' => number_format($cart->total_price, 2),
            'newItemPrice' => number_format($cartProduct->unit_price * $cartProduct->quantity, 2)
        ]);
    }
}
