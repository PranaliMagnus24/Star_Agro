<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userRoles = $user->getRoleNames();

            if ($userRoles->isNotEmpty()) {
                return $next($request);
            }

            abort(403, "User  does not have the correct ROLE");
        }

        abort(401); // Unauthorized if not authenticated
    }
}
