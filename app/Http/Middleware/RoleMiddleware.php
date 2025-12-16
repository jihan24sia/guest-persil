<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(trim(Auth::user()->role));

        $roles = array_map(fn ($r) => strtolower(trim($r)), $roles);

        if (!in_array($userRole, $roles)) {
            abort(403, 'Role tidak diizinkan');
        }

        return $next($request);
    }
}
