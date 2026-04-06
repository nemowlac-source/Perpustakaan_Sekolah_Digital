<?php
// app/Http/Controllers/Admin/LeaderboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $siswas = User::where('role', 'siswa')
            ->withCount([
                'loans',
                'loans as tepat_waktu_count' => function ($q) {
                    $q->where('status', 'dikembalikan')
                      ->whereColumn('return_date', '<=', 'due_date');
                },
                'loans as terlambat_count' => fn($q) => $q->where('status', 'terlambat'),
            ])
            ->orderByDesc('points')
            ->paginate(20);

        // Top 3 untuk podium
        $top3 = User::where('role', 'siswa')
            ->orderByDesc('points')
            ->take(3)
            ->get();

        return view('admin.leaderboard.index', compact('siswas', 'top3'));
    }

    // Admin bisa tambah/kurangi poin manual
    public function adjustPoints(Request $request, User $siswa)
    {
        $request->validate([
            'amount' => 'required|integer|between:-1000,1000',
            'reason' => 'required|string|max:255',
        ]);

        $amount = $request->amount;

        if ($amount >= 0) {
            $siswa->addPoints($amount);
        } else {
            // Pastikan poin tidak minus
            $siswa->decrement('points', min(abs($amount), $siswa->points));
        }

        return back()->with('success',
            ($amount >= 0 ? "+{$amount}" : "{$amount}") .
            " poin untuk {$siswa->name}. Alasan: {$request->reason}"
        );
    }
}
