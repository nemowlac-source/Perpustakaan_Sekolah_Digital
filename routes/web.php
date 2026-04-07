<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use Illuminate\Support\Facades\Auth;

// ─── Root Route ──────────────────────────────────────────
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $user = Auth::user();
    return $user->role === 'admin' // Sesuaikan dengan cara kamu cek role
        ? redirect()->route('admin.dashboard')
        : redirect()->route('siswa.dashboard');
});

// ─── Route AJAX untuk Cek Status (Penting untuk Auto-Redirect) ───
Route::get('/check-status-ajax', function () {
    return response()->json(['active' => (bool) auth()->user()->is_active]);
})->middleware('auth');

// ─── Halaman Waiting Approval ────────────────────────────
// Diletakkan di luar agar bisa diakses saat tertahan middleware
Route::get('/waiting-approval', function () {
    return view('auth.waiting-approval');
})->middleware(['auth'])->name('waiting.approval');


// ─── Admin Routes (Tidak Terpengaruh is_active) ──────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Manajemen Siswa & Fitur Admin Lainnya
    Route::resource('siswa', \App\Http\Controllers\Admin\SiswaController::class);
    Route::patch('siswa/{id}/konfirmasi', [\App\Http\Controllers\Admin\SiswaController::class, 'konfirmasiSiswa'])->name('konfirmasi');

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('books', \App\Http\Controllers\Admin\BookController::class);
    Route::resource('loans', \App\Http\Controllers\Admin\LoanController::class);
    Route::patch('loans/{loan}/return', [\App\Http\Controllers\Admin\LoanController::class, 'returnBook'])->name('loans.return');
    Route::patch('siswa/{siswa}/reset-password', [\App\Http\Controllers\Admin\SiswaController::class, 'resetPassword'])->name('siswa.reset-password');
    Route::get('leaderboard', [\App\Http\Controllers\Admin\LeaderboardController::class, 'index'])->name('leaderboard');
    Route::post('siswa/{siswa}/points', [\App\Http\Controllers\Admin\LeaderboardController::class, 'adjustPoints'])->name('siswa.points.adjust');
    Route::resource('book-requests', \App\Http\Controllers\Admin\BookRequestController::class)->only(['index', 'show', 'destroy']);
    Route::patch('book-requests/{bookRequest}/approve', [\App\Http\Controllers\Admin\BookRequestController::class, 'approve'])->name('book-requests.approve');
    Route::patch('book-requests/{bookRequest}/reject', [\App\Http\Controllers\Admin\BookRequestController::class, 'reject'])->name('book-requests.reject');
    Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [\App\Http\Controllers\Admin\LaporanController::class, 'generatePDF'])->name('laporan.pdf');
    Route::get('/loan-requests', [\App\Http\Controllers\Admin\LoanRequestController::class, 'index'])->name('loan-requests.index');
    Route::post('/loan-requests/{loanRequest}/approve', [\App\Http\Controllers\Admin\LoanRequestController::class, 'approve'])->name('loan-requests.approve');
    Route::post('/loan-requests/{loanRequest}/reject', [\App\Http\Controllers\Admin\LoanRequestController::class, 'reject'])->name('loan-requests.reject');
    Route::post('/siswa/import', [\App\Http\Controllers\Admin\SiswaController::class, 'import'])->name('siswa.import');
    Route::get('/siswa/download-template', [\App\Http\Controllers\Admin\SiswaController::class, 'downloadTemplate'])->name('siswa.download-template');
});

// ─── Siswa Routes (DILINDUNGI checkStatus) ────────────────
// Tambahkan middleware 'checkStatus' di sini
Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa', 'checkStatus'])->group(function () {
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');
    Route::resource('book-requests', \App\Http\Controllers\Siswa\BookRequestController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::get('/loans', [\App\Http\Controllers\Siswa\LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/{loan}', [\App\Http\Controllers\Siswa\LoanController::class, 'show'])->name('loans.show');
    Route::post('/loan-requests', [\App\Http\Controllers\Siswa\LoanRequestController::class, 'store'])->name('loan-requests.store');
});

// ─── Profile Routes ──────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
