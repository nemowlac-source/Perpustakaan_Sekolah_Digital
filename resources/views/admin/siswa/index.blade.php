<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-secondary rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-secondary-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-base-content">Manajemen Anggota Siswa</h2>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Quick Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="stat bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl shadow-lg">
                <div class="stat-figure text-white/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="stat-title text-white/80">Total Siswa</div>
                <div class="stat-value">{{ $siswas->total() }}</div>
            </div>
            <div class="stat bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg">
                <div class="stat-figure text-white/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="stat-title text-white/80">Aktif</div>
                <div class="stat-value">{{ $siswas->where('is_active', true)->count() }}</div>
            </div>
            <div class="stat bg-gradient-to-br from-yellow-500 to-orange-500 text-white rounded-xl shadow-lg">
                <div class="stat-figure text-white/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="stat-title text-white/80">Menunggu</div>
                <div class="stat-value">{{ $siswas->where('is_active', false)->count() }}</div>
            </div>
            <div class="stat bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl shadow-lg">
                <div class="stat-figure text-white/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                </div>
                <div class="stat-title text-white/80">Total Poin</div>
                <div class="stat-value">{{ $siswas->sum('points') }}</div>
            </div>
        </div>

        {{-- Search and Actions --}}
        <div class="bg-base-100 rounded-xl border border-base-300 p-6 shadow-lg">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <h3 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Pencarian & Aksi
                </h3>
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Siswa
                </a>
            </div>

            {{-- Search Form --}}
            <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-4">
                <div class="flex-1">
                    <input name="q" value="{{ request('q') }}" placeholder="Cari nama / NIS / username..."
                        class="input input-bordered w-full">
                </div>
                <div class="flex gap-2">
                    <button class="btn btn-primary">Cari</button>
                    @if (request('q'))
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Bulk Import --}}
            <div class="border-t border-base-300 pt-4">
                <h4 class="font-medium mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                    Bulk Import Siswa (Excel)
                </h4>
                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <input type="file" name="file" required
                        class="file-input file-input-bordered file-input-primary">
                    <button type="submit" class="btn btn-info">Import Sekarang</button>
                </form>
            </div>
        </div>

        {{-- Students Table --}}
        <div class="bg-base-100 rounded-xl border border-base-300 shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-base-300">
                <h3 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Daftar Siswa
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-base-200">
                        <tr>
                            <th class="font-semibold">#</th>
                            <th class="font-semibold">Nama</th>
                            <th class="font-semibold">NIS</th>
                            <th class="font-semibold">Username</th>
                            <th class="font-semibold">Email</th>
                            <th class="font-semibold">Status</th>
                            <th class="font-semibold">Poin</th>
                            <th class="font-semibold">Pinjaman</th>
                            <th class="font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $siswa)
                            <tr class="hover:bg-base-200/50">
                                <td class="font-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-neutral text-neutral-content rounded-full w-10 h-10">
                                                <span
                                                    class="text-sm font-semibold">{{ strtoupper(substr($siswa->name, 0, 2)) }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-medium">{{ $siswa->name }}</div>
                                            <div class="text-sm text-base-content/60">{{ $siswa->nis }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="font-mono text-sm font-medium">{{ $siswa->nis }}</td>
                                <td class="font-medium">{{ $siswa->username }}</td>
                                <td class="text-sm">{{ $siswa->email }}</td>
                                <td>
                                    @if ($siswa->is_active)
                                        <span class="badge badge-success badge-sm font-medium">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge badge-warning badge-sm font-medium">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Menunggu
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-warning badge-sm font-medium">
                                        🏆 {{ $siswa->points }}
                                    </span>
                                </td>
                                <td>
                                    <div class="text-sm">
                                        <div class="font-medium">{{ $siswa->loans_count }} total</div>
                                        @if ($siswa->aktif_count > 0)
                                            <span class="badge badge-info badge-xs">
                                                {{ $siswa->aktif_count }} aktif
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="flex gap-1 flex-wrap">
                                        {{-- TOMBOL AKTIFKAN (Hanya muncul jika belum aktif) --}}
                                        @if (!$siswa->is_active)
                                            <form action="{{ route('admin.konfirmasi', $siswa->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-xs btn-success text-white tooltip"
                                                    data-tip="Konfirmasi Siswa">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.siswa.show', $siswa) }}"
                                            class="btn btn-xs btn-info tooltip" data-tip="Lihat Detail">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.siswa.edit', $siswa) }}"
                                            class="btn btn-xs btn-warning tooltip" data-tip="Edit Siswa">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>

                                        {{-- Reset Password --}}
                                        <form action="{{ route('admin.siswa.reset-password', $siswa) }}"
                                            method="POST" onsubmit="return confirm('Reset password ke NIS siswa?')"
                                            class="inline">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-xs btn-ghost tooltip" data-tip="Reset Password">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.siswa.destroy', $siswa) }}" method="POST"
                                            onsubmit="return confirm('Hapus akun {{ $siswa->name }}?')"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-xs btn-error tooltip" data-tip="Hapus Siswa">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
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
                                <td colspan="9" class="text-center text-base-content/50 py-12">
                                    <div class="flex flex-col items-center gap-4">
                                        <svg class="w-16 h-16 text-base-content/30" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        <div>
                                            <p class="text-lg font-medium">Belum ada data siswa</p>
                                            <p class="text-sm">Tambahkan siswa pertama untuk memulai</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($siswas->hasPages())
                <div class="px-6 py-4 border-t border-base-300 bg-base-200/50">
                    {{ $siswas->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
