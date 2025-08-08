<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'big_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);
        try{
            
        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];

        if ($request->hasFile('main_picture')) {
            $path = $request->file('main_picture')->store('categories/images', 'public');
            $category->main_picture = $path;
        }

        if ($request->hasFile('big_picture')) {
            $path = $request->file('big_picture')->store('categories/images', 'public');
            $category->big_picture = $path;
        }

        $category->save();

        return redirect()->route('admin.categories');
        }catch (QueryException $e) {
            if ($e->getCode() === '23000' && str_contains($e->getMessage(), '1062')) {
                return redirect()->back()
                    ->with('error', 'El nombre de categoría ya está en uso. Por favor, elige otro.')
                    ->withInput();
            }
            return redirect()->back()
                ->with('error', 'Error de servidor: ' . $e->getMessage())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error de lado del servidor: ' . $e->getMessage());
        }
    }
    
     public function indexAdder()
    {   
        $categories= Category::with('products')->get();
        $showModal = false;
        $showadder = true;
        $editMode = false; 
        return view('adminCategories', compact('categories', 'showModal', 'showadder', 'editMode'));
    }
    
    public function index()
    {
        $categories = Category::with('products')->get();
        $showModal = false;
        $showadder = false;
        $editMode = false; 
        return view('adminCategories', compact('categories', 'showModal', 'showadder', 'editMode'));
    }

    public function indexProducts($id)
    {
        $categories = Category::with('products')->get();
        $prodcategory = Category::with('products')->findOrFail($id);
        $showModal = true;
        $showadder = false;
        $editMode = false; 
        return view('adminCategories', compact('categories', 'prodcategory', 'showModal', 'showadder', 'editMode'));
    }
    public function destroy(Category $category)
    {
        try{
        if ($category->main_picture != null) {
            Storage::disk('public')->delete($category->main_picture);
        }


        if ($category->big_picture != null) {
            Storage::disk('public')->delete($category->big_picture);
        }
        $category->delete();
        

        return redirect()->route('admin.categories')->with('success', 'Categoría eliminada correctamente.');
    }
    catch(QueryException $e){
        return redirect()->route('admin.categories')->with( 'error', 'No se pudo eliminar la categoría por conflicto de productos en ordenes, considere cambiar los productos de categoría.');
    }
    }
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'main_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'big_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);
        
        // Actualiza el nombre y descripción
        $category->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? '',
        ]);
        // Maneja las imágenes
        if ($request->hasFile('main_picture')) {
            if($category->main_picture!=null){
            Storage::disk('public')->delete($category->main_picture);
          }
            $category->main_picture = $request->file('main_picture')->store('categories/image', 'public');
        }

        if ($request->hasFile('big_picture')) {
            if($category->big_picture!=null){
            Storage::disk('public')->delete($category->big_picture);
          }
            $category->big_picture = $request->file('big_picture')->store('categories/big', 'public');
        }


        

        $category->save();

        return redirect()->route('admin.categories.editMode')->with('success', 'Categoría actualizada correctamente.');
    }
    
    public function indexEditMode()
    {
        $categories = Category::with('products')->get();
        $showModal = false;
        $showadder = false;
        $editMode = true; 
        return view('adminCategories', compact('categories', 'showModal', 'showadder', 'editMode'));
    }
}
