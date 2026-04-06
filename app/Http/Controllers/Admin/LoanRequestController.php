<?php
// app/Http/Controllers/Admin/LoanRequestController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{LoanRequest, Loan};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanRequestController extends Controller
{
    public function index()
    {
        // Ambil request yang statusnya masih pending
        $requests = LoanRequest::with(['user', 'book'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.loan_requests.index', compact('requests'));
    }

    public function approve(LoanRequest $loanRequest)
    {
        // Gunakan Database Transaction agar jika satu gagal, semua batal (aman!)
        DB::transaction(function () use ($loanRequest) {
            // 1. Buat data di tabel Peminjaman (Loans)
            Loan::create([
                'user_id' => $loanRequest->user_id,
                'book_id' => $loanRequest->book_id,
                'borrow_date' => now(),
                'due_date' => now()->addDays(7), // Otomatis 7 hari pinjam
                'status' => 'dipinjam',
            ]);

            // 2. Kurangi stok buku
            $loanRequest->book->decrement('stock');

            // 3. Update status request menjadi completed
            $loanRequest->update(['status' => 'completed']);
        });

        return back()->with('success', 'Buku telah diserahkan dan peminjaman dimulai!');
    }

    public function reject(Request $request, LoanRequest $loanRequest)
    {
        $loanRequest->update([
            'status' => 'rejected',
            'note' => $request->reason // Admin bisa kasih alasan kenapa ditolak
        ]);

        return back()->with('success', 'Pengajuan telah ditolak.');
    }
}
