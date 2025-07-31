<?php

namespace App\Http\Controllers;

use App\Mail\FormatoOrden;
use App\Mail\AdminOrderNotification;
use App\Models\AdministrativeNotificationRecipient;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\CartProductOption;
use App\Models\Gallery;
use App\Models\Orden;
use App\Models\OrdenProducto;
use App\Models\OrdenProductoOpcion;
use App\Models\Product;
use DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class OrdenController extends Controller
{
    // OrderController.php

  public function show($id)
{
    $orden = Orden::findOrFail($id);

      $orden->load([
        'user',
        'product.producto',
        'product.opciones' 
    ]);

    return view('adminOrders', compact('orden'));
}

    public function loadOrdersAdmin()
    {
        // Load orders with relationships to avoid N+1 queries
        $orders = Orden::with(['user'])->latest()->paginate(10);

        return view('adminOrders', compact('orders'));
    }

   
    public function storeCart(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            if (!$user) {
                DB::rollBack();
                return redirect()->back()->with(['success' => false, 'message' => 'Necesita <a href="' . route('register') . '" class="font-bold underline text-blue-600 hover:text-blue-800">registrarse</a> o <a href="' . route('login') . '" class="font-bold underline text-blue-600 hover:text-blue-800">ingresar</a> para realizar ésta orden'])->withInput();
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
            $optionFieldMap = [
            1 => ['alto', 'ancho'],
            2 => ['design_choice', 'idea'], // Y/o professional_design
            3 => ['design'],
            4 => ['cantidad'],
            5 => ['tipo_vinilo'],
            6 => ['diametro'],
            7 => ['tamano'],
            8 => ['color'],
            9 => ['cara'],
            10 => ['detalles_extra'],
        ];

            $producto = Product::findOrFail($validated['producto_id']);
            $prodOptions = $producto->options->sortBy('id');
            $cantidad = $validated['cantidad'] ?? 1;

            $designOptions = $prodOptions->whereIn('id', [2, 3]);
            if($designOptions->count() == 2){
                $prodOptions->where('id', 2)->first()->pivot->required = 0;
                $prodOptions->where('id', 3)->first()->pivot->required = 0;
            
                if($validated['design_choice'] == 'professional') {
                    if($validated['idea'] == null){
                        DB::rollBack();
                        return redirect()->back()->with('message', 'Si selecciona "Diseño Profesional", debe proporcionar una idea.')->withInput();
                    }
                }
                else if(!isset($validated['design'])|| $validated['design'] == null){
                    
                DB::rollBack();
                return redirect()->back()->with('message', 'No se ha subido un diseño.')->withInput();
                }
            }
            foreach ($prodOptions as $option) {
                if ($option->pivot->required==0) {
                    continue;
                }
                $fieldsForThisOption = $optionFieldMap[$option->id] ?? [];

                foreach ($fieldsForThisOption as $fieldName) {
                    if (!isset($validated[$fieldName]) || $validated[$fieldName] == null) {
                        DB::rollBack();
                            $errorMessage = match ($option->id) {
                                1 => 'Ingresar alto y ancho son obligatorios para este producto.',
                                2 => 'Debe descibir una idea de diseño para brindarle un servicio personalizado.',
                                3 => 'Debe subir un diseño para este producto.',
                                4 => 'La cantidad es obligatoria para este producto.',
                                5 => 'Debe seleccionar un tipo de vinilo para este producto.',
                                6 => 'El diámetro es obligatorio para este producto.',
                                7 => 'Debe seleccionar un tamaño para este producto.',
                                8 => 'Debe seleccionar un color para este producto.',
                                9 => 'Debe seleccionar si desea una impresión de una cara o doble cara.',
                                10 => 'Debe ingresar detalles para su solicitud.',
                                default => 'La opción "'.$option->name.'" es obligatoria para este producto.'
                            };
                        return redirect()->back()->with('message', $errorMessage)->withInput();

                    }
                }
            }
            
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

            return redirect()->back()->with('success', 'Se añadió al carrito con éxito.')->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Hay un problema: ' . $e->getMessage())->withInput();
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

    public function crearDesdeCarrito(Request $request)
    {
        $validated = $request->validate([
        'item_ids' => 'required|array',
        'item_ids.*' => 'integer|exists:carts_products,id',
        'payment_method' => 'required|string|in:transferencia,recolecta',
        'notification_methods' => 'required|array|min:1',
        'notification_methods.*' => 'string|in:email,whatsapp',
        ]);

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $cart = $user->cart;

            if (!$cart) {
                return response()->json(['success' => false, 'message' => 'No se encontró el carrito.'], 404);
            }

            $cartItems = CartProduct::with('opciones')
                ->where('cart_id', $cart->id)
                ->whereIn('id', $validated['item_ids'])
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'No se encontraron los artículos seleccionados en el carrito.'], 404);
            }

            $totalOrderPrice = 0;

            // Crear la orden principal
            $order = Orden::create([
                'user_id' => $user->id,
                'status' => 'pendiente', // O cualquier otro estado inicial
                'metodo_pago' => $validated['payment_method'],
            ]);

            foreach ($cartItems as $cartItem) {
                $totalOrderPrice += $cartItem->unit_price * $cartItem->quantity;
                // Crear el producto de la orden
                $orderProduct = OrdenProducto::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'cantidad' => $cartItem->quantity,
                    'precio_unitario' => $cartItem->unit_price,
                ]);

                // Copiar las opciones del carrito a la orden
                foreach ($cartItem->opciones as $cartOption) {
                    OrdenProductoOpcion::create([
                        'order_product_id' => $orderProduct->id,
                        'option_name' => $cartOption->option_name,
                        'option_value' => $cartOption->option_value,
                    ]);
                }

                
                // Eliminar el artículo del carrito
                $cartItem->delete();
            }

            // Actualizar el precio total del carrito
            $cart->total_price -= $totalOrderPrice;
            $cart->save();
            
            // Aquí puedes añadir la lógica para generar formatos, como enviar un correo de confirmación.
            $order->load('user', 'product.producto', 'product.opciones');
            DB::commit();

            if (in_array('email', $validated['notification_methods'])) {
                Mail::to($user->email)->send(new FormatoOrden($order));
            }
            if (in_array('whatsapp', $validated['notification_methods']) && $user->telefono) {
                $this->sendWhatsAppNotification($user->telefono, $order);
            }
            $adminRecipients = AdministrativeNotificationRecipient::with('user')->get();
            foreach ($adminRecipients as $recipient) {
                if ($recipient->user && $recipient->user->email) {
                    Mail::to($recipient->user->email)->send(new AdminOrderNotification($order, $user));
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Solicitud creada con éxito.',
                'order_id' => $order->id,
                'folio' => $order->folio,
            ]);


        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Ocurrió un error al procesar su solicitud.'], 500);
        }
    }
    private function sendWhatsAppNotification(string $recipientPhoneNumber, Orden $order)
    {
        Log::info('--- Attempting to send WhatsApp message ---');
        Log::info('Recipient Phone Number: '.$recipientPhoneNumber);

        $twilioSid = env('TWILIO_SID');
        $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppFrom = env('TWILIO_WHATSAPP_FROM');
        Log::info('Twilio SID from .env: ' . $twilioSid);
        Log::info('Twilio From Number from .env: ' . $twilioWhatsAppFrom);
        if (! $twilioSid || ! $twilioAuthToken || ! $twilioWhatsAppFrom) {
            Log::error('Twilio credentials are not set in the .env file or cache.');
            return; // Stop execution if credentials are not set
        }
        // Construct the message body
        $messageBody = "🎉 *¡Su confirmación de orden DuranMKT!* 🎉\n\n";
        $messageBody .= "¡Gracias por su preferencia!. Revisaremos su solicitud lo mas pronto posible.\n\n";
        $messageBody .= "Hola *{$order->user->name}*,\n";
        $messageBody .= "Su solicitud con número de folio *{$order->folio}* se ha ingresado a nuestro sistema y nos pondremos en contacto lo más pronto posible.\n\n";
        $messageBody .= "--- *Detalles de solicitud* ---\n";

        foreach ($order->product as $orderItem) {
            $productName = $orderItem->producto->name;
            $quantity = $orderItem->cantidad;
            $subtotal = ($orderItem->precio_unitario > 0 && !is_null($orderItem->precio_unitario) && optional($orderItem->opciones->where('option_name', 'no_cotizacion')->first())->option_value == '1')
                ? '$' . number_format($orderItem->precio_unitario * $orderItem->cantidad, 2)
                : 'Pendiente';

            $messageBody .= "🛍️ *Producto:* {$productName}\n";
            $messageBody .= "🔢 *Cantidad:* {$quantity}\n";
            $messageBody .= "💰 *Subtotal:* {$subtotal}\n\n";
        }
        $supportNumber = env('WHATSAPP_SUPPORT_NUMBER');
        $messageBody .= "Pronto nos pondremos en contacto con usted.\n\n";
        $messageBody .= "Si tiene preguntas o necesita realizar cambios, por favor envíe su mensaje a nuestro número de atención al cliente en WhatsApp: {$supportNumber}. ¡Estamos para ayudarle!\n";
        $messageBody .= "Por favor mencione su folio de orden: *{$order->folio}*";
        try {
            $twilio = new Client($twilioSid, $twilioAuthToken);
            $message = $twilio->messages->create(
                "whatsapp:{$recipientPhoneNumber}", // Recipient's phone number
                [
                    "from" => "whatsapp:{$twilioWhatsAppFrom}", // Your Twilio sandbox number
                    "body" => $messageBody,
                ]

            );
             Log::info('WhatsApp message sent successfully! SID: ' . $message->sid);
        } catch (\Exception $e) {
            // Log the error for debugging
             Log::error('!!! WhatsApp notification failed !!!');
        Log::error('Twilio Error: ' . $e->getMessage());
            Log::error('WhatsApp notification failed: ' . $e->getMessage());
        }
    }
     public function destroy(Orden $orden)
    {
        try {
            DB::beginTransaction();
            
            foreach ($orden->product as $producto) {
                $producto->opciones()->delete();
            }
            $orden->product()->delete();
            $orden->delete();
            
            DB::commit();

            return redirect()->route('admin.orders')->with('success', 'Orden eliminada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.orders')->with('error', 'Hubo un error al eliminar la orden: ' . $e->getMessage());
        }
    }
}
