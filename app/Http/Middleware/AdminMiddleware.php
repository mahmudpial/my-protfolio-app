<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in at all
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Logged in but not the admin email
        if (auth()->user()->email !== config('admin.email')) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['email' => 'You are not authorised to access this area.']);
        }

        return $next($request);
    }
}