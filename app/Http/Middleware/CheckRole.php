<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/main');
        }

        $user = Auth::user();

        // Cek session ID
        if ($user->current_session_id !== session()->getId()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->withErrors(['session' => 'Sesi Anda telah digantikan di perangkat lain.']);
        }

        if ($user->rule === 'admin') {
            if (
                !$request->is('admin*') &&
                !$request->is('menuAdmin*') &&
                !$request->is('warungAdmin*') &&
                !$request->is('pesananAdmin*') &&
                !$request->is('invoice*') &&
                !$request->is('logout')
            ) {
                return redirect('/admin');
            }
        } elseif ($user->rule === 'user') {
            if (
                !$request->is('tampilUser*') &&
                !$request->is('warungUser*') &&
                !$request->is('kategoriUser*') &&
                !$request->is('keranjang*') &&
                !$request->is('pesanan*') &&
                !$request->is('invoice*') &&
                !$request->is('logout')
            ) {
                return redirect('/tampilUser');
            }
        } else {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('main');
        }

        return $next($request);
    }
}
