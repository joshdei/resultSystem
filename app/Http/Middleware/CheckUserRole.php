<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated and has the correct role
        if (Auth::check()) {
            // If user type matches the role passed as parameter
            if (Auth::user()->user_type == $role) {
                return $next($request);
            }
        }

        // If not authorized, redirect or abort
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
