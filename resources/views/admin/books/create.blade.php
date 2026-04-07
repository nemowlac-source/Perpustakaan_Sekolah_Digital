<x-app-layout>
<div class="p-4 sm:p-8 max-w-4xl mx-auto space-y-6">

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.books.index') }}" class="btn btn-circle btn-ghost shadow-sm bg-base-100 hover:bg-base-200 border border-base-200" title="Kembali">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <div>
            <h2 class="text-3xl font-bold text-base-content leading-tight">Tambah Buku Baru</h2>
            <p class="text-sm text-base-content/60 mt-1">Lengkapi formulir di bawah untuk menambahkan koleksi buku baru.</p>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="bg-base-100 shadow-xl shadow-base-200/50 rounded-3xl border border-base-200 overflow-hidden">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="p-8 sm:p-10 space-y-10">
                
                <!-- Section: Informasi Utama -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="bg-primary/10 text-primary p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-base-content">Informasi Utama</h3>
                    </div>

                    <div class="space-y-6 bg-base-200/30 p-6 sm:p-8 rounded-2xl border border-base-200/50">
                        <div class="form-control">
                            <label class="label font-semibold">Judul Buku <span class="text-error">*</span></label>
                            <input name="title" value="{{ old('title') }}"
                                placeholder="Masukkan judul lengkap buku"
                                class="input input-bordered w-full rounded-xl focus:input-primary transition-colors @error('title') input-error @enderror"
                                required>
                            @error('title')
                                <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label font-semibold">Penulis <span class="text-error">*</span></label>
                                <input name="author" value="{{ old('author') }}" placeholder="Nama penulis"
                                    class="input input-bordered w-full rounded-xl focus:input-primary transition-colors" required>
                            </div>
                            <div class="form-control">
                                <label class="label font-semibold">Penerbit <span class="text-error">*</span></label>
                                <input name="publisher" value="{{ old('publisher') }}" placeholder="Nama penerbit"
                                    class="input input-bordered w-full rounded-xl focus:input-primary transition-colors" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold">Kategori <span class="text-error">*</span></label>
                            <select name="category_id" class="select select-bordered w-full rounded-xl focus:select-primary transition-colors" required>
                                <option value="" disabled selected>-- Pilih Kategori Buku --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section: Detail Teknis & Deskripsi -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="bg-info/10 text-info p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-base-content">Detail & Spesifikasi</h3>
                    </div>

                    <div class="space-y-6 bg-base-200/30 p-6 sm:p-8 rounded-2xl border border-base-200/50">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="form-control">
                                <label class="label font-semibold">ISBN <span class="text-error">*</span></label>
                                <input name="isbn" value="{{ old('isbn') }}" placeholder="Contoh: 978-..."
                                    class="input input-bordered w-full rounded-xl font-mono text-sm focus:input-primary transition-colors" required>
                                @error('isbn')
                                    <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label font-semibold">Tahun Terbit <span class="text-error">*</span></label>
                                <input name="year_published" type="number" value="{{ old('year_published') }}"
                                    min="1900" max="{{ date('Y') }}" class="input input-bordered w-full rounded-xl focus:input-primary transition-colors"
                                    required>
                            </div>
                            <div class="form-control">
                                <label class="label font-semibold">Stok Unit <span class="text-error">*</span></label>
                                <input name="stock" type="number" value="{{ old('stock', 1) }}" min="0"
                                    class="input input-bordered w-full rounded-xl focus:input-primary transition-colors" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold">Deskripsi</label>
                            <textarea name="description" rows="4" placeholder="Tuliskan ringkasan atau sinopsis buku..."
                                class="textarea textarea-bordered w-full rounded-xl leading-relaxed focus:textarea-primary transition-colors">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section: Media -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="bg-secondary/10 text-secondary p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-base-content">Gambar Sampul</h3>
                    </div>

                    <div class="bg-base-200/30 p-6 sm:p-8 rounded-2xl border border-base-200/50">
                        <div class="form-control">
                            <label class="label font-semibold">Cover Buku</label>
                            <input name="cover" type="file" accept="image/*"
                                class="file-input file-input-bordered file-input-primary w-full rounded-xl">
                            <label class="label">
                                <span class="label-text-alt text-base-content/60 italic font-medium">Format yang didukung: JPG, PNG, WEBP (Maksimal 2MB)</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Action Buttons -->
            <div class="bg-base-200/50 p-6 sm:px-10 border-t border-base-200 flex flex-col-reverse sm:flex-row gap-3 justify-end items-center">
                <a href="{{ route('admin.books.index') }}"
                    class="btn btn-ghost rounded-xl w-full sm:w-auto hover:bg-base-300">Batal</a>
                <button type="submit" class="btn btn-primary rounded-xl px-10 shadow-lg shadow-primary/30 w-full sm:w-auto hover:-translate-y-0.5 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Buku Baru
                </button>
            </div>
            
        </form>
    </div>

</div>
</x-app-layout>
