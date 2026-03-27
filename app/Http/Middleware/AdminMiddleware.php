<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('user_role') !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos para acceder a esa sección.');
        }
        return $next($request);
    }
}
