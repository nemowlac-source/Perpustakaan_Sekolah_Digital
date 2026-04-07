<x-app-layout>
    <div class="w-full space-y-6 min-w-0">

        <!-- Header Desk -->
        <div
            class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-3xl p-6 md:p-8 text-primary-content shadow-lg shadow-indigo-500/20 relative overflow-hidden flex flex-col sm:flex-row justify-between items-center gap-6">
            <div
                class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 rounded-full border-4 border-white/10 opacity-50 pointer-events-none">
            </div>
            <div
                class="absolute top-1/2 right-4 w-16 h-16 bg-white/20 rounded-full blur-xl transform -translate-y-1/2 pointer-events-none">
            </div>

            <div class="relative z-10 flex items-center gap-5 w-full sm:w-auto">
                <div
                    class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-inner border border-white/30 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-2xl sm:text-3xl font-black mb-1 truncate text-white drop-shadow-sm">Pusat Laporan
                    </h2>
                    <p class="text-indigo-100 font-medium text-sm truncate">Tarik rekapitulasi data sirkulasi ke dokumen
                        cetak</p>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-6">
            {{-- Form Cetak --}}
            <div class="lg:col-span-7 xl:col-span-8">
                <div class="bg-base-100 rounded-3xl border border-base-200 shadow-sm p-6 sm:p-8 flex flex-col h-full">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold border-l-4 border-primary pl-3 text-base-content leading-tight">
                            Rekapitulasi Peminjaman<br><span class="text-sm font-medium text-base-content/50">Filter
                                berdasarkan rentang waktu operasional</span></h3>
                    </div>

                    <form action="{{ route('admin.laporan.pdf') }}" method="GET" class="flex-1 flex flex-col">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                            {{-- Tanggal Mulai --}}
                            <div class="form-control">
                                <label class="label pb-2 pt-0">
                                    <span class="label-text font-bold text-base-content">Dari Tanggal</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" name="tgl_mulai"
                                        class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content"
                                        required>
                                </div>
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="form-control">
                                <label class="label pb-2 pt-0">
                                    <span class="label-text font-bold text-base-content">Sampai Tanggal</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" name="tgl_selesai"
                                        class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content"
                                        required>
                                </div>
                            </div>

                        </div>

                        <div class="mt-auto">
                            <button type="submit"
                                class="btn btn-primary w-full h-14 rounded-xl shadow-md shadow-primary/30 hover:-translate-y-0.5 transition-transform text-base gap-2 group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:animate-bounce"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Cetak PDF Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Ilustrasi / Informasi --}}
            <div class="lg:col-span-5 xl:col-span-4 space-y-6">
                <div
                    class="bg-gradient-to-b from-indigo-50 to-white rounded-3xl border border-indigo-100 p-6 flex flex-col items-center justify-center text-center shadow-sm h-full relative overflow-hidden">
                    <div class="w-32 h-32 bg-indigo-100 rounded-full flex items-center justify-center mb-6 relative">
                        <div class="absolute inset-0 bg-indigo-200 rounded-full animate-ping opacity-20"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-500 relative z-10"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-black text-indigo-950 mb-2">Dokumen Resmi</h4>
                    <p class="text-sm text-indigo-900/60 leading-relaxed max-w-[250px]">Laporan ini men-<i>generate</i>
                        format PDF resmi perpustakaan. Mencakup catatan buku keluar, pengembalian, status denda hingga
                        rincian peminjam.</p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
