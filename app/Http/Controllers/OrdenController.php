<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->back()->with(['success' => false, 'message' => 'Usuario no autenticado'], 401);
            }

            // Validate all possible form fields (all nullable except 'producto_id')
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
                return redirect()->route('payment.process', ['orden_id' => $orden->id]);
            } else {
                // Send email to store with order details
                Mail::to('store@example.com')->send(new FormatoOrden($orden));
                // Optionally send a receipt to the user
                // Mail::to($user->email)->send(new ReceiptEmail($orden));
                return redirect()->back()->with('success', 'Orden creada exitosamente. Se ha enviado un correo de confirmación.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error de lado del servidor: ' . $e->getMessage());
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
}
