<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class landingController extends Controller
{
    public function index()
    {
        $productIds = Product::whereHas('galleries')->where('name', strtolower('publicidad'))->pluck('id');
        $randomIds = collect($productIds)->shuffle()->take(12);
        $products = Product::whereIn('id', $randomIds)
            ->with('galleries')
            ->get();
        $sections = $this->getSections();

        return view('homeLander',compact('products', 'sections'));
    }

    public function getSections()
    {
        $filePath = storage_path('app/sections.json');

        if (!file_exists($filePath)) {//aquí la redundancia la hiciste para control de versiones.
             $defaultSections = [
                "productCards" => true,
                "impresion" => true,
                "puntosVenta" => true,
                "displayCursos" => true,
                "webDev" => true,
                "partners" => true,
                "experience" => true,
                "plans" => true,
                "gpadilla" => true
            ];
            Storage::put('sections.json', json_encode($defaultSections, JSON_PRETTY_PRINT));
        
        }


        $jsonContent = Storage::get('sections.json');
        $data = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            \Log::error('JSON invalido en sections.json: ' . json_last_error_msg());
            return [];
        }

        return $data;
    }
     public function editSections()
    {
        $sections = $this->getSections();
        return view('partials.admin.lander', compact('sections'));
    }
    public function updateSections(Request $request)
    {
        $updatedSections = [];
        $existingSections = $this->getSections(); // Get existing keys to ensure all are handled

        foreach ($existingSections as $key => $value) {
            $updatedSections[$key] = $request->has($key);
        }

        try {
            Storage::put('sections.json', json_encode($updatedSections, JSON_PRETTY_PRINT));
            return redirect()->back()->with('success', 'Secciones actualizadas correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al actualizar las secciones.');
        }
    }
    public function massMessageForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'service' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Aquí puedes manejar el envío del mensaje masivo
        // Por ejemplo, enviarlo a través de un servicio de correo

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }
}
