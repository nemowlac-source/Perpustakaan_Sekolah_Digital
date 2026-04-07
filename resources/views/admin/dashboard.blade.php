<x-app-layout>
    <div class="w-full space-y-8 min-w-0">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-br from-primary to-indigo-600 rounded-3xl p-6 md:p-10 text-primary-content shadow-xl shadow-primary/20 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full border-4 border-white/10 opacity-50 pointer-events-none"></div>
            <div class="absolute bottom-0 right-32 -mb-20 w-40 h-40 rounded-full border-4 border-white/10 opacity-50 pointer-events-none"></div>
            <div class="absolute top-1/2 right-10 w-24 h-24 bg-white/10 rounded-full blur-2xl transform -translate-y-1/2 pointer-events-none"></div>
            
            <div class="relative z-10 text-center md:text-left flex items-center gap-6">
                <div class="hidden md:flex shrink-0 w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm items-center justify-center shadow-inner border border-white/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <div class="min-w-0">
                    <h1 class="text-3xl sm:text-4xl font-black mb-2 truncate">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-primary-content/80 font-medium text-sm sm:text-base max-w-xl">
                        Selamat datang di Pusat Kendali Perpustakaan. Kelola sirkulasi buku, request, dan aktivitas siswa hari ini.
                    </p>
                </div>
            </div>

            <!-- Quick Action / Focus -->
            <div class="relative z-10 shrink-0 mt-4 md:mt-0 w-full md:w-auto flex justify-center md:justify-end">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 shadow-inner flex items-center gap-4">
                    <div class="bg-white/20 rounded-xl p-3 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <div class="text-left">
                        <div class="text-primary-content/70 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-0.5">Hari Ini</div>
                        <div class="font-black text-sm sm:text-base md:text-lg whitespace-nowrap">{{ \Carbon\Carbon::now()->translatedFormat('l, d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Cards Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-6">
            <div class="min-w-0 bg-base-100 rounded-3xl border border-base-200 shadow-sm p-4 sm:p-5 hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                <div class="flex flex-col gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div class="min-w-0 break-words">
                        <div class="text-base-content/50 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1 line-clamp-1">Total Buku</div>
                        <div class="text-2xl sm:text-3xl font-black text-base-content">{{ $stats['total_buku'] }}</div>
                    </div>
                </div>
            </div>

            <div class="min-w-0 bg-base-100 rounded-3xl border border-base-200 shadow-sm p-4 sm:p-5 hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                <div class="flex flex-col gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-green-500/10 text-green-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="min-w-0 break-words">
                        <div class="text-base-content/50 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1 line-clamp-1">Total Siswa</div>
                        <div class="text-2xl sm:text-3xl font-black text-base-content">{{ $stats['total_siswa'] }}</div>
                    </div>
                </div>
            </div>

            <div class="min-w-0 bg-base-100 rounded-3xl border border-base-200 shadow-sm p-4 sm:p-5 hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                <div class="flex flex-col gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-info/10 text-info flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="min-w-0 break-words">
                        <div class="text-base-content/50 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1 line-clamp-1">Sedang Dipinjam</div>
                        <div class="text-2xl sm:text-3xl font-black text-base-content">{{ $stats['dipinjam'] }}</div>
                    </div>
                </div>
            </div>

            <div class="min-w-0 bg-base-100 rounded-3xl border border-base-200 shadow-sm p-4 sm:p-5 hover:-translate-y-1 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                <div class="absolute inset-0 bg-error/5 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-500 ease-out z-0"></div>
                <div class="flex flex-col gap-3 relative z-10">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-error/10 text-error flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                    </div>
                    <div class="min-w-0 break-words">
                        <div class="text-base-content/50 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1 line-clamp-1">Terlambat</div>
                        <div class="text-2xl sm:text-3xl font-black text-error drop-shadow-sm">{{ $stats['terlambat'] }}</div>
                    </div>
                </div>
            </div>

            <div class="min-w-0 bg-base-100 rounded-3xl border border-base-200 shadow-sm p-4 sm:p-5 hover:-translate-y-1 hover:shadow-md transition-all duration-300 col-span-2 lg:col-span-1 xl:col-span-1 relative overflow-hidden group">
                <div class="absolute inset-0 bg-warning/5 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-500 ease-out z-0"></div>
                <div class="flex flex-col gap-3 relative z-10 w-full">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-warning/10 text-warning flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <div class="flex justify-between items-end gap-2 w-full">
                        <div class="min-w-0 break-words flex-1">
                            <div class="text-base-content/50 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1 line-clamp-1">Request Pending</div>
                            <div class="text-2xl sm:text-3xl font-black text-warning drop-shadow-sm">{{ $stats['request_pending'] }}</div>
                        </div>
                        @if($stats['request_pending'] > 0)
                            <a href="{{ route('admin.book-requests.index') }}" class="btn btn-xs rounded-full font-bold bg-warning/20 border-none text-warning hover:bg-warning hover:text-white shrink-0">Tinjau</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Peminjaman Terbaru Section --}}
        <div class="bg-base-100 rounded-3xl border border-base-200 shadow-sm overflow-hidden">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-base-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 bg-base-100/50">
                <div class="flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-info rounded-full"></span>
                    <h3 class="font-bold text-base sm:text-lg text-base-content">Peminjaman Terbaru</h3>
                </div>
                <a href="{{ route('admin.loans.index') }}" class="btn btn-sm btn-ghost text-primary text-xs sm:text-sm">Lihat Semua →</a>
            </div>
            
            <div class="overflow-x-auto w-full">
                <table class="table w-full min-w-[700px]">
                    <thead>
                        <tr class="bg-base-200/50 text-base-content/70 border-b-2 border-base-200 text-xs sm:text-sm">
                            <th class="font-semibold px-4 sm:px-6 py-4">Peminjam (Siswa)</th>
                            <th class="font-semibold">Buku Terpinjam</th>
                            <th class="font-semibold">Tgl Pinjam</th>
                            <th class="font-semibold">Jatuh Tempo</th>
                            <th class="font-semibold text-center px-4 sm:px-6">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($pinjam_terbaru as $loan)
                            <tr class="hover:bg-base-200/30 transition-colors group text-sm">
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="font-bold text-base-content whitespace-nowrap">{{ $loan->user->name }}</div>
                                </td>
                                <td class="py-4">
                                    <div class="font-semibold text-base-content group-hover:text-primary transition-colors max-w-[200px] sm:max-w-xs truncate" title="{{ $loan->book->title }}">
                                        {{ $loan->book->title }}
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="font-medium text-base-content/80 whitespace-nowrap">
                                        {{ $loan->borrow_date->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="font-semibold whitespace-nowrap {{ $loan->status === 'terlambat' ? 'text-error font-bold' : 'text-base-content/80' }}">
                                        {{ $loan->due_date->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="py-4 px-4 sm:px-6 text-center">
                                    @if($loan->status === 'dipinjam')
                                        <div class="inline-flex items-center justify-center px-2 sm:px-3 py-1 sm:py-1.5 rounded-full bg-info/10 text-info text-[10px] sm:text-[11px] font-bold uppercase tracking-wider w-full max-w-[100px] sm:max-w-[120px]">
                                            Dipinjam
                                        </div>
                                    @elseif($loan->status === 'dikembalikan')
                                        <div class="inline-flex items-center justify-center px-2 sm:px-3 py-1 sm:py-1.5 rounded-full bg-success/10 text-success text-[10px] sm:text-[11px] font-bold uppercase tracking-wider w-full max-w-[100px] sm:max-w-[120px]">
                                            Selesai
                                        </div>
                                    @elseif($loan->status === 'terlambat')
                                        <div class="inline-flex items-center justify-center px-2 sm:px-3 py-1 sm:py-1.5 rounded-full bg-error text-white shadow-sm shadow-error/30 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider animate-pulse w-full max-w-[100px] sm:max-w-[120px]">
                                            Terlambat
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 sm:py-16">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-base-200 rounded-full flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                        </div>
                                        <h4 class="font-bold text-base sm:text-lg text-base-content">Belum Ada Riwayat Peminjaman</h4>
                                        <p class="text-base-content/50 text-xs sm:text-sm">Aktivitas peminjaman terbaru akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
