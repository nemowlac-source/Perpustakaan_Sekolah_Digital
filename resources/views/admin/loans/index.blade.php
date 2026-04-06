<x-app-layout>
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Manajemen Peminjaman</h2>
        <a href="{{ route('admin.loans.create') }}" class="btn btn-primary btn-sm">+ Catat Peminjaman</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    {{-- Filter --}}
    <form method="GET" class="flex gap-2 mb-4">
        <input name="q" value="{{ request('q') }}" placeholder="Cari nama siswa / judul buku..."
            class="input input-bordered flex-1">
        <select name="status" class="select select-bordered">
            <option value="">Semua Status</option>
            <option value="dipinjam"     {{ request('status') === 'dipinjam'     ? 'selected' : '' }}>Dipinjam</option>
            <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            <option value="terlambat"    {{ request('status') === 'terlambat'    ? 'selected' : '' }}>Terlambat</option>
        </select>
        <button class="btn btn-ghost">Filter</button>
    </form>

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Siswa</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Dikembalikan</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <p class="font-medium">{{ $loan->user->name }}</p>
                        <p class="text-xs text-base-content/50">{{ $loan->user->nis }}</p>
                    </td>
                    <td class="max-w-[160px]">
                        <p class="font-medium truncate">{{ $loan->book->title }}</p>
                        <p class="text-xs text-base-content/50">{{ $loan->book->author }}</p>
                    </td>
                    <td>{{ $loan->borrow_date->format('d/m/Y') }}</td>
                    <td>
                        {{ $loan->due_date->format('d/m/Y') }}
                        @if($loan->isLate())
                            <span class="badge badge-error badge-xs block mt-1">Lewat!</span>
                        @endif
                    </td>
                    <td>{{ $loan->return_date?->format('d/m/Y') ?? '-' }}</td>
                    <td>
                        @if($loan->fine > 0)
                            <span class="text-error font-medium">
                                Rp {{ number_format($loan->fine, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-base-content/40">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-sm
                            {{ $loan->status === 'dipinjam'     ? 'badge-info'    : '' }}
                            {{ $loan->status === 'dikembalikan' ? 'badge-success' : '' }}
                            {{ $loan->status === 'terlambat'    ? 'badge-error'   : '' }}">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td class="flex gap-1">
                        <a href="{{ route('admin.loans.show', $loan) }}"
                            class="btn btn-xs btn-ghost">Detail</a>

                        @if($loan->status !== 'dikembalikan')
                        <form action="{{ route('admin.loans.return', $loan) }}" method="POST"
                            onsubmit="return confirm('Konfirmasi pengembalian buku ini?')">
                            @csrf @method('PATCH')
                            <button class="btn btn-xs btn-success">Kembalikan</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-base-content/50 py-8">
                        Belum ada data peminjaman.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $loans->links() }}
</div>
</x-app-layout>
