<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    function loadDashboard(Request $request){
        $user = Auth::user();
         if ($user) {
           
            $userName = $user->name;
            $userEmail = $user->email;
            
            return view('userSettingsDashboard', compact('user'));

        }else {
            return redirect()->route('login');
        }
    }
    
    // Nuevo: Actualizar rol de usuario
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        $user->roles()->sync($request->role);

        return back()->with('success', 'Rol de usuario actualizado correctamente.');
    }
    
    // Nuevo: Obtener detalles del usuario para el modal
    public function getUserDetails(User $user)
    {
        return response()->json($user->load('roles'));
    }

    // Nuevo: Actualizar detalles del usuario desde el modal
    public function updateUserDetails(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Agrega aquí más validaciones si es necesario
        ]);

        $user->update($validatedData);
        
        return back()->with('success', 'Datos del usuario actualizados.');
    }
}
