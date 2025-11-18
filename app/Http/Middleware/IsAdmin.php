<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // cek role
        if (!$request->user() || $request->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Anda bukan admin.');
        }

        return $next($request);
    }
}
