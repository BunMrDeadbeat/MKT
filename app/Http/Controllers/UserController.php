<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Role;
use App\Models\User;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;

class UserController extends Controller
{
    // function loadUsers(Request $request){
    //     $headerTitle = 'Usuarios';
    //     $query = User::with('roles');

    //     if ($request->has('search') && $request->search != '') {
    //         $searchTerm = '%' . $request->search . '%';
    //         $query->where(function($q) use ($searchTerm) {
    //             $q->where('name', 'like', $searchTerm)
    //               ->orWhere('email', 'like', $searchTerm);
    //         });
    //     }

    //     if ($request->has('role_filter') && $request->role_filter != 'todos') {
    //         $query->whereHas('roles', function ($q) use ($request) {
    //             $q->where('name', $request->role_filter);
    //         });
    //     }
        
    //     $users = $query->paginate(10);
    //     $roles = Role::pluck('name')->toArray();
    //     array_unshift($roles, 'Todos');

    //     $statuses = ['Todos', 'Activo', 'Inactivo', 'Suspendido'];
    //     $dateRanges = ['Todas', 'Hoy', 'Ultima semana', 'Ultimo mes'];

    //     $selectedStatus = $request->input('status_filter', 'todos');
    //     $selectedRole = $request->input('role_filter', 'todos');
    //     $selectedDateRange = $request->input('date_range_filter', 'todas');

    //     return view('adminUsers',compact('headerTitle', 'users',
    //         'statuses',
    //         'roles',
    //         'dateRanges',
    //         'selectedStatus',
    //         'selectedRole',
    //         'selectedDateRange'
    //     ));
            
    // }

    
    function loadUsers(Request $request){
        $headerTitle = 'Usuarios';
        $query = User::with('roles');

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('email', 'like', 'searchTerm');
            });
        }

        if ($request->has('role_filter') && $request->role_filter != 'todos') {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role_filter);
            });
        }

        if ($request->has('active_session_only') && $request->active_session_only) {
            $query->whereHas('sessions');
        }

        $sortBy = $request->input('sort_by', 'default');
        switch ($sortBy) {
            case 'recent_session':
                $query->orderByDesc(
                    Session::select('last_activity')
                        ->whereColumn('sessions.user_id', 'users.id')
                        ->latest('last_activity')
                        ->limit(1)
                );
                break;
            
            case 'cart_products':
                $query->select('users.*') 
                      ->withCount(['cart as products_in_cart_count' => function ($query) {
                          $query->select(DB::raw('sum(carts_products.quantity)'))
                                ->join('carts_products', 'carts.id', '=', 'carts_products.cart_id');
                      }])
                      ->orderByDesc('products_in_cart_count');
                break;

            default:
                $query->latest();
                break;
        }

        $users = $query->paginate(10);
        
        $roles = Role::pluck('name')->toArray();
        array_unshift($roles, 'Todos');

        $sortOptions = [
            'default' => 'Usuarios más nuevos',
            'recent_session' => 'Sesión más reciente',
            'cart_products' => 'Más productos en carrito',
        ];

        $selectedRole = $request->input('role_filter', 'todos');
        $selectedSortBy = $request->input('sort_by', 'default');
        $showActiveOnly = $request->boolean('active_session_only');

        return view('adminUsers', compact(
            'headerTitle', 
            'users',
            'roles',
            'sortOptions',
            'selectedRole',
            'selectedSortBy', 
            'showActiveOnly'
        ));
    }

    public function getUserDetails(User $user)
    {
        $user->load('roles', 'cart.productos.producto', 'sessions');  
        return response()->json($user);
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

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return response()->json(['message' => 'No puedes eliminar tu propia cuenta.'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }
    public function updateFromModal(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefono' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8',
            'email_action' => 'nullable|string|in:verify,unverify'
        ]);

        $user->name = $validatedData['name'];
        $user->telefono = $validatedData['telefono'];

        if ($user->email !== $validatedData['email']) {
            $user->email = $validatedData['email'];
            $user->email_verified_at = now();
        }

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->has('email_action')) {
            if ($validatedData['email_action'] === 'verify') {
                $user->email_verified_at = now();
            } elseif ($validatedData['email_action'] === 'unverify') {
                $user->email_verified_at = null;
            }
        }
        
        $user->save();

        return response()->json(['success' => 'Usuario actualizado correctamente.']);
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'countryCode' => ['required', 'string', 'regex:/^\+[0-9]{1,4}$/'],
            'telefono' => 'required|string|regex:/^\d{10}$/',
        ]);
        if($request->countryCode != '+1') {
            $request->countryCode = $request->countryCode . '1'; 
        }
        if($request->email !== $user->email) {
            $user->email_verified_at = null;
            $user->email = $request->email;
        }
        if($user->name !== $request->name) {
            $user->name = $request->name;
        }
        if($user->telefono !== $request->countryCode . $request->telefono) {
            $user->telefono = $request->countryCode . $request->telefono;
        }
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
