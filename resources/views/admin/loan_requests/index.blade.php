<x-app-layout>
    <div class="w-full space-y-6 min-w-0">

        <!-- Header Desk -->
        <div class="bg-gradient-to-br from-emerald-500 to-teal-700 rounded-3xl p-6 md:p-8 text-primary-content shadow-lg shadow-teal-500/20 relative overflow-hidden flex flex-col sm:flex-row justify-between items-center gap-6">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 rounded-full border-4 border-white/10 opacity-50 pointer-events-none"></div>
            <div class="absolute top-1/2 right-4 w-16 h-16 bg-white/20 rounded-full blur-xl transform -translate-y-1/2 pointer-events-none"></div>

            <div class="relative z-10 flex items-center gap-5 w-full sm:w-auto">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-inner border border-white/30 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-2xl sm:text-3xl font-black mb-1 truncate text-white drop-shadow-sm">Verifikasi Reservasi</h2>
                    <p class="text-emerald-100 font-medium text-sm truncate">Tinjau dan setujui permohonan pinjam buku baru dari siswa</p>
                </div>
            </div>

            <div class="relative z-10 shrink-0 bg-white/10 backdrop-blur-md rounded-2xl p-3 px-5 border border-white/20 shadow-inner flex items-center gap-4">
                <div class="text-right flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-red-400 animate-ping"></div>
                    <div>
                        <p class="text-xs font-bold text-white/70 uppercase">Antrean Baru</p>
                        <p class="text-xl font-black text-white">{{ $requests->count() }} <span class="text-xs font-bold text-white/70">Permohonan</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Datatable -->
        <div class="bg-base-100 rounded-2xl border border-base-200 shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-5 border-b border-base-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-base-100/50">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                    <h3 class="font-bold text-lg text-base-content">Daftar Reservasi Pending</h3>
                </div>
            </div>

            <div class="overflow-x-auto w-full flex-1">
                <table class="table w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-base-200/50 text-base-content/70 border-b-2 border-base-200 text-xs uppercase tracking-wider">
                            <th class="font-semibold px-6 py-4">Pemohon</th>
                            <th class="font-semibold">Buku Pilihan</th>
                            <th class="font-semibold text-center">Tgl Pengajuan</th>
                            <th class="font-semibold text-center">Stok Gudang</th>
                            <th class="font-semibold text-center px-6">Tindakan Khusus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($requests as $req)
                            <tr class="hover:bg-base-200/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-neutral text-neutral-content rounded-full w-10 border border-base-300">
                                                <span class="text-xs font-bold">{{ strtoupper(substr($req->user->name, 0, 2)) }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-bold text-base-content text-sm">{{ $req->user->name }}</p>
                                            <p class="text-[11px] font-semibold text-base-content/50 uppercase tracking-wider mt-0.5">UID: {{ $req->user->username }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-12 rounded bg-base-200 shrink-0 border border-base-300 flex items-center justify-center text-base-content/40 overflow-hidden shadow-sm">
                                            @if($req->book->cover_image)
                                                <img src="{{ Str::startsWith($req->book->cover_image, 'http') ? $req->book->cover_image : Storage::url($req->book->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                            @endif
                                        </div>
                                        <div class="max-w-[200px] sm:max-w-xs">
                                            <p class="font-bold text-sm text-base-content truncate" title="{{ $req->book->title }}">{{ $req->book->title }}</p>
                                            <p class="text-xs font-semibold text-primary/70 mt-0.5 truncate">{{ $req->book->author }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 text-center">
                                    <div class="inline-flex items-center gap-2 text-[11px] font-bold text-base-content/70 bg-base-200/60 px-3 py-1.5 rounded-lg border border-base-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $req->created_at->format('d/m/Y - H:i') }}
                                    </div>
                                </td>

                                <td class="py-4 text-center">
                                    <div class="flex flex-col items-center justify-center gap-1">
                                        @if($req->book->stock > 0)
                                            <div class="inline-flex items-center px-3 py-1 rounded bg-success/10 border border-success/20">
                                                <span class="text-sm font-black text-success">{{ $req->book->stock }} <span class="text-[10px] uppercase tracking-wider ml-0.5 opacity-80">Unit</span></span>
                                            </div>
                                            <span class="text-[10px] font-bold text-success/70 uppercase">Tersedia</span>
                                        @else
                                            <div class="inline-flex items-center px-3 py-1 rounded bg-error/10 border border-error/20">
                                                <span class="text-sm font-black text-error">0 <span class="text-[10px] uppercase tracking-wider ml-0.5 opacity-80">Unit</span></span>
                                            </div>
                                            <span class="text-[10px] font-bold text-error/70 uppercase">Habis</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Tombol Setuju --}}
                                        <form action="{{ route('admin.loan-requests.approve', $req->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm bg-emerald-500 hover:bg-emerald-600 border-none text-white shadow-sm shadow-emerald-500/30 hover:-translate-y-0.5 transition-transform" onclick="return confirm('Apakah siswa bersangkutan sudah di meja admin dan buku siap diserahkan fisik?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                                Serahkan
                                            </button>
                                        </form>

                                        {{-- Tombol Tolak --}}
                                        <form action="{{ route('admin.loan-requests.reject', $req->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-ghost text-error hover:bg-error/10 hover:border-error/20 transition-colors tooltip tooltip-top" data-tip="Tolak / Batalkan Permohonan" onclick="return confirm('Anda yakin ingin menolak permohonan peminjaman ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-16">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-base-200 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                        </div>
                                        <h4 class="text-xl font-bold text-base-content mb-1">Semua Tenang</h4>
                                        <p class="text-base-content/50 text-sm max-w-sm text-center mb-5">Belum ada permintaan / reservasi buku terbaru dari siswa yang menunggu diantre.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(method_exists($requests, 'hasPages') && $requests->hasPages())
                <div class="px-6 py-4 border-t border-base-200 bg-base-100/50">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
