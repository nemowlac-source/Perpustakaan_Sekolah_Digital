<?php
// app/Http/Controllers/Admin/LoanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Loan, Book, User};
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loans = Loan::with(['user', 'book'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->q, function ($q) use ($request) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$request->q}%"))
                  ->orWhereHas('book', fn($b) => $b->where('title', 'like', "%{$request->q}%"));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.loans.index', compact('loans'));
    }

    public function create()
    {
        $siswas = User::where('role', 'siswa')->orderBy('name')->get();
        $books  = Book::where('stock', '>', 0)->orderBy('title')->get();
        return view('admin.loans.create', compact('siswas', 'books'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id'  => 'required|exists:users,id',
        'book_id'  => 'required|exists:books,id',
        'due_date' => 'required|date|after:today',
    ]);

    $book = Book::findOrFail($validated['book_id']);

    // 1. Cek stok
    if (!$book->isAvailable()) {
        return back()->with('error', 'Stok buku habis.');
    }

    // 2. Cek apakah sudah meminjam buku yang sama
    $sudahPinjam = Loan::where('user_id', $validated['user_id'])
        ->where('book_id', $validated['book_id'])
        ->where('status', 'dipinjam')
        ->exists();

    if ($sudahPinjam) {
        return back()->with('error', 'Siswa ini sudah meminjam buku tersebut.');
    }

    // 3. BUAT PEMINJAMAN TERLEBIH DAHULU (Simpan ke variabel $loan)
    $loan = Loan::create([
        'user_id'     => $validated['user_id'],
        'book_id'     => $validated['book_id'],
        'borrow_date' => now(), // Gunakan helper now() lebih simpel
        'due_date'    => $validated['due_date'],
        'status'      => 'dipinjam',
    ]);

    // 4. SEKARANG $loan SUDAH ADA, baru bisa tambah poin
    $loan->user->addPoints(User::POINTS_BORROW_BOOK);

    // 5. Kurangi stok buku
    $book->decrement('stock');

    return redirect()->route('admin.loans.index')
        ->with('success', 'Peminjaman berhasil dicatat.');
}

    public function show(Loan $loan)
    {
        $loan->load(['user', 'book.category']);
        return view('admin.loans.show', compact('loan'));
    }

    // Proses pengembalian buku
    public function returnBook(Request $request, Loan $loan)
    {
        if ($loan->status === 'dikembalikan') {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        $returnDate = Carbon::today();
        $fine       = $loan->calculateFine();
        $isOnTime   = $fine === 0;

        // Update loan
        $loan->update([
            'return_date' => $returnDate,
            'status'      => 'dikembalikan',
            'fine'        => $fine,
        ]);

        // Kembalikan stok buku
        $loan->book->increment('stock');

        // Beri poin jika tepat waktu (10 poin)
        if ($isOnTime) {
            $loan->user->addPoints(10);
        }

        $msg = $isOnTime
            ? 'Buku dikembalikan tepat waktu! Siswa mendapat 10 poin. 🎉'
            : "Buku terlambat. Denda: Rp " . number_format($fine, 0, ',', '.');

        return redirect()->route('admin.loans.index')->with('success', $msg);
    }

    // Update status terlambat (bisa dipanggil via scheduler)
    public function updateOverdue()
    {
        Loan::where('status', 'dipinjam')
            ->where('due_date', '<', Carbon::today())
            ->update(['status' => 'terlambat']);
    }
}
