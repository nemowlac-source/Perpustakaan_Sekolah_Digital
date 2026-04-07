<x-guest-layout>
    <div class="mb-4 text-center">
        <!-- Ikon Jam Pasir / Menunggu (Heroicons) -->
        <div class="flex justify-center mb-4 text-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-16 h-16 animate-pulse">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
            Pendaftaran Berhasil!
        </h2>

        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
            Terima kasih telah mendaftar di <strong>Perpustakaan Digital</strong>.
            Saat ini akun Anda sedang dalam proses verifikasi oleh Admin.
        </p>

        <div class="mt-6 p-4 bg-amber-50 border-l-4 border-amber-400 text-amber-700 text-xs text-left">
            <p class="font-bold mb-1">Informasi:</p>
            <ul class="list-disc ml-4">
                <li>Petugas akan mencocokkan data <strong>NIS</strong> Anda.</li>
                <li>Proses ini biasanya memakan waktu 1x24 jam.</li>
                <li>Silakan coba login secara berkala.</li>
            </ul>
        </div>
    </div>

    <div class="flex items-center justify-center mt-8">
        <a href="{{ route('login') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Kembali ke Login
        </a>
    </div>
    <script>
        // Cek status setiap 3 detik
        setInterval(function() {
            fetch('/check-status-ajax')
                .then(response => response.json())
                .then(data => {
                    if (data.active === true) {
                        // Jika admin sudah klik konfirmasi, langsung pindah ke dashboard siswa
                        window.location.href = "{{ route('siswa.dashboard') }}";
                    }
                })
                .catch(error => console.error('Error checking status:', error));
        }, 3000);
    </script>
</x-guest-layout>
