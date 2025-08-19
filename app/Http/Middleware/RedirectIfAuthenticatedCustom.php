<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedCustom
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->rule === 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/tampilUser');
            }
        }
        return $next($request);
    }
}