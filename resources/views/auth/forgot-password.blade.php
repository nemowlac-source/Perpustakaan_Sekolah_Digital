<x-guest-layout>
    <div class="max-w-md mx-auto w-full">
        <!-- Main Card Container -->
        <div class="bg-base-100 rounded-3xl shadow-2xl border border-base-200 overflow-hidden flex flex-col relative">

            <!-- Top Decoration -->
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-warning to-error opacity-20 pointer-events-none"></div>
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-error/20 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="p-8 sm:p-10 relative z-10">
                
                <!-- Back Link & Icon -->
                <div class="flex items-center justify-between mb-8">
                    <a href="{{ route('login') }}" class="btn btn-sm btn-circle btn-ghost bg-base-200 hover:bg-base-300 transition-colors tooltip tooltip-right" data-tip="Kembali ke Login">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    </a>
                    <div class="w-12 h-12 bg-warning/10 text-warning rounded-xl flex items-center justify-center border border-warning/20 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" /></svg>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-black text-base-content mb-3">Lupa Kata Sandi?</h2>
                    <p class="text-base-content/60 font-medium text-sm leading-relaxed">Kehilangan akses ke akun Anda? Tak perlu khawatir. Masukkan alamat email terdaftar, dan kami akan mengirimkan tautan khusus agar Anda dapat membuat sandi baru.</p>
                </div>

                <!-- Session Status / Success Notification -->
                @if (session('status'))
                    <div class="mb-8 p-4 w-full text-sm font-bold text-success bg-success/10 rounded-xl border border-success/20 flex flex-col items-center text-center gap-1 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-control">
                        <label class="label pt-0 pb-1.5"><span class="font-bold text-sm text-base-content">Alamat Email</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-warning transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <input id="email" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-warning rounded-xl focus:ring-2 focus:ring-warning/20 transition-all font-semibold text-base-content" type="email" name="email" :value="old('email')" required autofocus placeholder="Ketik email terdaftar Anda..." />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn bg-base-content hover:bg-neutral text-base-100 w-full h-14 rounded-xl text-base font-black shadow-lg shadow-base-content/20 hover:-translate-y-1 transition-all gap-2 border-none">
                            Kirim Tautan Pemulihan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>
