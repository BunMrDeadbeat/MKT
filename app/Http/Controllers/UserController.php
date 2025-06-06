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
        $users = User::with('roles')->paginate(10);
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
}
