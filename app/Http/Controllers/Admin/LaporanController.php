<?php
// app/Http/Controllers/Admin/LaporanController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function generatePDF(Request $request)
    {
        $request->validate([
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        // Tambahkan waktu agar query akurat
        $mulai = $request->tgl_mulai . ' 00:00:00';
        $selesai = $request->tgl_selesai . ' 23:59:59';

        $loans = Loan::with(['user', 'book'])
            // Ganti 'loan_date' menjadi 'borrow_date'
            ->whereBetween('borrow_date', [$mulai, $selesai])
            ->latest()
            ->get();

        $data = [
            'title' => 'Laporan Peminjaman Buku',
            'date' => date('d/m/Y'),
            'loans' => $loans,
            'range' => \Carbon\Carbon::parse($request->tgl_mulai)->format('d/m/Y') . ' s/d ' . \Carbon\Carbon::parse($request->tgl_selesai)->format('d/m/Y')
        ];

        $pdf = Pdf::loadView('admin.laporan.pdf_template', $data);

        return $pdf->download('laporan-peminjaman-' . date('Ymd') . '.pdf');
    }
}
