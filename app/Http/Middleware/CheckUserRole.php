<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckUserRole
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated and has the required role
        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Redirect or return an error response
        abort(403, 'Unauthorized');
    }
}
