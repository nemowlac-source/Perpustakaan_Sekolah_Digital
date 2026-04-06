<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // --- MULAI PENGECEKAN CUSTOM ---
        $user = Auth::user();

        // Jika user adalah siswa dan belum aktif (is_active == 0)
        if ($user->isSiswa() && !$user->isActive()) {
            Auth::logout(); // Paksa keluar kembali

            // Hancurkan session agar benar-benar bersih
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Akun Anda belum dikonfirmasi oleh Admin. Silakan hubungi petugas perpustakaan.');
        }
        // --- SELESAI PENGECEKAN CUSTOM ---

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
