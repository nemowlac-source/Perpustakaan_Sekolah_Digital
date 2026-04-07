<x-app-layout>
    <div class="p-4 sm:p-8 max-w-6xl mx-auto space-y-8">

        <!-- Breadcrumbs / Action Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.books.index') }}"
                    class="btn btn-circle btn-ghost shadow-sm bg-base-100 hover:bg-base-200 border border-base-200"
                    title="Kembali">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h2 class="text-3xl font-bold text-base-content leading-tight">Detail Buku</h2>
                    <nav class="text-sm text-base-content/60 mt-1 flex items-center gap-1">
                        <a href="{{ route('admin.books.index') }}" class="hover:text-primary transition-colors">Daftar
                            Buku</a>
                        <span>/</span>
                        <span class="font-medium">Detail</span>
                    </nav>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.books.edit', $book->id) }}"
                    class="btn btn-warning rounded-full px-6 shadow-sm hover:-translate-y-0.5 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data
                </a>
                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini dari koleksi?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-error rounded-full px-6 shadow-sm hover:-translate-y-0.5 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left: Cover Section (4 Columns) -->
            <div class="lg:col-span-4">
                <div
                    class="bg-base-100 border border-base-200 shadow-xl shadow-base-200/50 rounded-3xl overflow-hidden sticky top-8">
                    <div
                        class="aspect-[3/4] bg-base-200 flex items-center justify-center relative border-b border-base-200">
                        @if ($book->cover)
                            <img src="{{ Str::startsWith($book->cover, 'http') ? $book->cover : asset('storage/' . $book->cover) }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="text-base-content/30 flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span class="text-xs font-semibold uppercase mt-2 tracking-widest">No Cover</span>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            @if ($book->stock > 0)
                                <span
                                    class="badge badge-success px-4 py-3 text-success-content border-none shadow-md shadow-success/30 font-bold">Tersedia</span>
                            @else
                                <span
                                    class="badge badge-error px-4 py-3 text-error-content border-none shadow-md shadow-error/30 font-bold">Habis</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6 bg-base-100 flex items-center justify-between">
                        <div>
                            <h4 class="text-base-content/50 text-xs font-bold uppercase tracking-widest mb-1">ISBN</h4>
                            <p class="font-mono text-base-content font-bold text-lg tracking-wider">{{ $book->isbn }}
                            </p>
                        </div>
                        <div class="bg-base-200 p-2 rounded-xl text-base-content/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Details Section (8 Columns) -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Title & Author Card -->
                <div class="bg-base-100 border border-base-200 shadow-sm rounded-3xl p-8 sm:p-10">
                    <div class="mb-8">
                        <span
                            class="badge badge-info bg-info/10 text-info border-info/20 px-4 py-3 text-xs font-bold uppercase tracking-wider mb-4 inline-flex">
                            {{ $book->category->name ?? 'Uncategorized' }}
                        </span>
                        <h1 class="text-4xl font-extrabold text-base-content leading-tight">{{ $book->title }}</h1>
                        <p class="text-xl text-base-content/60 mt-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Oleh: <span class="text-base-content font-bold">{{ $book->author }}</span>
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-8 border-y border-base-200/60">
                        <div>
                            <p
                                class="text-xs text-base-content/50 font-bold uppercase tracking-widest mb-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Penerbit
                            </p>
                            <p class="text-base-content font-semibold text-lg">{{ $book->publisher }}</p>
                        </div>
                        <div>
                            <p
                                class="text-xs text-base-content/50 font-bold uppercase tracking-widest mb-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Tahun
                            </p>
                            <p class="text-base-content font-semibold text-lg">{{ $book->year_published }}</p>
                        </div>
                        <div>
                            <p
                                class="text-xs text-base-content/50 font-bold uppercase tracking-widest mb-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                Stok
                            </p>
                            <p class="text-primary font-extrabold text-lg">{{ $book->stock }} Unit</p>
                        </div>
                        <div>
                            <p
                                class="text-xs text-base-content/50 font-bold uppercase tracking-widest mb-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Dibuat Pada
                            </p>
                            <p class="text-base-content font-semibold text-lg">
                                {{ $book->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-base-content mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sinopsis / Deskripsi
                        </h3>
                        <div class="p-6 bg-base-200/50 rounded-2xl border border-base-200">
                            <div class="prose max-w-none text-base-content/80 leading-relaxed font-medium">
                                {{ $book->description ?: 'Tidak ada deskripsi rinci untuk buku ini belum ditambahkan.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
