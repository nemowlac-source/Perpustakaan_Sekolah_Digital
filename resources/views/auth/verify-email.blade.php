<x-guest-layout>
    <div class="max-w-md mx-auto w-full">
        <!-- Main Card Container -->
        <div class="bg-base-100 rounded-3xl shadow-2xl border border-base-200 overflow-hidden flex flex-col relative text-center">

            <!-- Top Decoration -->
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-info to-primary opacity-20 pointer-events-none"></div>
            
            <div class="p-8 sm:p-10 relative z-10 flex flex-col items-center">
                <!-- Icon Email Sent -->
                <div class="w-16 h-16 bg-info/10 text-info rounded-2xl flex items-center justify-center border border-info/20 shadow-inner mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 animate-bounce" style="animation-duration: 3s" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>

                <h2 class="text-2xl font-black text-base-content mb-3">Verifikasi Email Anda</h2>
                <div class="text-base-content/70 font-medium text-sm leading-relaxed mb-6">
                    Terima kasih telah bergabung! Tautan verifikasi telah kami kirimkan ke kotak masuk alamat email yang Anda daftarkan tadi. Mohon periksa email Anda dan klik tautan tersebut untuk mengaktifkan akun.<br><br>Belum menerima email dari kami? Kami siap mengirimkannya kembali.
                </div>

                <!-- Session Status / Notification -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 w-full text-sm font-bold text-success bg-success/10 rounded-xl border border-success/20 flex flex-col items-center gap-1 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span>Tautan verifikasi baru berhasil dikirim!</span>
                    </div>
                @endif

                <div class="w-full space-y-4">
                    <!-- Resend Button -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary w-full h-14 rounded-xl text-base font-black shadow-lg shadow-primary/30 hover:-translate-y-1 hover:shadow-xl hover:shadow-primary/40 transition-all flex items-center justify-center gap-2">
                            Kirim Ulang Email Verifikasi
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                        </button>
                    </form>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-ghost w-full hover:bg-base-200 transition-colors rounded-xl text-error font-bold text-sm">
                            Atau keluar (Logout) akun ini
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
