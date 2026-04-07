<x-app-layout>
    <div class="w-full space-y-8">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-br from-info to-blue-600 rounded-3xl p-6 md:p-8 text-info-content shadow-xl shadow-info/30 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 right-40 w-40 h-40 bg-white/10 rounded-full blur-2xl -mb-10"></div>
            
            <div class="relative z-10 text-center md:text-left">
                <h1 class="text-3xl sm:text-4xl font-black flex items-center justify-center md:justify-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 opacity-90 text-white drop-shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    Peminjaman Saya
                </h1>
                <p class="text-info-content/80 mt-2 font-medium">Pantau buku yang sedang kamu baca dan riwayat peminjamanmu di sini.</p>
            </div>

            <!-- Quick Stats -->
            <div class="relative z-10 flex gap-4 w-full md:w-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 shadow-inner flex-1 md:w-40 flex flex-col items-center justify-center text-center">
                    <div class="text-info-content/70 text-xs font-bold uppercase tracking-wider mb-1">Buku Aktif</div>
                    <div class="text-4xl font-black drop-shadow-md">{{ $loans->where('status', '!=', 'dikembalikan')->count() }}</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 shadow-inner flex-1 md:w-48 flex flex-col items-center justify-center text-center">
                    <div class="text-info-content/70 text-xs font-bold uppercase tracking-wider mb-1">Total Denda</div>
                    <div class="text-2xl font-black drop-shadow-md flex items-end justify-center gap-1">
                        <span class="text-sm font-bold opacity-80 mb-1">Rp</span>
                        {{ number_format($loans->sum('fine'), 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-base-100 rounded-3xl border border-base-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-base-200 flex items-center justify-between bg-base-100/50">
                <h3 class="font-bold text-lg text-base-content flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-info rounded-full"></span>
                    Riwayat Peminjaman
                </h3>
            </div>
            
            <div class="overflow-x-auto w-full">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-200/50 text-base-content/70 border-b-2 border-base-200 text-sm">
                            <th class="font-semibold px-6 py-4 rounded-tl-none">Buku</th>
                            <th class="font-semibold">Tanggal Pinjam</th>
                            <th class="font-semibold">Batas Kembali</th>
                            <th class="font-semibold text-center">Status</th>
                            <th class="font-semibold text-right px-6">Denda</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($loans as $loan)
                            <tr class="hover:bg-base-200/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-16 shrink-0 bg-base-300 rounded-lg overflow-hidden shadow-sm border border-base-200 group-hover:border-info/30 transition-colors">
                                            @if($loan->book->cover)
                                                <img src="{{ Str::startsWith($loan->book->cover, 'http') ? $loan->book->cover : asset('storage/' . $loan->book->cover) }}"
                                                    alt="Cover" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-base text-base-content group-hover:text-info transition-colors leading-tight mb-1 line-clamp-2 max-w-xs md:max-w-md">{{ $loan->book->title }}</div>
                                            <div class="text-[11px] font-semibold text-base-content/50 uppercase tracking-widest">{{ $loan->book->author }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="font-semibold text-base-content/80 text-sm">
                                        {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="font-semibold text-sm {{ $loan->status == 'terlambat' ? 'text-error font-bold' : 'text-base-content/80' }}">
                                        {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="py-4 text-center">
                                    @if ($loan->status == 'dipinjam')
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-info/10 text-info border border-info/20 text-xs font-bold uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-info animate-pulse"></span>
                                            Dipinjam
                                        </div>
                                    @elseif($loan->status == 'dikembalikan')
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-success/10 text-success border border-success/20 text-xs font-bold uppercase tracking-wider">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                            Selesai
                                        </div>
                                    @else
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-error text-white shadow-sm shadow-error/30 text-xs font-bold uppercase tracking-wider animate-pulse">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                            Terlambat
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($loan->fine > 0)
                                        <div class="font-extrabold text-error">
                                            <span class="text-[10px] opacity-70 font-bold uppercase mr-0.5">Rp</span>{{ number_format($loan->fine, 0, ',', '.') }}
                                        </div>
                                    @else
                                        <span class="text-base-content/30 text-sm font-black">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <div class="w-20 h-20 bg-base-200 rounded-full flex items-center justify-center mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-base-content mb-1">Belum Ada Peminjaman</h3>
                                        <p class="text-base-content/60 text-sm max-w-xs mb-5">Kamu belum pernah meminjam buku apa pun. Ayo mulai mengeksplorasi perpustakaan!</p>
                                        <a href="{{ route('siswa.dashboard') }}" class="btn btn-info text-info-content rounded-xl shadow-md shadow-info/20 px-8 hover:-translate-y-0.5 transition-transform">Cari Buku Sekarang</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($loans->hasPages())
                <div class="px-6 py-4 border-t border-base-200 bg-base-50">
                    {{ $loans->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
