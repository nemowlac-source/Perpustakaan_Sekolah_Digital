<x-app-layout>
<div class="p-6 max-w-2xl mx-auto space-y-6">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost btn-sm">← Kembali</a>
        <h2 class="text-xl font-semibold">Profil Siswa</h2>
    </div>

    {{-- Info Utama --}}
    <div class="bg-base-100 border border-base-300 rounded-xl p-5">
        <div class="flex items-center gap-4 mb-4">
            <div class="avatar placeholder">
                <div class="bg-neutral text-neutral-content rounded-full w-14">
                    <span class="text-lg">{{ strtoupper(substr($siswa->name, 0, 2)) }}</span>
                </div>
            </div>
            <div>
                <p class="text-lg font-semibold">{{ $siswa->name }}</p>
                <p class="text-sm text-base-content/60">{{ $siswa->email }}</p>
            </div>
            <div class="ml-auto text-right">
                <p class="text-2xl font-bold text-warning">🏆 {{ $siswa->points }}</p>
                <p class="text-xs text-base-content/50">Total Poin</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 text-sm">
            <div class="bg-base-200 rounded-lg p-3">
                <p class="text-base-content/60 mb-1">NIS</p>
                <p class="font-mono font-medium">{{ $siswa->nis }}</p>
            </div>
            <div class="bg-base-200 rounded-lg p-3">
                <p class="text-base-content/60 mb-1">Username</p>
                <p class="font-medium">{{ $siswa->username }}</p>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <div class="stat bg-base-200 rounded-xl p-3">
            <div class="stat-title text-xs">Total Pinjam</div>
            <div class="stat-value text-lg">{{ $stats['total_pinjam'] }}</div>
        </div>
        <div class="stat bg-base-200 rounded-xl p-3">
            <div class="stat-title text-xs">Sedang Dipinjam</div>
            <div class="stat-value text-lg text-info">{{ $stats['aktif'] }}</div>
        </div>
        <div class="stat bg-base-200 rounded-xl p-3">
            <div class="stat-title text-xs">Pernah Terlambat</div>
            <div class="stat-value text-lg text-error">{{ $stats['terlambat'] }}</div>
        </div>
        <div class="stat bg-base-200 rounded-xl p-3">
            <div class="stat-title text-xs">Total Denda</div>
            <div class="stat-value text-sm text-error">
                Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}
            </div>
        </div>
    </div>

    {{-- Riwayat Peminjaman --}}
    <div class="bg-base-100 border border-base-300 rounded-xl p-4">
        <h3 class="font-semibold mb-3">Riwayat Peminjaman</h3>
        @forelse($siswa->loans as $loan)
        <div class="flex items-center gap-3 py-2 border-b border-base-200 last:border-0">
            <div class="flex-1">
                <p class="font-medium text-sm">{{ $loan->book->title }}</p>
                <p class="text-xs text-base-content/50">
                    {{ $loan->borrow_date->format('d M Y') }} →
                    {{ $loan->due_date->format('d M Y') }}
                </p>
            </div>
            <div class="text-right">
                <span class="badge badge-sm
                    {{ $loan->status === 'dipinjam'     ? 'badge-info'    : '' }}
                    {{ $loan->status === 'dikembalikan' ? 'badge-success' : '' }}
                    {{ $loan->status === 'terlambat'    ? 'badge-error'   : '' }}">
                    {{ ucfirst($loan->status) }}
                </span>
                @if($loan->fine > 0)
                    <p class="text-xs text-error mt-1">
                        Rp {{ number_format($loan->fine, 0, ',', '.') }}
                    </p>
                @endif
            </div>
        </div>
        @empty
        <p class="text-base-content/50 text-sm">Belum ada riwayat peminjaman.</p>
        @endforelse
    </div>

    {{-- Aksi --}}
    <div class="flex gap-2">
        <a href="{{ route('admin.siswa.edit', $siswa) }}" class="btn btn-warning btn-sm">Edit Data</a>
        <form action="{{ route('admin.siswa.reset-password', $siswa) }}" method="POST"
            onsubmit="return confirm('Reset password ke NIS: {{ $siswa->nis }}?')">
            @csrf @method('PATCH')
            <button class="btn btn-ghost btn-sm">Reset Password</button>
        </form>
    </div>

</div>
</x-app-layout>
