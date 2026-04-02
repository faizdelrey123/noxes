<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StaffMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('staff.login');
        }

        if (!in_array(Auth::user()->role, ['admin','petugas'])) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}