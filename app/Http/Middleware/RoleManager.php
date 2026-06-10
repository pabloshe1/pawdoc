<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role !== $role) {
            return redirect('dashboard'); // Kalau bukan role-nya, tendang balik ke dashboard biasa
        }
        return $next($request);
    }
}
