<?php
// app/Http/Controllers/Admin/BookController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Book, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
         $books = Book::with('category')
        ->when($request->q, function ($query, $q) {
            $query->where('title', 'like', "%$q%")
                  ->orWhere('author', 'like', "%$q%")
                  ->orWhere('isbn', 'like', "%$q%");
        })
        ->latest()
        ->paginate(10)
        ->withQueryString(); // pertahankan ?q= saat paging

    return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'publisher'      => 'required|string|max:255',
            'year_published' => 'required|digits:4|integer|min:1900|max:'.date('Y'),
            'isbn'           => 'required|string|unique:books|max:20',
            'stock'          => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        $book->load('category', 'loans.user');
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'publisher'      => 'required|string|max:255',
            'year_published' => 'required|digits:4|integer|min:1900|max:'.date('Y'),
            'isbn'           => 'required|string|max:20|unique:books,isbn,'.$book->id,
            'stock'          => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($book->cover) Storage::disk('public')->delete($book->cover);
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        // Cegah hapus jika sedang dipinjam
        if ($book->loans()->where('status', 'dipinjam')->exists()) {
            return back()->with('error', 'Buku sedang dipinjam, tidak bisa dihapus.');
        }

        if ($book->cover) Storage::disk('public')->delete($book->cover);
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
