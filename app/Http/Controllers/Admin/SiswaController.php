<?php
// app/Http/Controllers/Admin/SiswaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $siswas = User::where('role', 'siswa')
            ->when($request->q, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->q}%")
                  ->orWhere('nis', 'like', "%{$request->q}%")
                  ->orWhere('username', 'like', "%{$request->q}%");
            })
            ->withCount(['loans', 'loans as aktif_count' => function ($q) {
                $q->where('status', 'dipinjam');
            }])
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:50|alpha_dash',
            'nis'      => 'required|string|unique:users|max:20',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'username.alpha_dash' => 'Username hanya boleh huruf, angka, dash, dan underscore.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'nis'      => $request->nis,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Akun siswa berhasil dibuat.');
    }

    public function show(User $siswa)
    {
        $siswa->load(['loans.book', 'favorites.book']);

        $stats = [
            'total_pinjam'  => $siswa->loans->count(),
            'aktif'         => $siswa->loans->where('status', 'dipinjam')->count(),
            'terlambat'     => $siswa->loans->where('status', 'terlambat')->count(),
            'total_denda'   => $siswa->loans->sum('fine'),
        ];

        return view('admin.siswa.show', compact('siswa', 'stats'));
    }

    public function edit(User $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, User $siswa)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:50|alpha_dash|unique:users,username,'.$siswa->id,
            'nis'      => 'required|string|max:20|unique:users,nis,'.$siswa->id,
            'email'    => 'required|email|unique:users,email,'.$siswa->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only(['name', 'username', 'nis', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(User $siswa)
    {
        // Cegah hapus jika masih ada pinjaman aktif
        if ($siswa->loans()->where('status', 'dipinjam')->exists()) {
            return back()->with('error', 'Siswa masih memiliki pinjaman aktif, tidak bisa dihapus.');
        }

        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Akun siswa berhasil dihapus.');
    }

    // Reset password ke default (NIS siswa)
    public function resetPassword(User $siswa)
    {
        $siswa->update(['password' => Hash::make($siswa->nis)]);

        return back()->with('success', "Password direset ke NIS: {$siswa->nis}");
    }
}
