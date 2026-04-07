<x-app-layout>
    <div class="p-4 sm:p-8 space-y-8">

        {{-- Header Section --}}
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-base-100 p-6 rounded-3xl shadow-sm border border-base-200">
            <div>
                <div class="flex items-center gap-3">
                    <span class="text-3xl">📚</span>
                    <h2 class="text-2xl font-bold text-base-content leading-tight">Manajemen Buku</h2>
                </div>
                <p class="text-sm text-base-content/60 mt-2">Kelola pendaftaran, pencarian, dan stok buku digital Anda.
                </p>
            </div>

            <form method="GET" class="w-full md:w-auto flex flex-row gap-2">
                <div class="relative w-full md:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/50" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input name="q" value="{{ request('q') }}" placeholder="Cari judul, penulis, ISBN..."
                        class="input input-bordered w-full pl-10 rounded-full focus:input-primary transition-colors bg-base-200/50">
                </div>
                <button class="btn btn-primary btn-circle shadow-lg shadow-primary/30 shrink-0 tooltip tooltip-bottom"
                    data-tip="Cari Buku">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                @if (request('q'))
                    <a href="{{ route('admin.books.index') }}"
                        class="btn btn-ghost btn-circle tooltip tooltip-bottom shrink-0 bg-base-200/50"
                        data-tip="Reset">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-error" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm rounded-2xl border border-success/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error shadow-sm rounded-2xl border border-error/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Quick Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-base-100 p-6 rounded-3xl shadow-sm border border-base-200 flex items-center gap-5">
                <div class="bg-primary/10 p-4 rounded-2xl text-primary">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-base-content/50 uppercase tracking-wider">Total Buku</p>
                    <div class="text-3xl font-extrabold text-base-content mt-1">{{ $books->total() ?? 0 }}</div>
                </div>
            </div>

            <div class="bg-base-100 p-6 rounded-3xl shadow-sm border border-base-200 flex items-center gap-5">
                <div class="bg-success/10 p-4 rounded-2xl text-success border border-success/10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-base-content/50 uppercase tracking-wider">Stok Tersedia</p>
                    <div class="text-3xl font-extrabold text-base-content mt-1">
                        {{ request()->has('page') ? '-' : (isset($books) && count($books) > 0 ? $books->getCollection()->sum('stock') : 0) }}
                    </div>
                </div>
            </div>

            <div class="bg-base-100 p-6 rounded-3xl shadow-sm border border-base-200 flex items-center gap-5">
                <div class="bg-info/10 p-4 rounded-2xl text-info border border-info/10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-base-content/50 uppercase tracking-wider">Kategori Tersedia</p>
                    <div class="text-3xl font-extrabold text-base-content mt-1">
                        {{ request()->has('page') ? '-' : (isset($books) && count($books) > 0 ? $books->getCollection()->unique('category_id')->count() : 0) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <h3 class="text-xl font-bold text-base-content flex items-center gap-2">
                Pustaka Koleksi
            </h3>
            <a href="{{ route('admin.books.create') }}"
                class="btn btn-primary rounded-full px-6 shadow-lg shadow-primary/30 hover:-translate-y-0.5 transition-transform">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Buku Baru
            </a>
        </div>

        {{-- Books Table --}}
        <div class="bg-base-100 rounded-3xl shadow-sm border border-base-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="bg-base-200/50 text-base-content/70">
                        <tr>
                            <th class="font-semibold text-center w-16">#</th>
                            <th class="font-semibold w-24">Cover</th>
                            <th class="font-semibold">Buku & Penulis</th>
                            <th class="font-semibold">Kategori</th>
                            <th class="font-semibold text-center">Stok Unit</th>
                            <th class="font-semibold text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                            <tr class="hover group">
                                <td class="font-medium text-center">{{ $loop->iteration }}</td>
                                <td>
                                    @if ($book->cover)
                                        <div
                                            class="avatar shadow-sm rounded-md overflow-hidden border border-base-200/50">
                                            <div class="w-12 h-16">
                                                <img src="{{ Str::startsWith($book->cover, 'http') ? $book->cover : asset('storage/' . $book->cover) }}"
                                                    class="object-cover w-full h-full" alt="Cover">
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="w-12 h-16 bg-gradient-to-br from-base-300 to-base-200 rounded-md flex items-center justify-center border border-base-300">
                                            <span class="text-xs font-semibold text-base-content/40">📚</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <p class="font-bold text-base-content leading-tight max-w-[200px] sm:max-w-xs truncate"
                                            title="{{ $book->title }}">{{ $book->title }}</p>
                                        <p class="text-sm text-base-content/60 mt-0.5">{{ $book->author }}</p>
                                        <div class="mt-1 flex items-center gap-1.5 opacity-70">
                                            <div class="bg-base-300 p-0.5 rounded text-base-content/80">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                            </div>
                                            <span class="font-mono text-xs">{{ $book->isbn }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex items-center rounded-full bg-info/10 px-3 py-1 text-xs font-bold text-info shadow-sm shadow-info/20 border border-info/10">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        {{ $book->category->name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="inline-flex items-center justify-center font-bold px-3 py-1 rounded-full text-xs shadow-sm 
                                         {{ $book->stock > 0
                                             ? 'bg-emerald-100 text-emerald-700 shadow-emerald-200/50'
                                             : 'bg-rose-100 text-rose-700 shadow-rose-200/50' }}">

                                        @if ($book->stock > 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif

                                        {{ $book->stock }} Unit
                                    </span>
                                </td>
                                <td>
                                    <div class="flex gap-2 justify-center opacity-100 transition-opacity">
                                        <a href="{{ route('admin.books.show', $book) }}"
                                            class="btn btn-sm btn-circle btn-ghost text-info hover:bg-info hover:text-info-content"
                                            title="Lihat Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.books.edit', $book) }}"
                                            class="btn btn-sm btn-circle btn-ghost text-warning hover:bg-warning hover:text-warning-content"
                                            title="Edit Buku">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button
                                                class="btn btn-sm btn-circle btn-ghost text-base-content/50 hover:bg-error hover:text-error-content hover:opacity-100"
                                                title="Hapus Buku">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-16">
                                    <div class="flex flex-col items-center justify-center text-base-content/50">
                                        <svg class="w-16 h-16 mb-4 text-base-content/30" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                        <p class="text-lg font-medium">Belum ada buku</p>
                                        <p class="text-sm mt-1">Tambahkan koleksi buku pertama Anda untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (method_exists($books, 'hasPages') && $books->hasPages())
                <div class="p-4 border-t border-base-200">
                    {{ $books->links() }}
                </div>
            @elseif($books instanceof \Illuminate\Pagination\LengthAwarePaginator && $books->hasPages())
                <div class="p-4 border-t border-base-200">
                    {{ $books->links() }}
                </div>
            @elseif(isset($books) && method_exists($books, 'links') && trim($books->links()) != '')
                <div class="p-4 border-t border-base-200">
                    {{ $books->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
