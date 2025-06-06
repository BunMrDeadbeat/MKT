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
        // Validate input
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->back()->with(['success' => false, 'message' => 'Usuario no autenticado'], 401);
            }

            $validated = $request->validate([
                'alto' => 'nullable|numeric|min:1',
                'ancho' => 'nullable|numeric|min:1',
                'design' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
                'cantidad' => 'nullable|integer|min:1',
                'tamano' => 'nullable',
                'diametro' => 'nullable|numeric|min:1',
                'cara' => 'nullable',
                'producto_id' => 'required|exists:products,id', // Validate product exists
            ]);

            $orden = Orden::create([
                'user_id' => $user->id,
                'producto_id' => $validated['producto_id'], // ✅ Include this here
                'opciones_personalizacion' => json_encode($request->all()),
                'monto' => null, // Replace with actual calculation logic later
            ]);


            return redirect()->back()->with('success', 'Correo de recibo - Exito
            Correo de solicitud - Exito
            Payment Bypassed');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error de lado del servidor: ' . $e->getMessage());
        }
        // Handle file upload
        //$designPath = $request->file('design')->store('designs', 'public');

        // Create order logic here...

        // Redirect with success message
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
