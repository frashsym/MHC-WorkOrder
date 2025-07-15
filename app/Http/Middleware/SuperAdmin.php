<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user || $user->role_id !== 1) {
            return redirect()->route('dashboard')->with('error', 'Hanya Super Admin yang boleh mengakses halaman ini.');
        }

        return $next($request);
    }
}
