<?php

namespace App\Http\Controllers\Siswa;

// TAMBAHKAN BARIS INI agar 'extends Controller' tidak error
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Book, Loan, LoanRequest};
use Illuminate\Support\Facades\Auth;

class LoanRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sedang habis.');
        }

        $userId = Auth::id();

        // Cek apakah sudah meminjam buku yang sama
        $sedang_pinjam = Loan::where('user_id', $userId)
            ->where('book_id', $request->book_id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($sedang_pinjam) {
            return back()->with('error', 'Kamu sedang meminjam buku ini.');
        }

        // Cek apakah sudah ada request yang masih pending
        $sudah_request = LoanRequest::where('user_id', $userId)
            ->where('book_id', $request->book_id)
            ->where('status', 'pending')
            ->exists();

        if ($sudah_request) {
            return back()->with('error', 'Kamu sudah mengajukan permohonan untuk buku ini. Tunggu konfirmasi admin.');
        }

        LoanRequest::create([
            'user_id' => $userId,
            'book_id' => $request->book_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permohonan pinjam dikirim!');
    }
}
