<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{User, Book, Loan, BookRequest};

class DashboardController extends Controller
{
    public function index()
    {
        $pendingSiswaCount = \App\Models\User::where('role', 'siswa')
                                        ->where('is_active', 0)
                                        ->count();
        $stats = [
            'total_buku'      => Book::count(),
            'total_siswa'     => User::where('role', 'siswa')->count(),
            'dipinjam'        => Loan::where('status', 'dipinjam')->count(),
            'terlambat'       => Loan::where('status', 'terlambat')->count(),
            'request_pending' => BookRequest::where('status', 'pending')->count(),
        ];

        $pinjam_terbaru = Loan::with(['user', 'book'])
            ->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'pinjam_terbaru','pendingSiswaCount'));
    }
}
