<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        // Mengambil data pinjaman milik user yang sedang login saja
        // Eager loading 'book' untuk efisiensi query (N+1 problem)
        $loans = Loan::with('book')
            ->where('user_id', Auth::id())
            ->latest() // Urutkan dari yang terbaru
            ->paginate(10);

        return view('siswa.loans.index', compact('loans'));
    }

    // Opsi: Jika ingin melihat detail pinjaman tertentu
    public function show(Loan $loan)
    {
        // Pastikan siswa tidak bisa melihat pinjaman orang lain lewat URL
        if ($loan->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return view('siswa.loans.show', compact('loan'));
    }
}
