<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek dulu apakah ada pengguna yang login DAN apakah rolenya 'admin'.
        if (Auth::check() && Auth::user()->role == 'admin') {
            // 2. Jika iya, izinkan untuk melanjutkan ke halaman yang dituju.
            return $next($request);
        }

        // 3. Jika tidak, "tendang" kembali ke halaman utama.
        return redirect()->route('home');
    }
}