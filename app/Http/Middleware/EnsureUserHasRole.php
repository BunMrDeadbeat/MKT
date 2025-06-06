<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  The required role name (e.g., 'admin')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
          if (!Auth::check() ||!$request->user()->hasRole($role)) {
            return redirect('/')->with('error', 'No tienes acceso a ésta pagina, rufián.');
        }

         return $next($request);
    }
}
