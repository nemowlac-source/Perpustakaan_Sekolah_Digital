<x-guest-layout>
    <div class="max-w-md mx-auto w-full">
        <!-- Main Card Container -->
        <div class="bg-base-100 rounded-3xl shadow-2xl border border-base-200 overflow-hidden flex flex-col relative">

            <!-- Top Decoration -->
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-slate-600 to-slate-900 opacity-20 pointer-events-none"></div>
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-slate-500/20 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="p-8 sm:p-10 relative z-10">
                
                <!-- Security Icon -->
                <div class="w-16 h-16 bg-slate-100 text-slate-700 rounded-2xl flex items-center justify-center border border-slate-200 shadow-inner mb-6 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-black text-base-content mb-2">Area Terbatas</h2>
                    <p class="text-base-content/60 font-medium text-sm leading-relaxed">Tindakan ini menyentuh area yang membutuhkan autorisasi keamanan. Mohon konfirmasi identitas dengan memasukkan kata sandi Anda kembali.</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <!-- Password -->
                    <div class="form-control">
                        <label class="label pt-0 pb-1.5"><span class="font-bold text-sm text-base-content">Kata Sandi Akun</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-focus-within:text-slate-800 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                            </div>
                            <input id="password" class="input h-14 w-full pl-11 bg-base-200/50 hover:bg-base-200/80 focus:bg-base-100 border-base-300 focus:border-slate-600 rounded-xl focus:ring-2 focus:ring-slate-500/20 transition-all font-semibold text-base-content" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" autofocus />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
                    </div>

                    <div class="pt-2 flex flex-col-reverse sm:flex-row gap-3 items-center justify-end">
                        <a href="{{ url()->previous() }}" class="btn btn-ghost bg-base-200 hover:bg-base-300 font-bold rounded-xl w-full sm:w-auto">Batal</a>
                        <button type="submit" class="btn bg-slate-800 hover:bg-slate-900 border-none text-white w-full sm:w-auto h-12 rounded-xl text-sm font-black shadow-lg shadow-slate-800/30 hover:-translate-y-1 transition-all gap-2 px-8">
                            Konfirmasi Lanjut
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>
