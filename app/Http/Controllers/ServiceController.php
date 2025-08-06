<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $headerTitle = 'Servicios';
        $categorias = Category::all();

        $query = Product::with('category', 'options')->where('type', 'service');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $services = $query->latest()->paginate(15);
        return view('partials.admin.services', compact( 'categorias', 'services','headerTitle'));
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
        ]);

        $service = Product::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status'],
            'type' => 'service',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products/gallery', 'public');
            $service->galleries()->create(['image' => $imagePath, 'is_featured' => true]);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                $service->galleries()->create(['image' => $path, 'is_featured' => false]);
            }
        }
        
        if ($validated['price'] > 0) {
            $service->options()->syncWithoutDetaching([11]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Servicio creado exitosamente.');
    }

    public function update(Request $request, Product $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($service->id)],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'featured_gallery_id' => 'nullable|integer|exists:galleries,id,product_id,' . $service->id,
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
            'delete_gallery' => 'nullable|array',
            'delete_gallery.*' => 'integer|exists:galleries,id',
        ]);

        $service->update($validated);

        if (isset($validated['featured_gallery_id'])) {
            $service->galleries()->update(['is_featured' => false]);
            $service->galleries()->where('id', $validated['featured_gallery_id'])->update(['is_featured' => true]);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                $service->galleries()->create(['image' => $path, 'is_featured' => false]);
            }
        }

        if (!empty($validated['delete_gallery'])) {
            $galleries = $service->galleries()->whereIn('id', $validated['delete_gallery'])->get();
            foreach ($galleries as $gallery) {
                Storage::disk('public')->delete($gallery->image);
                $gallery->delete();
            }
        }

        if ($validated['price'] > 0) {
            $service->options()->syncWithoutDetaching([11]);
        } else {
            $service->options()->detach(11);
        }

        return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy(Product $service)
    {
        if ($service->type !== 'service') {
            return back()->with('error', 'La entidad seleccionada no es un servicio.');
        }
        $service->options()->detach();
        foreach ($service->galleries as $gallery) {
            Storage::disk('public')->delete($gallery->image);
        }
        $service->galleries()->delete();
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado exitosamente.');
    }
}
