<x-app-layout>
<div class="w-full max-w-3xl mx-auto space-y-6 min-w-0 py-4 sm:py-8">
    
    <!-- Premium Header -->
    <div class="bg-gradient-to-br from-primary to-indigo-600 rounded-3xl p-6 sm:p-8 text-primary-content shadow-lg shadow-primary/20 relative overflow-hidden flex flex-col sm:flex-row justify-between items-center gap-4">
        <!-- SVG Decorations -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-indigo-900/20 rounded-full blur-xl transform -translate-x-1/2 translate-y-1/2 pointer-events-none"></div>
        
        <div class="relative z-10 flex items-center gap-4 w-full sm:w-auto">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center shadow-inner border border-white/30 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            </div>
            <div>
                <h2 class="text-2xl sm:text-3xl font-black mb-1 truncate text-white drop-shadow-sm">Catat Terpinjam</h2>
                <p class="text-primary-content/80 font-medium text-xs sm:text-sm truncate">Formulir pendaftaran pinjam buku fisik area sirkulasi</p>
            </div>
        </div>
        
        <div class="relative z-10 shrink-0 text-right hidden sm:block">
            <p class="text-[10px] font-bold text-white/70 uppercase tracking-wider mb-0.5">Waktu Server</p>
            <p class="text-sm font-black text-white">{{ now()->format('d M Y - H:i') }}</p>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-error rounded-2xl shadow-sm border border-error/20 flex gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="font-bold text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-base-100 rounded-3xl border border-base-200 shadow-sm overflow-hidden flex flex-col md:flex-row">
        
        <!-- Kolom Form (Kiri) -->
        <div class="p-6 md:p-8 flex-1">
            <form action="{{ route('admin.loans.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Entitas Siswa -->
                <div class="form-control">
                    <label class="label pb-2 pt-0">
                        <span class="label-text font-bold text-base-content text-sm">Pilih Siswa (Peminjam)</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-base-content/40 group-focus-within:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </span>
                        </div>
                        <select name="user_id" class="select h-12 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" required>
                            <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>-- Ketik/Pilih Nama Siswa --</option>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('user_id') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->name }} (NIS: {{ $siswa->nis }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                        <p class="text-error text-xs font-bold mt-1.5 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Entitas Buku -->
                <div class="form-control">
                    <label class="label pb-2 pt-0">
                        <span class="label-text font-bold text-base-content text-sm">Buku yang Dipinjam</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-base-content/40 group-focus-within:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </span>
                        </div>
                        <select name="book_id" class="select h-12 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" required>
                            <option value="" disabled {{ old('book_id') ? '' : 'selected' }}>-- Pilih Judul Buku Tersedia --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ Str::limit($book->title, 40) }}  [Stok: {{ $book->stock }}]
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('book_id')
                        <p class="text-error text-xs font-bold mt-1.5 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Jatuh Tempo -->
                <div class="form-control">
                    <label class="label pb-2 pt-0">
                        <span class="label-text font-bold text-base-content text-sm">Target Ulang (Jatuh Tempo)</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-base-content/40 group-focus-within:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </span>
                        </div>
                        <input type="date" name="due_date"
                            value="{{ old('due_date', now()->addDays(7)->format('Y-m-d')) }}"
                            min="{{ now()->addDay()->format('Y-m-d') }}"
                            class="input h-12 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" required>
                    </div>
                    <p class="text-[11px] font-medium text-base-content/50 mt-1.5 ml-1">Standar default adalah 7 hari dari sekarang</p>
                    @error('due_date')
                        <p class="text-error text-xs font-bold mt-1.5 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="border-t border-base-200 pt-6 mt-6 flex flex-col-reverse sm:flex-row gap-3 sm:justify-end">
                    <a href="{{ route('admin.loans.index') }}" class="btn h-12 w-full sm:w-auto btn-ghost bg-base-200 hover:bg-base-300 rounded-xl font-bold">Batalkan</a>
                    <button type="submit" class="btn h-12 w-full sm:w-auto btn-primary rounded-xl font-bold shadow-md shadow-primary/30 hover:-translate-y-0.5 transition-transform px-8">Kunci Peminjaman</button>
                </div>
            </form>
        </div>

        <!-- Kolom Info (Kanan) -->
        <div class="bg-base-200/50 md:w-72 border-t md:border-t-0 md:border-l border-base-200 p-6 flex flex-col justify-center">
            <div class="bg-base-100 rounded-2xl p-5 border border-base-200 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-warning/10 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <h4 class="font-black text-base-content text-sm mb-3 flex items-center gap-2 relative z-10">
                    <span class="text-lg">💡</span> Peraturan Sistem
                </h4>
                <ul class="space-y-4 relative z-10">
                    <li>
                        <div class="text-[10px] font-bold text-base-content/50 uppercase tracking-wider mb-0.5">Sanksi Telat</div>
                        <div class="text-sm font-semibold text-error">Rp 1.000 / hari keterlambatan</div>
                    </li>
                    <li>
                        <div class="text-[10px] font-bold text-base-content/50 uppercase tracking-wider mb-0.5">Reward Tepat Waktu</div>
                        <div class="text-sm font-semibold text-success flex items-center gap-1.5">
                            +10 Poin Prestasi
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        </div>
                    </li>
                    <li class="pt-2 border-t border-base-200/50">
                        <div class="text-[11px] font-medium text-base-content/60 leading-relaxed">
                            Pastikan data peminjam dan buku sesuai fisik. Stok gudang akan otomatis berkurang setelah pinjaman ini terkunci.
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>

</div>
</x-app-layout>
