<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-base-content">Peminjaman Saya</h1>
                <p class="text-sm text-base-content/60">Pantau buku yang sedang kamu baca dan riwayat pinjamanmu.</p>
            </div>

            <!-- Quick Stats -->
            <div class="stats shadow bg-base-100 border border-base-300">
                <div class="stat py-2 px-4">
                    <div class="stat-title text-xs">Buku Aktif</div>
                    <div class="stat-value text-primary text-2xl">
                        {{ $loans->where('status', '!=', 'returned')->count() }}</div>
                </div>
                <div class="stat py-2 px-4">
                    <div class="stat-title text-xs">Total Denda</div>
                    <div class="stat-value text-error text-2xl">
                        <span class="text-sm">Rp</span>{{ number_format($loans->sum('fine'), 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr class="bg-base-200">
                            <th>No</th>
                            <th>Info Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Batas Kembali</th>
                            <th class="text-center">Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                            <tr class="hover">
                                <th>{{ $loop->iteration + ($loans->currentPage() - 1) * $loans->perPage() }}</th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-10 h-10 bg-base-200">
                                                {{-- Ganti dengan path cover buku jika ada --}}
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($loan->book->title) }}&background=random"
                                                    alt="Cover" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold text-sm">{{ $loan->book->title }}</div>
                                            <div class="text-xs opacity-50">{{ $loan->book->author }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm italic">
                                    {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}
                                </td>
                                <td class="text-sm">
                                    <span class="{{ $loan->status == 'terlambat' ? 'text-error font-bold' : '' }}">
                                        {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($loan->status == 'dipinjam')
                                        <span class="badge badge-info badge-sm gap-1">Dipinjam</span>
                                    @elseif($loan->status == 'dikembalikan')
                                        <span class="badge badge-success badge-sm gap-1">Dikembalikan</span>
                                    @else
                                        <span
                                            class="badge badge-error badge-sm gap-1 font-bold animate-pulse text-white">Terlambat</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 opacity-20"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <p class="text-base-content/50 italic">Kamu belum pernah meminjam buku apapun.
                                        </p>
                                        <a href="{{ route('siswa.dashboard') }}"
                                            class="btn btn-sm btn-primary mt-2">Cari Buku</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    </div>
</x-app-layout>
