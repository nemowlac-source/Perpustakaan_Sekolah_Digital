<?php
// app/Http/Controllers/Admin/BookRequestController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{BookRequest, User};
use Illuminate\Http\Request;

class BookRequestController extends Controller
{
    public function index(Request $request)
    {
        $requests = BookRequest::with('user')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->q, function ($q) use ($request) {
                $q->where('book_title', 'like', "%{$request->q}%")
                  ->orWhere('author', 'like', "%{$request->q}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$request->q}%"));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $counts = [
            'pending'   => BookRequest::where('status', 'pending')->count(),
            'disetujui' => BookRequest::where('status', 'disetujui')->count(),
            'ditolak'   => BookRequest::where('status', 'ditolak')->count(),
        ];

        return view('admin.book-requests.index', compact('requests', 'counts'));
    }

    public function show(BookRequest $bookRequest)
    {
        $bookRequest->load('user');
        return view('admin.book-requests.show', compact('bookRequest'));
    }

    public function approve(BookRequest $bookRequest)
    {
        if ($bookRequest->status !== 'pending') {
            return back()->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        $bookRequest->update(['status' => 'disetujui']);

        // Beri poin ke siswa
        $bookRequest->user->addPoints(User::POINTS_REQUEST_APPROVED);

        return back()->with('success',
            "Request '{$bookRequest->book_title}' disetujui. " .
            "+". User::POINTS_REQUEST_APPROVED ." poin untuk {$bookRequest->user->name}."
        );
    }

    public function reject(Request $request, BookRequest $bookRequest)
    {
        if ($bookRequest->status !== 'pending') {
            return back()->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        $request->validate([
            'rejection_reason' => 'nullable|string|max:255',
        ]);

        $bookRequest->update([
            'status'           => 'ditolak',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('success', "Request '{$bookRequest->book_title}' telah ditolak.");
    }

    public function destroy(BookRequest $bookRequest)
    {
        $bookRequest->delete();
        return back()->with('success', 'Request berhasil dihapus.');
    }
}
