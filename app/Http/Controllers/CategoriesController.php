<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
        return view('adminCategories', compact('categories', 'showModal', 'showadder'));
    }
    
    public function index()
    {
        $categories = Category::with('products')->get();
        $showModal = false;
        $showadder = false;
        return view('adminCategories', compact('categories', 'showModal', 'showadder'));
    }

    public function indexProducts($id)
    {
        $categories = Category::with('products')->get();
        $prodcategory = Category::with('products')->findOrFail($id);
        $showModal = true;
        $showadder = false;
        return view('adminCategories', compact('categories', 'prodcategory', 'showModal', 'showadder'));
    }
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Categoría eliminada correctamente.');
    }

    
}
