<div
    class="navbar bg-base-100/90 backdrop-blur-md sticky top-0 z-50 border-b border-base-200 shadow-sm px-4 md:px-8 transition-all">
    <div class="flex-1 flex justify-start"> <!-- Tambahkan flex justify-start di pembungkus -->
        <a href="{{ route('siswa.dashboard') }}"
            class="btn btn-ghost px-2 text-2xl text-primary font-black tracking-tight gap-2 flex items-center justify-start hover:bg-base-200/50">

            <!-- Teks di awal -->
            PerpusKita

            <!-- Ikon setelah teks -->
            <span class="bg-primary text-primary-content p-1.5 rounded-xl shadow-sm shadow-primary/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </span>
        </a>
    </div>

    <div class="flex-none gap-2 md:gap-4 flex items-center">
        <!-- Desktop Menu -->
        <ul class="menu menu-horizontal px-1 hidden md:flex font-semibold text-base-content/70 items-center gap-1">
            <li>
                <a href="{{ route('siswa.dashboard') }}"
                    class="{{ request()->routeIs('siswa.dashboard') ? 'active bg-primary/10 text-primary font-bold shadow-sm' : 'hover:text-primary hover:bg-base-200' }} rounded-xl transition-all">
                    Ekspolrasi
                </a>
            </li>
            <li>
                <a href="{{ route('siswa.loans.index') }}"
                    class="{{ request()->routeIs('siswa.loans.*') ? 'active bg-primary/10 text-primary font-bold shadow-sm' : 'hover:text-primary hover:bg-base-200' }} rounded-xl transition-all">
                    Pinjaman Saya
                </a>
            </li>
            <li>
                <a href="{{ route('siswa.book-requests.index') }}"
                    class="{{ request()->routeIs('siswa.book-requests.*') ? 'active bg-primary/10 text-primary font-bold shadow-sm' : 'hover:text-primary hover:bg-base-200' }} rounded-xl transition-all">
                    Request
                </a>
            </li>
        </ul>

        {{-- Mobile Hamburger (Visible on small screens) --}}
        <div class="dropdown dropdown-end md:hidden">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </div>
            <ul tabindex="0"
                class="menu menu-sm dropdown-content mt-4 z-[1] p-3 shadow-xl shadow-base-200/50 bg-base-100 rounded-box w-56 border border-base-200 font-medium space-y-1">
                <li><a href="{{ route('siswa.dashboard') }}"
                        class="{{ request()->routeIs('siswa.dashboard') ? 'bg-primary/10 text-primary font-bold rounded-lg' : 'rounded-lg hover:bg-base-200' }} py-3">Eksplorasi</a>
                </li>
                <li><a href="{{ route('siswa.loans.index') }}"
                        class="{{ request()->routeIs('siswa.loans.*') ? 'bg-primary/10 text-primary font-bold rounded-lg' : 'rounded-lg hover:bg-base-200' }} py-3">Pinjaman
                        Saya</a></li>
                <li><a href="{{ route('siswa.book-requests.index') }}"
                        class="{{ request()->routeIs('siswa.book-requests.*') ? 'bg-primary/10 text-primary font-bold rounded-lg' : 'rounded-lg hover:bg-base-200' }} py-3">Request
                        Buku</a></li>
            </ul>
        </div>

        <div class="divider divider-horizontal mx-0 hidden md:flex opacity-30"></div>

        {{-- Badge Poin Siswa --}}
        <div class="tooltip tooltip-bottom" data-tip="Kumpulkan poin dari meminjam buku!">
            <div
                class="bg-gradient-to-r from-amber-400 to-orange-500 rounded-full p-[2px] shadow-sm shadow-amber-500/20 hover:scale-105 transition-transform cursor-pointer">
                <div class="bg-base-100 px-3 py-1 sm:py-1.5 rounded-full flex items-center gap-1.5 h-full">
                    <span class="text-amber-500 font-bold text-lg sm:text-xl leading-none">★</span>
                    <span class="font-extrabold text-base-content text-sm sm:text-base">{{ Auth::user()->points }}
                        <span
                            class="hidden sm:inline-block text-[10px] sm:text-xs font-semibold text-base-content/50 uppercase tracking-widest ml-0.5">Poin</span></span>
                </div>
            </div>
        </div>

        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button"
                class="btn btn-ghost btn-circle avatar hover:ring-2 ring-primary/30 transition-all ml-1">
                <div class="w-10 rounded-full border border-base-300 shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=F0FDF4&color=16A34A&bold=true"
                        alt="Profile" />
                </div>
            </div>
            <ul tabindex="0"
                class="mt-4 z-[1] p-3 shadow-xl shadow-base-200/50 menu menu-sm dropdown-content bg-base-100 rounded-2xl w-60 border border-base-200">
                <div class="px-4 py-3 pb-4">
                    <p class="font-extrabold text-base-content text-base truncate">{{ Auth::user()->name }}</p>
                    <p
                        class="text-xs font-semibold text-success bg-success/10 border border-success/20 inline-block px-2 py-0.5 rounded-full mt-2 font-mono tracking-wider">
                        NIS: {{ Auth::user()->nis ?? 'Tidak ada' }}</p>
                </div>
                <div class="divider my-0 opacity-30"></div>
                <li>
                    <a href="/profile" class="hover:bg-base-200 rounded-xl py-3 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile Saya
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="block w-full p-0">
                        @csrf
                        <button type="submit"
                            class="w-full text-left text-error hover:bg-error hover:text-white rounded-xl py-3 px-4 flex items-center gap-2 font-bold transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar Aplikasi
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
