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

        {{-- Pinjaman Aktif --}}
        <div class="bg-base-100 rounded-xl border border-base-300 p-4">
            <h3 class="font-semibold mb-3">Buku yang Sedang Dipinjam</h3>
            @forelse($pinjaman_aktif as $loan)
            <div class="flex items-center gap-3 py-2 border-b border-base-200 last:border-0">
                <div class="flex-1">
                    <p class="font-medium">{{ $loan->book->title }}</p>
                    <p class="text-sm text-base-content/60">
                        Jatuh tempo: {{ $loan->due_date->format('d M Y') }}
                        @if($loan->isLate())
                            <span class="badge badge-error badge-sm ml-1">Terlambat!</span>
                        @endif
                    </p>
                </div>
            </div>
            @empty
            <p class="text-base-content/50 text-sm">Kamu tidak sedang meminjam buku.</p>
            @endforelse
        </div>

        {{-- Rekomendasi --}}
        @if($rekomendasi->count())
        <div class="bg-base-100 rounded-xl border border-base-300 p-4">
            <h3 class="font-semibold mb-3">✨ Mungkin Kamu Suka</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                @foreach($rekomendasi as $book)
                <div class="card card-compact bg-base-200">
                    @if($book->cover)
                        <figure><img src="{{ Storage::url($book->cover) }}"
                            class="h-32 w-full object-cover"></figure>
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
