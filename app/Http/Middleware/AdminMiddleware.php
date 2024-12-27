<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->is_role == 1) // Admin
            {
                return $next($request);
            } else {
                Auth::logout();
                return redirect('/')->with('error', 'Access denied.');
            }
        }

        return redirect('/')->with('error', 'Please login first.');
    }
}
