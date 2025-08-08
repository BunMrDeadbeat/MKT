<?php

namespace App\Http\Controllers;
use App\Mail\MassMessageMail;
use App\Models\AdministrativeNotificationRecipient;
use App\Models\Category;
use App\Models\LanderSection;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Mail;
use phpDocumentor\Reflection\Types\This;

class landingController extends Controller
{
    public function index()
    {
        $productIds = Product::query()
         ->whereHas('category', function ($query) {
            $query->where('name', 'Publicidad');
        })
        ->whereHas('galleries')
        ->pluck('id');
        $randomIds = collect($productIds)->shuffle()->take(8);
        $products = Product::whereIn('id', $randomIds)
            ->with('galleries')
            ->get();
        $sections = LanderSection::all()->where('is_active', 1);
        $path = public_path('storage/images/partners');

        if (!File::isDirectory($path)) {
            $partnerImages = [];
        } else {
            $files = File::files($path);
            $partnerImages = [];

            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])) {
                    $partnerImages[] = $file->getFilename();
                }
            } 
        }

        return view('homeLander',compact('products', 'sections', 'partnerImages'));
    }

    
     public function editSections()
    {
        $sections = LanderSection::all();
        return view('partials.admin.lander', compact('sections'));
    }
    public function updateSections(Request $request)
    {
        $request->validate([
            'sections' => 'nullable|array',
        ]);
        try {
            $activeSections = $request->input('sections', []);

            $allSections = LanderSection::all();

            foreach ($allSections as $section) {
                $section->is_active = in_array($section->name, $activeSections);
                $section->save();
            }

            return redirect()->back()->with('success', 'Secciones actualizadas correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al actualizar las secciones.');
        }
    }

    
    public function massMessageForm(Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'service' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $adminRecipients = AdministrativeNotificationRecipient::with('user')->get();
            foreach ($adminRecipients as $recipient) {
                if ($recipient->user && $recipient->user->email) {
                  Mail::to($recipient->user->email)->send(new MassMessageMail($validated));
            }
        }
        

        return redirect()->route('main')->with('success', '¡Mensaje enviado!.');
    } catch (\Exception $e) {
            return redirect()->route('main')->with('error', 'Hubo un error al enviar el mensaje. ' . $e->getMessage());
        }   
    }

    public function editPartners()
    {
        $path = public_path('storage/images/partners');
        if (!File::isDirectory($path)) {
            $partnerImages = [];
        } else {
            $files = File::files($path);
            $partnerImages = [];

            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])) {
                    $partnerImages[] = $file->getFilename();
                }
            } 
        }

        return view('partials.admin.featuredClients', compact('partnerImages'));
    }
    public function storePartner(Request $request)
    {
        $validated = request()->validate([
            'partner_images' => 'required',
            'partner_images.*' => 'image|mimes:jpg,jpeg,png,gif,svg,webp|max:10240', 
        ], [
            'partner_images.*.image' => 'Uno de los archivos no es una imagen válida.',
            'partner_images.*.mimes' => 'El formato del archivo no es permitido (solo jpg, png, gif, svg, webp).',
            'partner_images.*.max' => 'La imagen no debe superar los 10MB.',
        ]);

        if ($request->hasFile('partner_images')) {
            foreach ($request->file('partner_images') as $file) {
                $file->store('images/partners', 'public');
            }
        }

        return back()->with('success', '¡Imágenes subidas correctamente!');
    }
    public function destroyPartner($filename)
    {
        // Por seguridad, usamos basename para evitar ataques de tipo "directory traversal"
        $safeFilename = basename($filename);
        $filePath = 'images/partners/' . $safeFilename;

        // Verificamos si el archivo existe en el disco 'public' y lo eliminamos
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return back()->with('success', 'Imagen eliminada correctamente.');
        }

        return back()->with('error', 'La imagen no pudo ser encontrada.');
    }
}
