<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user || ! in_array($user->role_id, [1, 2])) {
            return redirect()->route('dashboard')->with('error', 'Hanya Admin yang boleh mengakses halaman ini.');
        }

        return $next($request);
    }
}
