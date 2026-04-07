<x-guest-layout>
    <div class="max-w-md mx-auto w-full">
        <!-- Main Card Container -->
        <div class="bg-base-100 rounded-3xl shadow-2xl border border-base-200 overflow-hidden flex flex-col relative">

            <!-- Top Decoration -->
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-secondary to-primary opacity-20 pointer-events-none"></div>
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-secondary/30 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="p-8 sm:p-10 relative z-10">
                <!-- Header Icon -->
                <div class="w-16 h-16 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center border border-secondary/20 shadow-inner mb-6 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-black text-base-content mb-2">Pembaruan Sandi</h2>
                    <p class="text-base-content/60 font-medium text-sm">Silakan masukkan kata sandi baru untuk akun Anda. Pastikan kombinasi sandi kali ini mudah Anda ingat.</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="form-control">
                        <label class="label pt-0 pb-1"><span class="font-bold text-sm text-base-content">Alamat Email Terdahulu</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-base-content transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <!-- Diset readonly agar tidak salah alamat -->
                            <input id="email" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-secondary rounded-xl focus:ring-2 focus:ring-secondary/20 transition-all font-semibold text-base-content/70 cursor-not-allowed" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" readonly />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
                    </div>

                    <!-- Password -->
                    <div class="form-control">
                        <label class="label pt-0 pb-1"><span class="font-bold text-sm text-base-content">Kata Sandi Baru</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="password" name="password" required autocomplete="new-password" placeholder="Buat sandi baru (min 8 char)" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-control">
                        <label class="label pt-0 pb-1"><span class="font-bold text-sm text-base-content">Konfirmasi Sandi Baru</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <input id="password_confirmation" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-semibold text-base-content" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi sandi persis seperti di atas" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary w-full h-14 rounded-xl text-base font-black shadow-lg shadow-primary/30 hover:-translate-y-1 hover:shadow-xl hover:shadow-primary/40 transition-all gap-2">
                            Simpan Perubahan Sandi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>
