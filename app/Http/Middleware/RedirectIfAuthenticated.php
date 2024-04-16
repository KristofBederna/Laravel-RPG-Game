<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // If user is authenticated, redirect them to their dashboard or any other authenticated route
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
