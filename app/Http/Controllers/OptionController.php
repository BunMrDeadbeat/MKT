<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::with('products')->paginate(15);
        $headerTitle = 'Opciones de Productos';
        $editMode = false;
        return view('adminOptions', compact('options', 'headerTitle', 'editMode'));
    }
    
    public function indexEditMode()
    {
        $options = Option::with('products')->paginate(15);
        $headerTitle = 'Editando Opciones';
        $editMode = true; 
        return view('adminOptions', compact('options', 'headerTitle', 'editMode'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:options,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        try {
            Option::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'is_active' => $request->has('is_active'),
            ]);
            return redirect()->route('admin.options')->with('success', 'Opción creada correctamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al crear la opción: ' . $e->getMessage())->withInput();
        }
    }


    public function update(Request $request, Option $option)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:options,name,' . $option->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        try {
            $option->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'is_active' => $request->has('is_active'),
            ]);
            return redirect()->route('admin.options.editMode')->with('success', 'Opción actualizada correctamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al actualizar la opción: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Option $option)
    {
        try {
            // La relación en la migración `product_option` con onDelete('cascade')
            // se encargará de eliminar las relaciones en la tabla pivote.
            $option->delete();
            return redirect()->route('admin.options')->with('success', 'Opción eliminada correctamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'No se puede eliminar la opción porque está asignada a uno o más productos.');
        }
    }
}