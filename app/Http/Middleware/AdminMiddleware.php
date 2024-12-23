<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $user = Auth::user();

        // Avoid redirecting if already on the dashboard
        if ($user->user_type === 'admin' && $request->route()->getName() !== 'dashboard') {
            return redirect()->route('dashboard'); // Admin dashboard route
        }

        // Redirect non-admin users to the home page
        if ($user->user_type !== 'admin') {
            return redirect()->route('home'); // Redirect to homepage for non-admin
        }

        return $next($request); // Continue with the request if no redirection
    }
}
