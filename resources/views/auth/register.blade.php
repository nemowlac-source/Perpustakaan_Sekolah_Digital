<x-guest-layout>
    <div class="max-w-5xl mx-auto w-full my-8">
        <!-- Main Card Container -->
        <div class="bg-base-100 rounded-3xl shadow-2xl border border-base-200 overflow-hidden flex flex-col md:flex-row-reverse">
            
            <!-- Kanan: Branding & Ilustrasi (Hidden on Mobile) -->
            <div class="md:w-5/12 bg-gradient-to-br from-violet-600 to-fuchsia-700 relative overflow-hidden flex flex-col p-10 justify-between text-white hidden md:flex">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-black/10 rounded-full blur-2xl transform -translate-x-1/2 translate-y-1/4"></div>
                
                <div class="relative z-10 flex items-center justify-end gap-3">
                    <span class="font-bold text-lg tracking-wider">PerpusDigital</span>
                    <div class="w-10 h-10 bg-white/20 rounded-xl backdrop-blur-sm flex items-center justify-center border border-white/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                </div>

                <div class="relative z-10 my-auto py-10 text-right">
                    <h1 class="text-3xl font-black mb-4 leading-tight">Bergabunglah Dengan Ribuan Pelajar Lainnya</h1>
                    <p class="text-fuchsia-100 font-medium text-sm leading-relaxed">Daftarkan identitas sekolahmu untuk membuka akses limit tanpa batas ke seluruh perpustakaan digital kami.</p>
                </div>

                <div class="relative z-10 text-right">
                    <div class="inline-flex items-center gap-2 bg-white/20 px-3 py-1.5 rounded-full backdrop-blur-sm border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-success animate-pulse"></span>
                        <span class="text-[10px] font-bold text-white uppercase tracking-widest">Pendaftaran Dibuka</span>
                    </div>
                </div>
            </div>

            <!-- Kiri: Form Registrasi -->
            <div class="md:w-7/12 p-8 sm:p-12 flex flex-col justify-center bg-base-100 relative">
                
                <!-- Mobile Header Brand -->
                <div class="flex items-center gap-3 md:hidden mb-8">
                    <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center border border-primary/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <span class="font-bold text-xl text-base-content tracking-wider">PerpusDigital</span>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-base-content mb-2">Buat Akun Baru 🚀</h2>
                    <p class="text-base-content/60 font-medium text-sm">Lengkapi formulir di bawah ini dengan data diri yang sesuai.</p>
                </div>

                <!-- Session Status / Errors -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nama Lengkap -->
                        <div class="form-control md:col-span-2">
                            <label class="label pt-0 pb-1"><span class="font-bold text-sm text-base-content">Nama Lengkap Siswa</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                <input id="name" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold" />
                        </div>

                        <!-- Email Address -->
                        <div class="form-control">
                            <label class="label pt-0 pb-1"><span class="font-bold text-sm text-base-content">Alamat Email</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                </div>
                                <input id="email" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="siswa@sekolah.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
                        </div>

                        <!-- Nomor Induk Siswa (NIS) -->
                        <div class="form-control">
                            <label class="label pt-0 pb-1"><span class="font-bold text-sm text-base-content">NIS (Nomor Induk Siswa)</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                </div>
                                <input id="nis" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="text" name="nis" value="{{ old('nis') }}" required placeholder="Contoh: 12345678" />
                            </div>
                            <x-input-error :messages="$errors->get('nis')" class="mt-2 text-xs font-bold" />
                        </div>

                        <!-- Password -->
                        <div class="form-control">
                            <label class="label pt-0 pb-1"><span class="font-bold text-sm text-base-content">Kata Sandi</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                </div>
                                <input id="password" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 Karakter" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-control">
                            <label class="label pt-0 pb-1"><span class="font-bold text-sm text-base-content">Ulangi Sandi</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                </div>
                                <input id="password_confirmation" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Sandi Tadi" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold" />
                        </div>
                    </div>

                    <!-- Syarat & Ketentuan -->
                    <div class="pt-2">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="checkbox" required class="checkbox checkbox-primary checkbox-sm mt-1 mb-1 rounded-md transition-all">
                            <span class="text-xs font-semibold text-base-content/70 group-hover:text-base-content transition-colors leading-relaxed">
                                Saya mendaftarkan akun ini dengan data yang sebenarnya dan setuju mematuhi seluruh peraturan perpustakaan digital ini.
                            </span>
                        </label>
                    </div>

                    <div class="pt-4">
                        <button class="btn btn-primary w-full h-14 rounded-xl text-lg font-black shadow-lg shadow-primary/30 hover:-translate-y-1 hover:shadow-xl hover:shadow-primary/40 transition-all flex items-center justify-center gap-2">
                            Daftar Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        
        <!-- Footer / Login Link -->
        <div class="mt-8 text-center text-sm font-semibold text-base-content/60">
            Sudah pernah mendaftar sebelumnya? 
            <a href="{{ route('login') }}" class="text-primary font-black hover:underline hover:text-primary-focus transition-colors">Masuk di sini</a>
        </div>
    </div>
</x-guest-layout>
