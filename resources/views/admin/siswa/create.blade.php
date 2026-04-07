<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-success rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-success-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-base-content">Tambah Anggota Siswa</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-6">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-base-content/60">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('admin.siswa.index') }}" class="hover:text-primary transition-colors">Manajemen Siswa</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-base-content">Tambah Siswa</span>
        </nav>

        {{-- Main Form Card --}}
        <div class="bg-base-100 rounded-xl border border-base-300 shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-success to-success-focus text-success-content px-6 py-4">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold">Informasi Siswa Baru</h3>
                </div>
                <p class="text-success-content/80 text-sm mt-1">Lengkapi data siswa untuk membuat akun baru</p>
            </div>

            <form action="{{ route('admin.siswa.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- Personal Information Section --}}
                <div class="space-y-4">
                    <h4 class="font-medium text-base-content flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Pribadi
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4 text-base-content/60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    Nama Lengkap
                                </span>
                            </label>
                            <input name="name" value="{{ old('name') }}"
                                class="input input-bordered w-full focus:input-primary @error('name') input-error @enderror"
                                placeholder="Contoh: Budi Santoso" required>
                            @error('name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4 text-base-content/60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    NIS
                                </span>
                            </label>
                            <input name="nis" value="{{ old('nis') }}"
                                class="input input-bordered w-full font-mono focus:input-primary @error('nis') input-error @enderror"
                                placeholder="Contoh: 2024001" required>
                            @error('nis')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Account Information Section --}}
                <div class="divider"></div>

                <div class="space-y-4">
                    <h4 class="font-medium text-base-content flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Informasi Akun
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4 text-base-content/60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                    Username
                                </span>
                            </label>
                            <input name="username" value="{{ old('username') }}"
                                class="input input-bordered w-full focus:input-primary @error('username') input-error @enderror"
                                placeholder="Contoh: budi_santoso" required>
                            @error('username')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4 text-base-content/60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Email
                                </span>
                            </label>
                            <input name="email" type="email" value="{{ old('email') }}"
                                class="input input-bordered w-full focus:input-primary @error('email') input-error @enderror"
                                placeholder="Contoh: budi@sekolah.sch.id" required>
                            @error('email')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Password Section --}}
                <div class="divider"></div>

                <div class="space-y-4">
                    <h4 class="font-medium text-base-content flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Keamanan Akun
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4 text-base-content/60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    Password
                                </span>
                            </label>
                            <input name="password" type="password"
                                class="input input-bordered w-full focus:input-primary @error('password') input-error @enderror"
                                placeholder="Min. 6 karakter" required>
                            @error('password')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4 text-base-content/60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Konfirmasi Password
                                </span>
                            </label>
                            <input name="password_confirmation" type="password"
                                class="input input-bordered w-full focus:input-primary" placeholder="Ulangi password"
                                required>
                        </div>
                    </div>
                </div>

                {{-- Tips Box --}}
                <div class="bg-gradient-to-r from-info/10 to-info/5 border border-info/20 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-info mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h5 class="font-medium text-info mb-1">Tips Keamanan</h5>
                            <p class="text-sm text-base-content/70">Gunakan NIS sebagai password awal agar mudah
                                diingat siswa. Siswa dapat mengubah password setelah login pertama.</p>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="divider"></div>

                <div class="flex flex-col sm:flex-row gap-3 justify-end pt-2">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost order-2 sm:order-1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success order-1 sm:order-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Akun
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
