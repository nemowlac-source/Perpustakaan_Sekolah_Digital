<x-app-layout>
<div class="w-full max-w-4xl mx-auto space-y-6 min-w-0 py-4 sm:py-8">

    <!-- Navbar / Breadcrumb -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.loans.index') }}" class="btn btn-sm btn-circle btn-ghost bg-base-200 hover:bg-base-300 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
        </a>
        <h2 class="text-xl sm:text-2xl font-black text-base-content">Detail Peminjaman</h2>
        
        <div class="ml-auto">
            @if($loan->status === 'dipinjam')
                <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-info/10 border border-info/20 text-info text-xs font-bold uppercase tracking-wider shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-info mr-2 animate-pulse"></span> Sedang Dipinjam
                </div>
            @elseif($loan->status === 'dikembalikan')
                <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-success/10 border border-success/20 text-success text-xs font-bold uppercase tracking-wider shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg> Selesai
                </div>
            @elseif($loan->status === 'terlambat')
                <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-error text-white shadow-md shadow-error/30 text-xs font-bold uppercase tracking-wider animate-pulse">
                    ⚠️ Terlambat
                </div>
            @endif
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        
        <!-- Kolom Info Buku & User -->
        <div class="md:col-span-2 space-y-6">
            <!-- Kartu Buku -->
            <div class="bg-base-100 rounded-3xl border border-base-200 shadow-sm p-6 sm:p-8 flex flex-col sm:flex-row gap-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[100px] pointer-events-none group-hover:scale-110 transition-transform"></div>
                
                <div class="w-full sm:w-32 h-44 rounded-xl bg-base-200 shrink-0 border border-base-300 flex items-center justify-center text-base-content/40 overflow-hidden shadow-md relative z-10">
                    @if($loan->book->cover_image)
                        <img src="{{ Str::startsWith($loan->book->cover_image, 'http') ? $loan->book->cover_image : Storage::url($loan->book->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    @endif
                </div>

                <div class="flex-1 space-y-4 relative z-10">
                    <div>
                        <div class="text-[10px] font-bold text-primary/70 uppercase tracking-widest mb-1">{{ preg_replace('/[^a-zA-Z0-9]/', ' ', $loan->book->category->name ?? 'Buku') }}</div>
                        <h3 class="font-black text-xl text-base-content leading-tight mb-1">{{ $loan->book->title }}</h3>
                        <p class="text-sm font-semibold text-base-content/60">{{ $loan->book->author }}</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <div class="px-3 py-1.5 bg-base-200 rounded-lg border border-base-300">
                            <span class="text-[10px] font-bold text-base-content/50 uppercase block mb-0.5">ISBN</span>
                            <span class="text-xs font-mono font-bold text-base-content/80">{{ $loan->book->isbn ?: 'Tidak tersedia' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Siswa -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl border border-slate-700 shadow-lg p-6 sm:p-8 flex items-center gap-5 relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/5 rounded-full blur-xl pointer-events-none"></div>

                <div class="avatar placeholder shrink-0 relative z-10">
                    <div class="bg-slate-700 text-slate-300 rounded-2xl w-16 h-16 ring-2 ring-slate-600 ring-offset-slate-900 ring-offset-2">
                        <span class="text-2xl font-black">{{ strtoupper(substr($loan->user->name, 0, 2)) }}</span>
                    </div>
                </div>

                <div class="relative z-10">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Identitas Peminjam</div>
                    <h3 class="font-bold text-lg text-white">{{ $loan->user->name }}</h3>
                    <p class="text-xs font-medium text-slate-400 mt-0.5">Nomor Induk Siswa : <span class="text-slate-300 tracking-wider font-semibold">{{ $loan->user->nis }}</span></p>
                </div>
            </div>
        </div>

        <!-- Kolom Info Sirkulasi / Waktu -->
        <div class="space-y-6">
            <div class="bg-base-100 rounded-3xl border border-base-200 shadow-sm p-6 relative overflow-hidden">
                <h4 class="font-black text-base-content mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Jadwal Sirkulasi
                </h4>

                <div class="space-y-5">
                    <!-- Tgl Pinjam -->
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-info/10 text-info flex items-center justify-center shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" /></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-base-content/50 uppercase tracking-wider mb-0.5">Mulai Pinjam</p>
                            <p class="font-semibold text-sm text-base-content">{{ $loan->borrow_date->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Garis Penghubung -->
                    <div class="ml-4 w-0.5 h-6 bg-base-200 -my-3"></div>

                    <!-- Jatuh Tempo -->
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-warning/10 text-warning flex items-center justify-center shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-base-content/50 uppercase tracking-wider mb-0.5">Tenggat Pengembalian</p>
                            <p class="font-semibold text-sm {{ $loan->isLate() ? 'text-error animate-pulse' : 'text-base-content' }}">{{ $loan->due_date->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Garis Penghubung -->
                    <div class="ml-4 w-0.5 h-6 bg-base-200 -my-3"></div>

                    <!-- Tgl Kembali -->
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full {{ $loan->return_date ? 'bg-success/10 text-success' : 'bg-base-200 text-base-content/30 border border-base-300 outline-dashed outline-1 outline-base-300 outline-offset-2' }} flex items-center justify-center shrink-0 mt-0.5 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-base-content/50 uppercase tracking-wider mb-0.5">Diserahkan Fisik</p>
                            @if($loan->return_date)
                                <p class="font-semibold text-sm text-success">{{ $loan->return_date->format('d M Y') }}</p>
                            @else
                                <p class="font-medium text-xs text-base-content/40 italic">Belum dikembalikan</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Denda -->
            @if($loan->fine > 0)
            <div class="bg-error/5 rounded-3xl border border-error/20 p-6 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-error uppercase tracking-wider mb-0.5">Tagihan Denda Keterlambatan</p>
                    <p class="text-xl font-black text-error font-mono">Rp {{ number_format($loan->fine, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 bg-error/10 rounded-full flex items-center justify-center text-error">
                    <span class="text-lg">💶</span>
                </div>
            </div>
            @endif

            <!-- Area Aksi -->
            @if($loan->status !== 'dikembalikan')
                <div class="pt-4">
                    <form action="{{ route('admin.loans.return', $loan) }}" method="POST" onsubmit="return confirm('Peringatan: Pastikan siswa telah memberikan fisik buku dan denda (jika ada) telah dilunasi.')">
                        @csrf @method('PATCH')
                        <button class="btn btn-success w-full h-14 rounded-2xl shadow-lg shadow-success/30 hover:-translate-y-1 transition-all text-white font-black text-sm uppercase tracking-wider border-none gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            Selesaikan Pinjaman
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </div>

</div>
</x-app-layout>
