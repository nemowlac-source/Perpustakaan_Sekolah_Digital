<?php
// app/Http/Controllers/Siswa/BookRequestController.php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    public function index()
    {
        $requests = BookRequest::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('siswa.book-requests.index', compact('requests'));
    }

    public function create()
    {
        // Cek apakah ada request pending lebih dari 3
        $pendingCount = BookRequest::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        if ($pendingCount >= 3) {
            return redirect()->route('siswa.book-requests.index')
                ->with('error', 'Kamu sudah memiliki 3 request yang sedang pending. Tunggu hingga diproses.');
        }

        return view('siswa.book-requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required|string|max:255',
            'author'     => 'nullable|string|max:255',
            'reason'     => 'required|string|max:500',
        ], [
            'book_title.required' => 'Judul buku wajib diisi.',
            'reason.required'     => 'Alasan pengajuan wajib diisi.',
        ]);

        // Cek duplikat request yang masih pending
        $duplicate = BookRequest::where('user_id', Auth::id())
            ->where('book_title', $request->book_title)
            ->where('status', 'pending')
            ->exists();

        if ($duplicate) {
            return back()
                ->withInput()
                ->with('error', 'Kamu sudah pernah mengajukan request buku ini dan masih pending.');
        }

        BookRequest::create([
            'user_id'    => Auth::id(),
            'book_title' => $request->book_title,
            'author'     => $request->author,
            'reason'     => $request->reason,
            'status'     => 'pending',
        ]);

        return redirect()->route('siswa.book-requests.index')
            ->with('success', 'Request buku berhasil diajukan! Tunggu konfirmasi admin.');
    }

    public function destroy(BookRequest $bookRequest)
    {
        // Hanya bisa hapus milik sendiri & masih pending
        if ($bookRequest->user_id !== Auth::id()) {
            abort(403);
        }

        if ($bookRequest->status !== 'pending') {
            return back()->with('error', 'Request yang sudah diproses tidak bisa dibatalkan.');
        }

        $bookRequest->delete();

        return back()->with('success', 'Request berhasil dibatalkan.');
    }
}
