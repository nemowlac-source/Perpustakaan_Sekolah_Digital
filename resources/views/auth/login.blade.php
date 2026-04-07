<x-guest-layout>
    <div class="max-w-4xl mx-auto w-full">
        <!-- Main Card Container -->
        <div class="bg-base-100 rounded-3xl shadow-2xl border border-base-200 overflow-hidden flex flex-col md:flex-row">
            
            <!-- Kiri: Branding & Ilustrasi (Hidden on Mobile) -->
            <div class="md:w-5/12 bg-gradient-to-br from-primary to-indigo-700 relative overflow-hidden flex flex-col p-10 justify-between text-white hidden md:flex">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-black/10 rounded-full blur-2xl transform -translate-x-1/2 translate-y-1/4"></div>
                
                <div class="relative z-10 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl backdrop-blur-sm flex items-center justify-center border border-white/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <span class="font-bold text-lg tracking-wider">PerpusDigital</span>
                </div>

                <div class="relative z-10 my-auto py-10">
                    <h1 class="text-3xl font-black mb-4 leading-tight">Mulai Petualangan Membacamu</h1>
                    <p class="text-indigo-100 font-medium text-sm leading-relaxed">Akses ribuan literatur dan buku pelajaran hanya dengan satu akun. Jelajahi pengetahuan tanpa hambatan.</p>
                </div>

                <div class="relative z-10">
                    <p class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest">Sistem Informasi Perpustakaan v2.0</p>
                </div>
            </div>

            <!-- Kanan: Form Login -->
            <div class="md:w-7/12 p-8 sm:p-12 flex flex-col justify-center bg-base-100 relative">
                
                <!-- Mobile Header Brand -->
                <div class="flex items-center gap-3 md:hidden mb-8">
                    <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center border border-primary/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <span class="font-bold text-xl text-base-content tracking-wider">PerpusDigital</span>
                </div>

                <div class="mb-10">
                    <h2 class="text-2xl sm:text-3xl font-black text-base-content mb-2">Selamat Datang 👋</h2>
                    <p class="text-base-content/60 font-medium text-sm">Silakan masukkan kredensial akun Anda untuk masuk ke sistem.</p>
                </div>

                <!-- Session Status / Errors -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                @if (session('success'))
                    <div class="mb-6 p-4 text-sm font-bold text-success bg-success/10 rounded-xl border border-success/20 flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 text-sm font-bold text-error bg-error/10 rounded-xl border border-error/20 flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-control">
                        <label class="label pt-0 pb-2"><span class="font-bold text-sm text-base-content">Alamat Email</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <input id="email" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
                    </div>

                    <!-- Password -->
                    <div class="form-control">
                        <div class="flex justify-between items-center mb-2">
                            <label class="label p-0"><span class="font-bold text-sm text-base-content">Kata Sandi</span></label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-bold text-primary hover:text-primary-focus hover:underline transition-colors block p-1" href="{{ route('password.request') }}">
                                    Lupa sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
                    </div>

                    <!-- Remember Me -->
                    <div class="pt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input id="remember_me" type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-md transition-all" name="remember">
                            </div>
                            <span class="ml-3 text-sm font-semibold text-base-content/70 group-hover:text-base-content transition-colors">Ingat sesi saya</span>
                        </label>
                    </div>

                    <div class="pt-6">
                        <button class="btn btn-primary w-full h-14 rounded-xl text-lg font-black shadow-lg shadow-primary/30 hover:-translate-y-1 hover:shadow-xl hover:shadow-primary/40 transition-all flex items-center justify-center gap-2">
                            Masuk
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        
        <!-- Footer / Register Link -->
        <div class="mt-8 text-center text-sm font-semibold text-base-content/60">
            Belum memiliki identitas pelajar? 
            <a href="{{ route('register') }}" class="text-primary font-black hover:underline hover:text-primary-focus transition-colors">Daftar Sekarang</a>
        </div>
    </div>
</x-guest-layout>
