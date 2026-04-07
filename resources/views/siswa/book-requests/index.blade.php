<x-app-layout>
    <div class="w-full space-y-8">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-6 md:p-10 text-white shadow-xl shadow-indigo-500/30 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 right-40 w-40 h-40 bg-white/10 rounded-full blur-2xl -mb-10"></div>
            
            <div class="relative z-10 text-center md:text-left">
                <h1 class="text-3xl sm:text-4xl font-black flex items-center justify-center md:justify-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-inner">
                        <span class="text-2xl drop-shadow-sm">📬</span>
                    </div>
                    Request Buku Baru
                </h1>
                <p class="text-white/80 mt-3 font-medium max-w-xl">
                    Punya rekomendasi buku keren yang belum ada di perpustakaan? Ajukan usulanmu di sini dan dapatkan poin saat disetujui!
                </p>
            </div>

            <div class="relative z-10 shrink-0">
                <a href="{{ route('siswa.book-requests.create') }}" class="btn bg-white text-indigo-600 hover:bg-base-200 border-none rounded-xl font-bold shadow-lg shadow-black/10 hover:-translate-y-0.5 transition-transform px-6 h-12 min-h-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                    Ajukan Request Baru
                </a>
            </div>
        </div>

        <!-- Request Board / List -->
        <div class="flex items-center gap-3 mb-2 px-2">
            <span class="w-1.5 h-6 bg-indigo-500 rounded-full inline-block"></span>
            <h2 class="text-xl font-bold text-base-content">Riwayat Usulanmu</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($requests as $req)
                <div class="card bg-base-100 border border-base-200 shadow-sm hover:shadow-md hover:border-indigo-500/30 transition-all duration-300">
                    <div class="card-body p-6 flex flex-col h-full gap-4 relative">
                        
                        <!-- Header Card -->
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="font-bold text-lg text-base-content leading-tight group-hover:text-indigo-600 transition-colors">{{ $req->book_title }}</h3>
                                @if($req->author)
                                    <p class="text-xs font-semibold text-base-content/50 uppercase tracking-wider mt-1">{{ $req->author }}</p>
                                @endif
                            </div>
                            <div class="shrink-0">
                                @if($req->status === 'pending')
                                    <div class="badge bg-warning/10 text-warning border border-warning/20 font-bold text-xs uppercase py-3 px-3 shadow-sm">⏳ Pending</div>
                                @elseif($req->status === 'disetujui')
                                    <div class="badge bg-success/10 text-success border border-success/20 font-bold text-xs uppercase py-3 px-3 shadow-sm">✅ Disetujui</div>
                                @elseif($req->status === 'ditolak')
                                    <div class="badge bg-error/10 text-error border border-error/20 font-bold text-xs uppercase py-3 px-3 shadow-sm">❌ Ditolak</div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="flex-1 space-y-3">
                            <div class="bg-base-200/50 rounded-xl p-3 text-sm border border-base-200/60">
                                <span class="block text-[11px] font-bold text-base-content/40 uppercase mb-0.5">Alasan/Catatan Usulan:</span>
                                <span class="font-medium text-base-content/80">{{ $req->reason }}</span>
                            </div>

                            @if($req->rejection_reason)
                                <div class="bg-error/5 border border-error/20 rounded-xl p-3 text-sm">
                                    <span class="flex items-center gap-1.5 text-[11px] font-bold text-error uppercase mb-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                        Alasan Penolakan:
                                    </span>
                                    <span class="font-medium text-error/90">{{ $req->rejection_reason }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Footer Card -->
                        <div class="flex items-center justify-between border-t border-base-200/60 pt-4 mt-auto">
                            <div class="flex items-center gap-1.5 text-[11px] font-medium text-base-content/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $req->created_at->diffForHumans() }}
                            </div>
                            
                            <div class="flex items-center gap-2">
                                @if($req->status === 'disetujui')
                                    <div class="flex items-center gap-1 text-xs font-bold text-success bg-success/10 px-2 py-1 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        +5 poin
                                    </div>
                                @endif

                                @if($req->status === 'pending')
                                    <form action="{{ route('siswa.book-requests.destroy', $req) }}" method="POST"
                                        onsubmit="return confirm('Apakah kamu yakin ingin membatalkan usulan buku ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-xs outline-none bg-base-100 hover:bg-error/10 text-base-content/50 hover:text-error border border-base-300 hover:border-error/30 transition-colors">Batalkan</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 flex flex-col items-center justify-center bg-base-100 rounded-3xl border border-dashed border-base-300">
                    <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mb-5 border-4 border-white shadow-sm">
                        <span class="text-4xl drop-shadow-sm">📭</span>
                    </div>
                    <h3 class="text-xl font-bold text-base-content mb-2">Belum ada request buku</h3>
                    <p class="text-base-content/60 text-sm max-w-sm text-center mb-6">Punya rekomendasi buku bacaan yang bagus? Jangan diam saja, ayo ajukan usulanmu sekarang!</p>
                    <a href="{{ route('siswa.book-requests.create') }}" class="btn btn-light rounded-xl shadow-md shadow-primary/20 px-8 hover:-translate-y-0.5 transition-transform">
                        Buat Request Pertama
                    </a>
                </div>
            @endforelse
        </div>

        @if($requests->hasPages())
            <div class="flex justify-center w-full bg-base-100 p-2 rounded-2xl border border-base-200 shadow-sm mt-4">
                {{ $requests->links() }}
            </div>
        @endif
        
    </div>
</x-app-layout>
