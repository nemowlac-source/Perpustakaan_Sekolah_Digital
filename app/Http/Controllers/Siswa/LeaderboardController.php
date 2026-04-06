<?php
// app/Http/Controllers/Siswa/LeaderboardController.php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            ])
            ->orderByDesc('points')
            ->paginate(20);

        // Ranking user yang login
        $myRank = User::where('role', 'siswa')
            ->where('points', '>', Auth::user()->points)
            ->count() + 1;

        $top3 = User::where('role', 'siswa')
            ->orderByDesc('points')
            ->take(3)
            ->get();

        return view('siswa.leaderboard', compact('siswas', 'top3', 'myRank'));
    }
}
