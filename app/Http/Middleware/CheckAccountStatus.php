<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user login dan dia adalah siswa yang belum aktif
        if (auth()->check() && auth()->user()->role == 'siswa' && !auth()->user()->is_active) {

            // Jika dia mencoba buka halaman selain 'waiting-approval', paksa balik ke sana
            if (!$request->is('waiting-approval') && !$request->is('logout')) {
                return redirect()->route('waiting.approval');
            }
        }

        // Jika sudah aktif tapi malah mau buka 'waiting-approval', lempar ke dashboard
        if (auth()->check() && auth()->user()->is_active && $request->is('waiting-approval')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
