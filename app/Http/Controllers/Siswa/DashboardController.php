<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\{Loan, Book};
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pinjaman_aktif = Loan::where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->with('book')
            ->get();

        // Rekomendasi: ambil kategori favorit user
        $kategori_favorit = Loan::where('user_id', $user->id)
            ->join('books', 'loans.book_id', '=', 'books.id')
            ->pluck('books.category_id')
            ->mode(); // kategori paling sering

        $rekomendasi = Book::where('category_id', $kategori_favorit)
            ->where('stock', '>', 0)
            ->whereNotIn('id', $pinjaman_aktif->pluck('book_id'))
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact('user', 'pinjaman_aktif', 'rekomendasi'));
    }
}
