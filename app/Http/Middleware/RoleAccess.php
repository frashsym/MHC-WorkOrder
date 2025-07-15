<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAccess
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (! $user || ! in_array($user->role, $roles)) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
