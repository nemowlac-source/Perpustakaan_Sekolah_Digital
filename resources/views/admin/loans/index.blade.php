<x-app-layout>
    <div class="w-full space-y-6 min-w-0">

        <!-- Header Desk -->
        <div class="bg-gradient-to-br from-primary to-indigo-600 rounded-3xl p-6 md:p-8 text-primary-content shadow-lg shadow-primary/20 relative overflow-hidden flex flex-col sm:flex-row justify-between items-center gap-6">
            <!-- Decorative Background -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 rounded-full border-4 border-white/10 opacity-50 pointer-events-none"></div>
            <div class="absolute top-1/2 right-4 w-16 h-16 bg-white/20 rounded-full blur-xl transform -translate-y-1/2 pointer-events-none"></div>

            <div class="relative z-10 flex items-center gap-5 w-full sm:w-auto">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-inner border border-white/30 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-2xl sm:text-3xl font-black mb-1 truncate text-white">Sirkulasi Peminjaman</h2>
                    <p class="text-primary-content/80 font-medium text-sm truncate">Lacak aktivitas peminjaman dan pengembalian buku</p>
                </div>
            </div>

            <div class="relative z-10 shrink-0 w-full sm:w-auto flex justify-end">
                <a href="{{ route('admin.loans.create') }}" class="btn bg-white hover:bg-base-200 text-primary border-none rounded-xl font-bold px-6 shadow-md shadow-black/10 hover:-translate-y-0.5 transition-transform flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                    Catat Peminjaman
                </a>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-base-100 rounded-2xl border border-base-200 shadow-sm p-4 w-full flex flex-col md:flex-row items-center justify-between gap-4">
            <form method="GET" class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto flex-1">
                <div class="relative w-full sm:w-80">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-base-content/40" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama siswa / judul buku..." class="input input-sm h-10 w-full pl-10 bg-base-200/50 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all text-sm font-medium">
                </div>
                
                <div class="w-full sm:w-auto relative">
                    <select name="status" class="select select-sm h-10 w-full sm:w-48 bg-base-200/50 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl text-sm font-medium">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" {{ request('status') === 'dipinjam' ? 'selected' : '' }}>Tertahan (Dipinjam)</option>
                        <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Selesai (Dikembalikan)</option>
                        <option value="terlambat" {{ request('status') === 'terlambat' ? 'selected' : '' }}>Bermasalah (Terlambat)</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-sm h-10 px-5 btn-primary rounded-xl shrink-0 w-full sm:w-auto shadow-sm shadow-primary/20">Filter Data</button>
            </form>
            
            <div class="shrink-0 hidden md:block">
                <div class="text-sm font-bold text-base-content/50 uppercase tracking-wider">Total Hasil: <span class="text-primary font-black">{{ $loans->total() }}</span></div>
            </div>
        </div>

        <!-- Main Datatable -->
        <div class="bg-base-100 rounded-2xl border border-base-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="table w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-base-200/50 text-base-content/70 border-b-2 border-base-200 text-xs uppercase tracking-wider">
                            <th class="font-semibold px-6 py-4">#</th>
                            <th class="font-semibold">Informasi Siswa</th>
                            <th class="font-semibold">Detail Buku</th>
                            <th class="font-semibold">Sirkulasi Tanggal</th>
                            <th class="font-semibold text-center">Tagihan/Denda</th>
                            <th class="font-semibold text-center">Status</th>
                            <th class="font-semibold px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($loans as $loan)
                            <tr class="hover:bg-base-200/30 transition-colors group">
                                <td class="px-6 py-4 text-sm font-medium text-base-content/50">
                                    {{ $loans->firstItem() + $loop->index }}
                                </td>
                                
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-base-200 border border-base-300 flex items-center justify-center shrink-0 text-base-content/40">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-base-content text-sm">{{ $loan->user->name }}</p>
                                            <p class="text-xs font-semibold text-base-content/50 mt-0.5 tracking-wider">NIS: {{ $loan->user->nis }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-12 rounded bg-base-200 shrink-0 border border-base-300 flex items-center justify-center text-base-content/40 overflow-hidden shadow-sm">
                                            @if($loan->book->cover_image)
                                                <img src="{{ Str::startsWith($loan->book->cover_image, 'http') ? $loan->book->cover_image : Storage::url($loan->book->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                            @endif
                                        </div>
                                        <div class="max-w-[200px] sm:max-w-xs">
                                            <p class="font-bold text-sm text-base-content truncate" title="{{ $loan->book->title }}">{{ $loan->book->title }}</p>
                                            <p class="text-xs font-semibold text-primary/70 mt-0.5 truncate">{{ $loan->book->author }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2 text-[11px] font-bold text-base-content/70">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            Pinjam: {{ $loan->borrow_date->format('d M Y') }}
                                        </div>
                                        <div class="flex items-center gap-2 text-[11px] font-bold text-base-content/70">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 {{ $loan->isLate() ? 'text-error animate-pulse' : 'text-warning' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Tenggat: <span class="{{ $loan->isLate() ? 'text-error' : '' }}">{{ $loan->due_date->format('d M Y') }}</span>
                                        </div>
                                        @if($loan->status === 'dikembalikan')
                                            <div class="flex items-center gap-2 text-[11px] font-bold text-success mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                                Selesai: {{ $loan->return_date?->format('d M Y') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="py-4 text-center">
                                    @if($loan->fine > 0)
                                        <div class="inline-flex items-baseline px-3 py-1 rounded bg-error/10 border border-error/20">
                                            <span class="text-[10px] font-bold text-error mr-1">Rp</span>
                                            <span class="text-sm font-black text-error font-mono">{{ number_format($loan->fine, 0, ',', '.') }}</span>
                                        </div>
                                    @else
                                        <span class="text-base-content/30 text-xs font-bold leading-relaxed">-</span>
                                    @endif
                                </td>

                                <td class="py-4 text-center">
                                    <div class="flex flex-col items-center gap-1">
                                        @if($loan->status === 'dipinjam')
                                            <div class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-info/10 text-info text-[11px] font-bold uppercase tracking-wider w-24">
                                                <span class="w-1.5 h-1.5 rounded-full bg-info mr-1.5 animate-pulse"></span>
                                                Aktif
                                            </div>
                                        @elseif($loan->status === 'dikembalikan')
                                            <div class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-success/10 text-success text-[11px] font-bold uppercase tracking-wider w-24">
                                                Selesai
                                            </div>
                                        @elseif($loan->status === 'terlambat')
                                            <div class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-error text-white shadow-sm shadow-error/30 text-[11px] font-bold uppercase tracking-wider animate-pulse w-24">
                                                Terlambat
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.loans.show', $loan) }}" class="btn btn-sm btn-circle btn-ghost bg-base-200 hover:bg-primary hover:text-white transition-colors tooltip tooltip-left" data-tip="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>

                                        @if($loan->status !== 'dikembalikan')
                                            <form action="{{ route('admin.loans.return', $loan) }}" method="POST" onsubmit="return confirm('Siswa memulangkan buku ini?\n\nPastikan buku dalam kondisi baik. Jika terlambat, sistem akan otomatis mencetak riwayat denda pada profil siswa bersangkutan.')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm outline-none font-bold bg-success hover:bg-success/90 border-none text-white shadow-sm shadow-success/30 hover:-translate-y-0.5 transition-transform flex items-center gap-1.5 pl-3 pr-4 tooltip tooltip-left" data-tip="Proses Pengembalian">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-16">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-base-200 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        </div>
                                        <h4 class="text-xl font-bold text-base-content mb-1">Riwayat Kosong</h4>
                                        <p class="text-base-content/50 text-sm max-w-sm text-center mb-5">Belum ada catatan sirkulasi peminjaman yang relevan dengan filter yang Anda pasang.</p>
                                        <a href="{{ route('admin.loans.create') }}" class="btn btn-primary rounded-xl shadow-sm hover:-translate-y-0.5 transition-transform">Catat Pinjaman Baru</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($loans->hasPages())
                <div class="px-6 py-4 border-t border-base-200 bg-base-100/50">
                    {{ $loans->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
