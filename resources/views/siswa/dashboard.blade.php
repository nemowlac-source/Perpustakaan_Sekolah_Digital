<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Halo, {{ auth()->user()->name }} 👋</h2>
    </x-slot>

    <div class="p-6 space-y-6">

        {{-- Poin & Info Siswa --}}
        <div class="bg-base-200 rounded-xl p-4 flex items-center gap-4">
            <div class="text-4xl">🏆</div>
            <div>
                <p class="text-sm text-base-content/60">Poin kamu saat ini</p>
                <p class="text-3xl font-bold text-primary">{{ auth()->user()->points }}</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <h3 class="text-lg font-bold">Katalog Buku</h3>
            <form action="{{ route('siswa.dashboard') }}" method="GET" class="w-full md:w-auto">
                <div class="join w-full">
                    <input class="input input-bordered join-item w-full md:w-80" name="search"
                        placeholder="Cari judul atau penulis..." value="{{ request('search') }}" />
                    <button class="btn btn-primary join-item">Cari</button>
                </div>
            </form>
        </div>

        {{-- Pinjaman Aktif --}}
        <div class="bg-base-100 rounded-xl border border-base-300 p-4">
            <h3 class="font-semibold mb-3">Buku yang Sedang Dipinjam</h3>
            @forelse($pinjaman_aktif as $loan)
                <div class="flex items-center gap-3 py-2 border-b border-base-200 last:border-0">
                    <div class="flex-1">
                        <p class="font-medium">{{ $loan->book->title }}</p>
                        <p class="text-sm text-base-content/60">
                            Jatuh tempo: {{ $loan->due_date->format('d M Y') }}
                            @if ($loan->isLate())
                                <span class="badge badge-error badge-sm ml-1">Terlambat!</span>
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-base-content/50 text-sm">Kamu tidak sedang meminjam buku.</p>
            @endforelse
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse($books as $book)
                <div class="card bg-base-100 shadow-xl border border-base-200 hover:shadow-2xl transition-all">
                    <figure class="px-3 pt-3">
                        @if ($book->cover)
                            {{-- Jika pake URL dari Faker (Picsum) --}}
                            <img src="{{ Str::startsWith($book->cover, 'http') ? $book->cover : Storage::url($book->cover) }}"
                                alt="Cover" class="rounded-xl h-48 w-full object-cover" />
                        @else
                            <div class="h-48 w-full bg-base-300 rounded-xl flex items-center justify-center">
                                <span class="text-xs opacity-50 italic">No Cover</span>
                            </div>
                        @endif
                    </figure>
                    <div class="card-body p-4">
                        <div class="badge badge-secondary badge-outline text-[10px]">{{ $book->category->name }}</div>
                        <h2 class="card-title text-sm line-clamp-1">{{ $book->title }}</h2>
                        <p class="text-xs text-base-content/60">{{ $book->author }}</p>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-xs font-bold {{ $book->stock > 0 ? 'text-success' : 'text-error' }}">
                                Stok: {{ $book->stock }}
                            </span>
                        </div>
                        <div class="card-actions mt-3">
                            {{-- Ubah ke route request --}}
                            {{-- Cari baris ini di dashboard.blade.php --}}
                            <form action="{{ route('siswa.loan-requests.store') }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-primary ...">📩 Ajukan Peminjaman</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="opacity-50">Buku tidak ditemukan.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $books->appends(['search' => request('search')])->links() }}
        </div>
        {{-- Rekomendasi --}}
        @if ($rekomendasi->count())
            <div class="bg-base-100 rounded-xl border border-base-300 p-4">
                <h3 class="font-semibold mb-3">✨ Mungkin Kamu Suka</h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                    @foreach ($rekomendasi as $book)
                        <div class="card card-compact bg-base-200">
                            @if ($book->cover)
                                <figure><img src="{{ Storage::url($book->cover) }}" class="h-32 w-full object-cover">
                                </figure>
                            @endif
                            <div class="card-body">
                                <p class="font-medium text-sm line-clamp-2">{{ $book->title }}</p>
                                <p class="text-xs text-base-content/60">{{ $book->author }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
