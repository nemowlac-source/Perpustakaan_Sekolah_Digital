<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Dashboard Admin</h2>
    </x-slot>

    <div class="p-6 space-y-6">

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="stat bg-base-200 rounded-xl">
                <div class="stat-title">Total Buku</div>
                <div class="stat-value text-primary">{{ $stats['total_buku'] }}</div>
            </div>
            <div class="stat bg-base-200 rounded-xl">
                <div class="stat-title">Total Siswa</div>
                <div class="stat-value text-secondary">{{ $stats['total_siswa'] }}</div>
            </div>
            <div class="stat bg-base-200 rounded-xl">
                <div class="stat-title">Sedang Dipinjam</div>
                <div class="stat-value text-info">{{ $stats['dipinjam'] }}</div>
            </div>
            <div class="stat bg-base-200 rounded-xl">
                <div class="stat-title">Terlambat</div>
                <div class="stat-value text-error">{{ $stats['terlambat'] }}</div>
            </div>
            <div class="stat bg-base-200 rounded-xl">
                <div class="stat-title">Request Pending</div>
                <div class="stat-value text-warning">{{ $stats['request_pending'] }}</div>
            </div>
        </div>

        {{-- Peminjaman Terbaru --}}
        <div class="bg-base-100 rounded-xl border border-base-300 p-4">
            <h3 class="font-semibold mb-3">Peminjaman Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="table table-sm table-zebra w-full">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pinjam_terbaru as $loan)
                        <tr>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->borrow_date->format('d/m/Y') }}</td>
                            <td>{{ $loan->due_date->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge badge-sm
                                    {{ $loan->status === 'dipinjam' ? 'badge-info' : '' }}
                                    {{ $loan->status === 'dikembalikan' ? 'badge-success' : '' }}
                                    {{ $loan->status === 'terlambat' ? 'badge-error' : '' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-base-content/50">
                                Belum ada peminjaman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
