<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika pengguna tidak login atau tidak memiliki peran yang diizinkan
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            // Arahkan ke halaman yang tidak diizinkan atau halaman utama
            abort(403, 'ANDA TIDAK MEMILIKI AKSES.');
        }

        // Jika peran sesuai, lanjutkan request
        return $next($request);
    }
}
