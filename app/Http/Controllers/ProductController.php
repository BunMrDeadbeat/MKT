<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Option;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;


class ProductController extends Controller
{

     public function show($id) // Route model binding injects the Product instance
    {
        // Eager load relationships to avoid N+1 query problems
        $product = Product::findOrFail($id);
        $product->load(['category', 'galleries', 'options']);
        //dd($product->options);
        // Ensure product is active or user has permission to view
        if ($product->status !== 'active') {
            // You might want to show a specific page or a 404
            // For now, let's assume only active products are publicly viewable
            abort(404);
        }

        // Pass the product data to a Blade view
        return view('productDetail', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Producto o servicio eliminado satisfactoriamente 😀');
    }

    public function loadAddProducts()
    {
        $headerTitle = 'Productos';
        $editProduct = null;
        $options = Option::where('is_active', true)->get();
        $categorias = Category::all();
        $products = Product::with('options')->paginate(15);
        $showedit='hidden';
        return view('adminProducts', compact('options', 'categorias','editProduct', 'products','showedit','headerTitle'));
    }

    public function loadStore()
    {
        $categorias = Category::all();
        $productos = Product::with('options')->paginate(20);
        return view('store', compact( 'categorias', 'productos'));
    }
    public function filterByCategory($categoryId)
    {
        $productos = Product::where('category_id', $categoryId)->paginate(12);
        return view('partials.tienda.listaProductos', compact('productos'))->render();
    }
 
    public function loadEditProducts($id)
    {
        $products = Product::with('options')->paginate();
        $editProduct = Product::with(['category', 'galleries', 'options'])->findOrFail($id);
        //dd($product->options);
        $categorias = Category::all();
        $options = Option::where('is_active', true)->get();
        $showedit='';
        return view('adminProducts', compact('options', 'categorias', 'editProduct','showedit','products'));
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:product,service',
            'price' => 'nullable|numeric',
            'category' => 'required|integer|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:40960',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
            'selected_options' => 'nullable|array',
            'selected_options.*' => 'integer|exists:options,id',
        ]);

        try {
            $product = Product::create([
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'type' => $validated['type'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'category_id' => $validated['category'],
                'status' => $validated['status'],
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products/gallery', 'public');
                $product->galleries()->create(['image' => $imagePath, 'is_featured' => true]);
            }

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    $product->galleries()->create(['image' => $path, 'is_featured' => false]);
                }
            }

            if ($request->has('selected_options')) {
                foreach ($request->input('selected_options') as $optionId) {
                    $option = Option::find($optionId);
                    if ($option) {
                        $product->options()->attach($option->id, [
                            'required' => false, 
                            'values' => json_encode([]), 
                        ]);
                    }
                }
            }

            return redirect()->route('admin.products')->with('success', 'Producto Creado Correctamente!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000' && str_contains($e->getMessage(), '1062')) {
                return redirect()->back()
                    ->with('error', 'El slug ya está en uso. Por favor, elige otro.')
                    ->withInput();
            }
            return redirect()->back()
                ->with('error', 'Error de servidor: ' . $e->getMessage())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error de lado del servidor: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        
        $product = Product::findOrFail($id);

        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'featured_gallery_id' => 'nullable|integer|exists:galleries,id,product_id,' . $product->id,
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'type' => 'required|in:product,service',
            'price' => 'nullable|numeric',
            'category' => 'required|integer|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
            'delete_gallery.*' => 'nullable|integer',
            'selected_options' => 'nullable|array',
            'selected_options.*' => 'integer|exists:options,id',
        ]);

        try {
            $product->update([
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'type' => $validated['type'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'category_id' => $validated['category'],
                'status' => $validated['status'],
            ]);
             
           if (isset($validated['featured_gallery_id']) && $validated['featured_gallery_id'] != null) {
                $imageid=(int)$validated['featured_gallery_id'];
                $product->galleries()->update(['is_featured' => \DB::raw("CASE WHEN id = $imageid THEN 1 ELSE 0 END")]);
            }

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $path = $file->store('products/gallery', 'public');
                    $product->galleries()->create(['image' => $path, 'is_featured' => false]);
            }
            }
            $deleteGalleryIds = $request->input('delete_gallery', []);
            if (!empty($deleteGalleryIds)) {
                $galleries = $product->galleries()->whereIn('id', $deleteGalleryIds)->get();
                foreach ($galleries as $gallery) {
                    Storage::disk('public')->delete($gallery->image);
                }
                $product->galleries()->whereIn('id', $deleteGalleryIds)->delete();
            }
        
            $options = [];
            foreach ($request->input('selected_options', []) as $optionId) {
                $options[$optionId] = ['required' => false, 'values' => json_encode([])];
            }
            $product->options()->sync($options);
             return redirect()->route('admin.products')->with('success', 'Producto o servicio actualizado satisfactoriamente 😀');
        }
        catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error de lado del servidor: ' . $e->getMessage());
         }
    }
}
