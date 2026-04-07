<x-app-layout>
    <div class="w-full py-4 space-y-8">

        <!-- Welcome Banner -->
        <div
            class="bg-gradient-to-br from-primary to-indigo-600 rounded-3xl p-6 sm:p-10 text-primary-content shadow-xl shadow-primary/30 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6">
            <!-- decorative circles -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full border-4 border-white/10 opacity-50">
            </div>
            <div class="absolute bottom-0 right-32 -mb-20 w-40 h-40 rounded-full border-4 border-white/10 opacity-50">
            </div>

            <div class="relative z-10 space-y-2 text-center md:text-left">
                <h2
                    class="text-3xl sm:text-4xl font-extrabold tracking-tight flex items-center gap-2 justify-center md:justify-start">
                    Halo, {{ auth()->user()->name }} <span
                        class="animate-bounce origin-bottom-right drop-shadow-md">👋</span>
                </h2>
                <p class="text-primary-content/80 text-lg font-medium max-w-lg mt-2">Selamat datang di perpustakaan
                    digital. Temukan pustaka dan pengetahuan barumu hari ini!</p>
            </div>

            {{-- Poin & Info Siswa --}}
            <div
                class="relative z-10 bg-white/10 backdrop-blur-md rounded-2xl p-5 flex items-center gap-5 border border-white/20 shadow-inner w-full md:w-auto">
                <div
                    class="bg-gradient-to-r from-amber-400 to-orange-500 rounded-full p-3 shadow-lg shadow-amber-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div class="text-left">
                    <p class="text-xs font-semibold text-primary-content/70 uppercase tracking-widest mb-0.5">Poin
                        Reward</p>
                    <p class="text-4xl font-black drop-shadow-md">{{ auth()->user()->points }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Main Content Area -->
            <div class="lg:col-span-3 space-y-8">

                <!-- Search & Filters -->
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-2">
                    <div>
                        <h3 class="text-2xl font-black text-base-content flex items-center gap-2">
                            <span class="w-2 h-6 bg-primary rounded-full inline-block"></span>
                            Katalog Buku
                        </h3>
                        <p class="text-sm font-medium text-base-content/60 mt-0.5 ml-4">Jelajahi berbagai koleksi
                            perpustakaan</p>
                    </div>

                    <form action="{{ route('siswa.dashboard') }}" method="GET" class="w-full md:w-auto">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari judul, penulis..."
                                class="input input-bordered w-full md:w-[22rem] pl-11 pr-16 bg-base-100 shadow-sm rounded-2xl focus:input-primary transition-all text-sm font-medium h-12" />
                            <button type="submit"
                                class="absolute inset-y-1.5 right-1.5 btn btn-primary btn-sm rounded-xl px-4 h-9 min-h-0">Cari</button>
                        </div>
                    </form>
                </div>

                <!-- Book Grid -->
                <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-5 gap-4 sm:gap-6">
                    @forelse($books->take(10) as $book)
                        <div
                            class="card bg-base-100 shadow-sm border border-base-200 hover:shadow-xl hover:border-primary/30 transition-all duration-300 group flex flex-col h-full rounded-2xl overflow-hidden">
                            <figure class="relative aspect-[3/4] p-3 pb-0 bg-base-100">
                                @if ($book->cover)
                                    <img src="{{ Str::startsWith($book->cover, 'http') ? $book->cover : asset('storage/' . $book->cover) }}"
                                        alt="Cover {{ $book->title }}"
                                        class="w-full h-full object-cover rounded-xl shadow-md border border-base-200 group-hover:scale-[1.02] transition-transform duration-500 delay-75" />
                                @else
                                    <div
                                        class="w-full h-full bg-base-200 rounded-xl flex items-center justify-center border border-base-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-base-content/20"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="absolute top-5 right-5">
                                    <div
                                        class="badge {{ $book->stock > 0 ? 'badge-success shrink-0 text-white shadow-sm' : 'badge-error text-white' }} font-bold text-[10px] uppercase tracking-wider py-2 scale-90 origin-top-right backdrop-blur-sm bg-opacity-90">
                                        {{ $book->stock > 0 ? $book->stock . ' Tersedia' : 'Kosong' }}
                                    </div>
                                </div>
                            </figure>

                            <div class="card-body p-4 sm:p-5 flex flex-col grow justify-between gap-4">
                                <div class="space-y-1">
                                    <div
                                        class="badge badge-primary badge-outline text-[10px] font-bold uppercase tracking-wider mb-1">
                                        {{ $book->category->name }}</div>
                                    <h2
                                        class="card-title text-base sm:text-lg font-bold leading-snug line-clamp-2 text-base-content">
                                        {{ $book->title }}</h2>
                                    <p class="text-xs sm:text-sm font-medium text-base-content/60 line-clamp-1">
                                        {{ $book->author }}</p>
                                </div>

                                <div class="card-actions mt-auto border-t border-base-200/60 pt-4">
                                    <form action="{{ route('siswa.loan-requests.store') }}" method="POST"
                                        class="w-full">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        @if ($book->stock > 0)
                                            <button type="submit"
                                                class="btn btn-primary w-full rounded-xl shadow-md shadow-primary/20 hover:-translate-y-0.5 transition-transform font-bold text-[13px] h-11 min-h-0">
                                                Ajukan Pinjaman
                                            </button>
                                        @else
                                            <button type="button" disabled
                                                class="btn btn-disabled w-full rounded-xl font-bold text-[13px] h-11 min-h-0 bg-base-200/50 text-base-content/40">
                                                Stok Habis
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full py-16 flex flex-col items-center justify-center bg-base-100 rounded-3xl border border-dashed border-base-300">
                            <div class="w-20 h-20 bg-base-200 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-base-content/30"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-base-content mb-1">Buku tidak ditemukan</h3>
                            <p class="text-base-content/60 text-sm max-w-xs text-center">Maaf, kami tidak dapat
                                menemukan buku dengan kata kunci tersebut. Coba kata kunci lain.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if ($books->hasPages())
                    <div
                        class="mt-8 flex justify-center w-full bg-base-100 p-2 rounded-2xl border border-base-200 shadow-sm">
                        {{ $books->appends(['search' => request('search')])->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar Area -->
            <div class="space-y-8">
                {{-- Pinjaman Aktif --}}
                <div class="bg-base-100 rounded-3xl shadow-sm border border-base-200 overflow-hidden relative">
                    <div class="bg-gradient-to-r from-info/20 to-base-100 px-6 py-5 border-b border-base-200">
                        <h3 class="font-black text-lg text-base-content flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sedang Dipinjam
                        </h3>
                    </div>

                    <div class="p-6 space-y-4">
                        @forelse($pinjaman_aktif as $loan)
                            <div
                                class="flex items-start gap-4 p-4 bg-base-200/50 rounded-2xl border border-base-200/80 hover:bg-base-200 transition-colors group">
                                <div class="w-12 h-16 shrink-0 bg-base-300 rounded overflow-hidden shadow-sm">
                                    @if ($loan->book->cover)
                                        <img src="{{ Str::startsWith($loan->book->cover, 'http') ? $loan->book->cover : asset('storage/' . $loan->book->cover) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full bg-base-300 flex items-center justify-center border border-base-200">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-base-content/20" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0 pt-0.5">
                                    <p
                                        class="font-bold text-sm text-base-content leading-tight line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                                        {{ $loan->book->title }}</p>
                                    <div class="flex flex-col gap-1 items-start">
                                        <div
                                            class="flex items-center gap-1.5 text-[11px] font-medium text-base-content/60">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Batas: {{ \Carbon\Carbon::parse($loan->due_date)->format('d M y') }}
                                        </div>
                                        @if ($loan->isLate())
                                            <span
                                                class="badge badge-error badge-sm text-[10px] font-bold text-white uppercase tracking-wider py-1.5 mt-0.5">Terlambat!</span>
                                        @else
                                            <span
                                                class="badge badge-info badge-sm text-[10px] font-bold text-info-content uppercase tracking-wider py-1.5 badge-outline bg-info/10 border-info/30 mt-0.5">Aktif</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="text-center py-6 px-4 bg-base-200/30 rounded-2xl border border-dashed border-base-300">
                                <p class="text-base-content/50 text-sm font-medium">Kamu belum meminjam buku apa pun
                                    saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Rekomendasi --}}
                @if ($rekomendasi->count())
                    <div
                        class="bg-gradient-to-b from-secondary/10 to-base-100 rounded-3xl shadow-sm border border-secondary/20 p-6">
                        <div class="flex items-center gap-3 mb-5">
                            <div
                                class="w-8 h-8 rounded-full bg-secondary/20 flex items-center justify-center text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                                </svg>
                            </div>
                            <h3 class="font-black text-lg text-base-content focus:outline-none">Pilihan Terbaik</h3>
                        </div>

                        <div class="space-y-4">
                            @foreach ($rekomendasi->take(5) as $book)
                                <a href="{{ route('siswa.dashboard') }}?search={{ urlencode($book->title) }}"
                                    class="flex items-center gap-4 group p-3 bg-base-100 rounded-2xl border border-base-200 hover:border-secondary/50 hover:shadow-md transition-all">
                                    <div class="w-14 h-20 shrink-0 bg-base-300 rounded object-cover overflow-hidden">
                                        @if ($book->cover)
                                            <img src="{{ Str::startsWith($book->cover, 'http') ? $book->cover : asset('storage/' . $book->cover) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full bg-base-300 flex items-center justify-center border border-base-200">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-base-content/20" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="font-bold text-sm text-base-content line-clamp-2 mb-1 group-hover:text-secondary transition-colors">
                                            {{ $book->title }}</p>
                                        <p class="text-[11px] font-semibold text-base-content/50 truncate">
                                            {{ $book->author }}</p>
                                        <p class="text-[10px] font-bold text-secondary mt-1 uppercase tracking-wider">
                                            {{ $book->category->name }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </div>
</x-app-layout>
