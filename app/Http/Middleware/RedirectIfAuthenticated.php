<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Redirect based on role
                if ($user->role === 'Admin') {
                    return redirect('/admin/dashboard');
                }

                if ($user->role === 'Customer') {
                    return redirect('/home');
                }
            }
        }

        return $next($request);
    }
}
