<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-info rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-info-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-base-content">Profil Siswa</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-base-content/60">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('admin.siswa.index') }}" class="hover:text-primary transition-colors">Manajemen Siswa</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-base-content">{{ $siswa->name }}</span>
        </nav>

        {{-- Profile Header Card --}}
        <div class="bg-gradient-to-r from-info to-info-focus text-info-content rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center gap-6">
                    <div class="avatar placeholder">
                        <div class="bg-info-content text-info rounded-full w-24 h-24">
                            <span class="text-3xl font-bold">{{ strtoupper(substr($siswa->name, 0, 2)) }}</span>
                        </div>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2">{{ $siswa->name }}</h3>
                        <p class="text-info-content/80 mb-4">{{ $siswa->email }}</p>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-info-content/10 rounded-lg p-3 text-center">
                                <div class="text-lg font-bold">{{ $siswa->nis }}</div>
                                <div class="text-xs text-info-content/70">NIS</div>
                            </div>
                            <div class="bg-info-content/10 rounded-lg p-3 text-center">
                                <div class="text-lg font-bold">{{ $siswa->username }}</div>
                                <div class="text-xs text-info-content/70">Username</div>
                            </div>
                            <div class="bg-warning rounded-lg p-3 text-center text-warning-content">
                                <div class="text-lg font-bold">🏆 {{ $siswa->points }}</div>
                                <div class="text-xs">Poin</div>
                            </div>
                            <div class="bg-info-content/10 rounded-lg p-3 text-center">
                                <span
                                    class="badge badge-sm {{ $siswa->is_active ? 'badge-success' : 'badge-warning' }} text-xs">
                                    {{ $siswa->is_active ? 'Aktif' : 'Menunggu' }}
                                </span>
                                <div class="text-xs text-info-content/70 mt-1">Status</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg">
                <div class="stat-figure text-white/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <div class="stat-title text-white/80">Total Pinjam</div>
                <div class="stat-value">{{ $stats['total_pinjam'] }}</div>
            </div>

            <div class="stat bg-gradient-to-br from-cyan-500 to-cyan-600 text-white rounded-xl shadow-lg">
                <div class="stat-figure text-white/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="stat-title text-white/80">Sedang Dipinjam</div>
                <div class="stat-value">{{ $stats['aktif'] }}</div>
            </div>

            <div class="stat bg-gradient-to-br from-red-500 to-red-600 text-white rounded-xl shadow-lg">
                <div class="stat-figure text-white/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                </div>
                <div class="stat-title text-white/80">Pernah Terlambat</div>
                <div class="stat-value">{{ $stats['terlambat'] }}</div>
            </div>

            <div class="stat bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-xl shadow-lg">
                <div class="stat-figure text-white/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                </div>
                <div class="stat-title text-white/80">Total Denda</div>
                <div class="stat-value text-sm">Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- Loan History --}}
        <div class="bg-base-100 rounded-xl border border-base-300 shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-base-300 bg-base-200/50">
                <h3 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    Riwayat Peminjaman
                </h3>
            </div>

            <div class="divide-y divide-base-200">
                @forelse($siswa->loans as $loan)
                    <div class="p-6 hover:bg-base-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-start gap-4">
                                    <div class="avatar placeholder flex-shrink-0">
                                        <div class="bg-neutral text-neutral-content rounded-lg w-12 h-12">
                                            <span class="text-sm font-semibold">📚</span>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-semibold text-base-content truncate">{{ $loan->book->title }}
                                        </h4>
                                        <p class="text-sm text-base-content/60 mt-1">
                                            Dipinjam: {{ $loan->borrow_date->format('d M Y') }} •
                                            Jatuh Tempo: {{ $loan->due_date->format('d M Y') }}
                                        </p>
                                        @if ($loan->returned_date)
                                            <p class="text-sm text-base-content/60">
                                                Dikembalikan: {{ $loan->returned_date->format('d M Y') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="text-right ml-4">
                                <span
                                    class="badge badge-sm font-medium mb-2
                                    {{ $loan->status === 'dipinjam' ? 'badge-info' : '' }}
                                    {{ $loan->status === 'dikembalikan' ? 'badge-success' : '' }}
                                    {{ $loan->status === 'terlambat' ? 'badge-error' : '' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                                @if ($loan->fine > 0)
                                    <div class="text-sm text-error font-medium mt-1">
                                        Denda: Rp {{ number_format($loan->fine, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <svg class="w-16 h-16 text-base-content/30" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <div>
                                <p class="text-lg font-medium text-base-content/60">Belum ada riwayat peminjaman</p>
                                <p class="text-sm text-base-content/40">Siswa belum pernah meminjam buku</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="bg-base-100 rounded-xl border border-base-300 p-6 shadow-lg">
            <h4 class="font-semibold mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Aksi
            </h4>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.siswa.edit', $siswa) }}" class="btn btn-warning">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Data
                </a>

                <form action="{{ route('admin.siswa.reset-password', $siswa) }}" method="POST"
                    onsubmit="return confirm('Reset password ke NIS: {{ $siswa->nis }}?')" class="inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-ghost">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                        Reset Password
                    </button>
                </form>

                <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost ml-auto">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
