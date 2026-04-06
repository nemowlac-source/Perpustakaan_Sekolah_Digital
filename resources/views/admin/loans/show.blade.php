<x-app-layout>
<div class="p-6 max-w-lg mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.loans.index') }}" class="btn btn-ghost btn-sm">← Kembali</a>
        <h2 class="text-xl font-semibold">Detail Peminjaman</h2>
    </div>

    <div class="bg-base-100 border border-base-300 rounded-xl p-5 space-y-3">

        <div class="flex justify-between">
            <span class="text-base-content/60">Status</span>
            <span class="badge
                {{ $loan->status === 'dipinjam'     ? 'badge-info'    : '' }}
                {{ $loan->status === 'dikembalikan' ? 'badge-success' : '' }}
                {{ $loan->status === 'terlambat'    ? 'badge-error'   : '' }}">
                {{ ucfirst($loan->status) }}
            </span>
        </div>

        <div class="divider my-1"></div>

        <div class="flex justify-between">
            <span class="text-base-content/60">Siswa</span>
            <span class="font-medium">{{ $loan->user->name }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-base-content/60">NIS</span>
            <span>{{ $loan->user->nis }}</span>
        </div>

        <div class="divider my-1"></div>

        <div class="flex justify-between">
            <span class="text-base-content/60">Buku</span>
            <span class="font-medium text-right max-w-[60%]">{{ $loan->book->title }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-base-content/60">Penulis</span>
            <span>{{ $loan->book->author }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-base-content/60">ISBN</span>
            <span class="font-mono text-sm">{{ $loan->book->isbn }}</span>
        </div>

        <div class="divider my-1"></div>

        <div class="flex justify-between">
            <span class="text-base-content/60">Tgl Pinjam</span>
            <span>{{ $loan->borrow_date->format('d M Y') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-base-content/60">Jatuh Tempo</span>
            <span>{{ $loan->due_date->format('d M Y') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-base-content/60">Tgl Kembali</span>
            <span>{{ $loan->return_date?->format('d M Y') ?? '-' }}</span>
        </div>

        @if($loan->fine > 0)
        <div class="flex justify-between text-error font-medium">
            <span>Denda</span>
            <span>Rp {{ number_format($loan->fine, 0, ',', '.') }}</span>
        </div>
        @endif

    </div>

    @if($loan->status !== 'dikembalikan')
    <form action="{{ route('admin.loans.return', $loan) }}" method="POST" class="mt-4"
        onsubmit="return confirm('Konfirmasi pengembalian buku ini?')">
        @csrf @method('PATCH')
        <button class="btn btn-success w-full">✓ Proses Pengembalian</button>
    </form>
    @endif

</div>
</x-app-layout>
