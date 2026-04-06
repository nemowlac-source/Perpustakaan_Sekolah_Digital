<?php
// app/Http/Controllers/Admin/CategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:categories|max:100']);

        Category::create($request->only('name'));

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,'.$category->id,
        ]);

        $category->update($request->only('name'));

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        // Cegah hapus jika masih ada buku
        if ($category->books()->count() > 0) {
            return back()->with('error', 'Kategori masih memiliki buku, tidak bisa dihapus.');
        }

        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
