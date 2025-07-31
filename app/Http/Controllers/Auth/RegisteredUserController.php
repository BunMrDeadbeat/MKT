<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'countryCode' => ['required', 'string', 'regex:/^\+[0-9]{1,4}$/'],
            'telefono' => ['required', 'numeric', 'digits:10'],
        ]);
        if($request->countryCode === '+1') {
            $request->countryCode = $request->countryCode . '1'; 
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->countryCode . $request->telefono,
            'password' => Hash::make($request->password),

        ]);
        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $user->roles()->attach($userRole->id);
        }
        event(new Registered($user));

        Auth::login($user);

        return to_route('dashboard');
    }
}
