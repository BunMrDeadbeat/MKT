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
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no debe exceder los 255 caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.string' => 'El campo correo electrónico debe ser una cadena de texto.',
            'email.lowercase' => 'El campo correo electrónico debe estar en minúsculas.',
            'email.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El campo correo electrónico no debe exceder los 255 caracteres.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'countryCode.required' => 'El código de país es obligatorio.',
            'countryCode.string' => 'El código de país debe ser una cadena de texto.',
            'countryCode.regex' => 'El formato del código de país no es válido. Ejemplo: +52',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.numeric' => 'El campo teléfono debe ser un número.',
            'telefono.digits' => 'El campo teléfono debe tener 10 dígitos.',
        ];
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'countryCode' => ['required', 'string', 'regex:/^\+[0-9]{1,4}$/'],
            'telefono' => ['required', 'numeric', 'digits:10'],
        ], $messages);
        if($request->countryCode != '+1') {
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
