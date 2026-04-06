<x-app-layout>
<div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-6">Tambah Buku Baru</h2>

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="label"><span class="label-text">Judul Buku</span></label>
                <input name="title" value="{{ old('title') }}"
                    class="input input-bordered w-full @error('title') input-error @enderror" required>
                @error('title')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="label"><span class="label-text">Penulis</span></label>
                <input name="author" value="{{ old('author') }}"
                    class="input input-bordered w-full" required>
            </div>

            <div>
                <label class="label"><span class="label-text">Penerbit</span></label>
                <input name="publisher" value="{{ old('publisher') }}"
                    class="input input-bordered w-full" required>
            </div>

            <div>
                <label class="label"><span class="label-text">ISBN</span></label>
                <input name="isbn" value="{{ old('isbn') }}"
                    class="input input-bordered w-full font-mono" required>
                @error('isbn')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="label"><span class="label-text">Tahun Terbit</span></label>
                <input name="year_published" type="number" value="{{ old('year_published') }}"
                    min="1900" max="{{ date('Y') }}" class="input input-bordered w-full" required>
            </div>

            <div>
                <label class="label"><span class="label-text">Kategori</span></label>
                <select name="category_id" class="select select-bordered w-full" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="label"><span class="label-text">Stok</span></label>
                <input name="stock" type="number" value="{{ old('stock', 1) }}"
                    min="0" class="input input-bordered w-full" required>
            </div>

            <div class="col-span-2">
                <label class="label"><span class="label-text">Deskripsi</span></label>
                <textarea name="description" rows="3"
                    class="textarea textarea-bordered w-full">{{ old('description') }}</textarea>
            </div>

            <div class="col-span-2">
                <label class="label"><span class="label-text">Cover Buku</span></label>
                <input name="cover" type="file" accept="image/*"
                    class="file-input file-input-bordered w-full">
            </div>
        </div>

        <div class="flex gap-2 justify-end pt-2">
            <a href="{{ route('admin.books.index') }}" class="btn btn-ghost">Batal</a>
            <button class="btn btn-primary">Simpan Buku</button>
        </div>
    </form>
</div>
</x-app-layout>
