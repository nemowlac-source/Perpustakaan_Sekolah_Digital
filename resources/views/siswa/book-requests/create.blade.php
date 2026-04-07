<x-app-layout>
    <div class="w-full max-w-3xl mx-auto space-y-8">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4 w-full sm:w-auto">
                <a href="{{ route('siswa.book-requests.index') }}" 
                   class="btn btn-circle btn-ghost bg-base-200 hover:bg-base-300 transition-colors tooltip tooltip-right" 
                   data-tip="Kembali ke Riwayat Usulan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </a>
                <div>
                    <h2 class="text-2xl font-black text-base-content flex items-center gap-2">Ajukan Request Buku</h2>
                    <p class="text-sm font-medium text-base-content/60">Lengkapi detail buku yang ingin kamu usulkan</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Form Section -->
            <div class="md:col-span-2">
                <div class="bg-base-100 rounded-3xl border border-base-200 shadow-sm overflow-hidden">
                    <form action="{{ route('siswa.book-requests.store') }}" method="POST">
                        @csrf

                        <div class="p-6 md:p-8 space-y-6">
                            <!-- Judul Buku -->
                            <div class="form-control w-full space-y-2">
                                <label class="label p-0">
                                    <span class="label-text font-bold text-base-content">Judul Buku <span class="text-error">*</span></span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40" viewBox="0 0 20 20" fill="currentColor"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" /></svg>
                                    </div>
                                    <input type="text" name="book_title" value="{{ old('book_title') }}"
                                        class="input input-bordered w-full pl-11 bg-base-100 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all rounded-xl h-12 font-medium @error('book_title') input-error @enderror"
                                        placeholder="Contoh: The Psychology of Money" required>
                                </div>
                                @error('book_title')
                                    <p class="text-error text-sm font-medium flex items-center gap-1 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Penulis -->
                            <div class="form-control w-full space-y-2">
                                <label class="label p-0">
                                    <span class="label-text font-bold text-base-content">Penulis / Pengarang</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                    </div>
                                    <input type="text" name="author" value="{{ old('author') }}"
                                        class="input input-bordered w-full pl-11 bg-base-100 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all rounded-xl h-12 font-medium"
                                        placeholder="Opsional — isi nama penulis jika tahu">
                                </div>
                            </div>

                            <!-- Alasan Pengajuan -->
                            <div class="form-control w-full space-y-2">
                                <label class="label p-0 flex justify-between items-end">
                                    <span class="label-text font-bold text-base-content flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/50" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                                        Alasan Pengajuan <span class="text-error">*</span>
                                    </span>
                                    <span class="text-[10px] uppercase font-bold text-base-content/40 tracking-wider">Maks 500 Karakter</span>
                                </label>
                                <textarea name="reason" rows="4"
                                    class="textarea textarea-bordered w-full bg-base-100 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all rounded-xl font-medium resize-none @error('reason') textarea-error @enderror"
                                    placeholder="Jelaskan ringkas mengapa buku ini keren dan perlu diadakan oleh perpustakaan kita..."
                                    maxlength="500" required>{{ old('reason') }}</textarea>
                                @error('reason')
                                    <p class="text-error text-sm font-medium flex items-center gap-1 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="px-6 py-5 bg-base-200/50 border-t border-base-200 flex items-center justify-end gap-3">
                            <a href="{{ route('siswa.book-requests.index') }}" class="btn bg-base-100 border-base-300 hover:bg-base-200 hover:border-base-300 text-base-content rounded-xl px-6 h-12 min-h-0 font-bold transition-all">Batal</a>
                            <button type="submit" class="btn btn-primary rounded-xl px-8 h-12 min-h-0 font-bold shadow-md shadow-primary/20 hover:-translate-y-0.5 transition-transform flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                Kirim Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="md:col-span-1 space-y-6">
                <!-- Promo Card -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-3xl border border-indigo-100 p-6 relative overflow-hidden shadow-sm">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center shadow-sm mb-4">
                            <span class="text-2xl drop-shadow-sm">🏆</span>
                        </div>
                        <h3 class="font-black text-lg text-indigo-900 leading-tight mb-2">Poin Ekstra!</h3>
                        <p class="text-indigo-800/80 text-sm font-medium mb-4 leading-relaxed">
                            Bantu melengkapi perpustakaan. Setiap buku yang <strong>disetujui</strong> akan memberimu <span class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded font-bold">+5 Poin</span> reward lho!
                        </p>
                    </div>
                </div>

                <!-- Guidance Tips -->
                <div class="bg-base-100 rounded-3xl border border-base-200 p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-base-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                        <h3 class="font-bold text-base-content">Tips Request Disetujui</h3>
                    </div>
                    <ul class="space-y-3 text-sm font-medium text-base-content/70">
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-success" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            <span class="pt-0.5">Jelaskan manfaat konkrit buku untuk pelajaran di sekolah</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-success" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            <span class="pt-0.5">Semakin spesifik nama penulis dan serinya, semakin bagus</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-error" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                            <span class="pt-0.5">Hindari mengirim judul acak atau asal (Poin bisa dipotong)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
