<div class="fixed left-0 top-0 h-screen w-64 bg-base-100 border-r border-base-200 flex flex-col z-50">
    <!-- Logo -->
    <div class="px-6 py-5 border-b border-base-200">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold flex items-center gap-3 text-base-content hover:scale-105 transition-transform">
            <div class="bg-primary/10 text-primary p-2 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <span class="tracking-tight text-primary">LibAdmin</span>
        </a>
    </div>

    <!-- Menu -->
    <ul class="menu flex-1 p-4 gap-1 overflow-y-auto text-base-content font-medium">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-primary-content rounded-xl shadow-md shadow-primary/20' : 'hover:bg-base-200 rounded-xl' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.siswa.index') }}" class="{{ request()->routeIs('admin.siswa.*') ? 'active bg-primary text-primary-content rounded-xl shadow-md shadow-primary/20' : 'hover:bg-base-200 rounded-xl' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Anggota Siswa
            </a>
        </li>
        
        <li class="menu-title mt-4 mb-2"><span class="text-xs font-black text-base-content/40 tracking-wider">KATALOG PUSTAKA</span></li>
        <li>
            <details class="group" {{ request()->routeIs('admin.books.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.book-requests.*') ? 'open' : '' }}>
                <summary class="hover:bg-base-200 rounded-xl font-bold flex items-center justify-between {{ request()->routeIs('admin.books.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.book-requests.*') ? 'bg-base-200 text-primary' : '' }}">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        Manajemen Buku
                    </div>
                </summary>
                <ul class="mt-2 space-y-1 relative before:absolute before:bg-base-300 before:w-px before:h-[calc(100%-1.5rem)] before:left-3.5 before:top-4">
                    <li><a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active bg-primary/10 text-primary font-bold rounded-lg relative before:absolute before:w-2 before:h-2 before:bg-primary before:rounded-full before:-left-[0.85rem] before:top-1/2 before:-translate-y-1/2' : 'rounded-lg hover:bg-base-200' }}">Semua Buku</a></li>
                    <li><a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active bg-primary/10 text-primary font-bold rounded-lg relative before:absolute before:w-2 before:h-2 before:bg-primary before:rounded-full before:-left-[0.85rem] before:top-1/2 before:-translate-y-1/2' : 'rounded-lg hover:bg-base-200' }}">Kategori Kustom</a></li>
                    <li><a href="{{ route('admin.book-requests.index') }}" class="{{ request()->routeIs('admin.book-requests.*') ? 'active bg-primary/10 text-primary font-bold rounded-lg relative before:absolute before:w-2 before:h-2 before:bg-primary before:rounded-full before:-left-[0.85rem] before:top-1/2 before:-translate-y-1/2' : 'rounded-lg hover:bg-base-200' }}">Request Buku</a></li>
                </ul>
            </details>
        </li>
        
        <li class="menu-title mt-4 mb-2"><span class="text-xs font-black text-base-content/40 tracking-wider">SIRKULASI & LAPORAN</span></li>
        <li>
            <details class="group" {{ request()->routeIs('admin.loans.*') || request()->routeIs('admin.loan-requests.*') || request()->routeIs('admin.laporan.*') || request()->routeIs('admin.leaderboard') ? 'open' : '' }}>
                <summary class="hover:bg-base-200 rounded-xl font-bold flex items-center justify-between {{ request()->routeIs('admin.loans.*') || request()->routeIs('admin.loan-requests.*') || request()->routeIs('admin.laporan.*') || request()->routeIs('admin.leaderboard') ? 'bg-base-200 text-primary' : '' }}">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        Peminjaman
                    </div>
                </summary>
                <ul class="mt-2 space-y-1 relative before:absolute before:bg-base-300 before:w-px before:h-[calc(100%-1.5rem)] before:left-3.5 before:top-4">
                    <li><a href="{{ route('admin.loans.index') }}" class="{{ request()->routeIs('admin.loans.*') ? 'active bg-primary/10 text-primary font-bold rounded-lg relative before:absolute before:w-2 before:h-2 before:bg-primary before:rounded-full before:-left-[0.85rem] before:top-1/2 before:-translate-y-1/2' : 'rounded-lg hover:bg-base-200' }}">Daftar Sirkulasi</a></li>
                    <li><a href="{{ route('admin.loan-requests.index') }}" class="{{ request()->routeIs('admin.loan-requests.*') ? 'active bg-primary/10 text-primary font-bold rounded-lg relative before:absolute before:w-2 before:h-2 before:bg-primary before:rounded-full before:-left-[0.85rem] before:top-1/2 before:-translate-y-1/2' : 'rounded-lg hover:bg-base-200' }}">Permintaan Pinjam</a></li>
                    <li><a href="{{ route('admin.leaderboard') }}" class="{{ request()->routeIs('admin.leaderboard') ? 'active bg-primary/10 text-primary font-bold rounded-lg relative before:absolute before:w-2 before:h-2 before:bg-primary before:rounded-full before:-left-[0.85rem] before:top-1/2 before:-translate-y-1/2' : 'rounded-lg hover:bg-base-200' }}">Leaderboard Ranking</a></li>
                    <li><a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.*') ? 'active bg-primary/10 text-primary font-bold rounded-lg relative before:absolute before:w-2 before:h-2 before:bg-primary before:rounded-full before:-left-[0.85rem] before:top-1/2 before:-translate-y-1/2' : 'rounded-lg hover:bg-base-200' }}">Laporan Cetak</a></li>
                </ul>
            </details>
        </li>
    </ul>

    <!-- User Info & Logout -->
    <div class="p-4 border-t border-base-200 bg-base-100 mb-2">
        <div class="bg-base-200/60 border border-base-300 rounded-2xl p-4 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="avatar border-2 border-primary shadow-sm shadow-primary/20 rounded-full p-0.5">
                    <div class="w-10 rounded-full">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=E0E7FF&color=4F46E5&bold=true" />
                    </div>
                </div>
                <div class="overflow-hidden">
                    <p class="font-bold text-base-content truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-black text-primary uppercase tracking-widest mt-0.5">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="btn bg-error/10 hover:bg-error border-none text-error hover:text-white btn-sm w-full rounded-xl hover:-translate-y-0.5 transition-all duration-300 font-bold shadow-sm">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
    </svg>
    Logout Akun
</button>
            </form>
        </div>
    </div>
</div>
