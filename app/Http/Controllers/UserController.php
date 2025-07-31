<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    function loadUsers(Request $request){
        $headerTitle = 'Usuarios';
        // Añadido para la nueva funcionalidad de filtros y paginación
        $query = User::with('roles');

        // Filtro por nombre, email o teléfono
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('email', 'like', $searchTerm);
            });
        }

        // Filtro por rol
        if ($request->has('role_filter') && $request->role_filter != 'todos') {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role_filter);
            });
        }
        
        $users = $query->paginate(10);
        $roles = Role::pluck('name')->toArray();
        array_unshift($roles, 'Todos');

        $statuses = ['Todos', 'Activo', 'Inactivo', 'Suspendido'];
        $dateRanges = ['Todas', 'Hoy', 'Ultima semana', 'Ultimo mes'];

        $selectedStatus = $request->input('status_filter', 'todos');
        $selectedRole = $request->input('role_filter', 'todos');
        $selectedDateRange = $request->input('date_range_filter', 'todas');

        return view('adminUsers',compact('headerTitle', 'users',
            'statuses',
            'roles',
            'dateRanges',
            'selectedStatus',
            'selectedRole',
            'selectedDateRange'));
    }

   public function loadDashboard()
    {
        $user = Auth::user();
        $orders = Orden::where('user_id', $user->id)->latest()->paginate(10); 

        return view('userSettingsDashboard', compact('user', 'orders'));
    }
    

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        $user->roles()->sync($request->role);

        return back()->with('success', 'Rol de usuario actualizado correctamente.');
    }
    
    
    public function getUserDetails(User $user)
    {
        return response()->json($user->load('roles'));
    }

     public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'telefono' => ['nullable', 'string', 'max:20'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->save();

        return back()->with('success', '¡Perfil actualizado con éxito!');
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', '¡Contraseña actualizada con éxito!');
    }
    public function updateUserDetails(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
           
        ]);

        $user->update($validatedData);
        
        return back()->with('success', 'Datos del usuario actualizados.');
    }
    public function showOrder(Orden $order)
    {

        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $order->load('product.producto.galleries', 'product.opciones', 'user');

        return response()->json($order);
    }
}
