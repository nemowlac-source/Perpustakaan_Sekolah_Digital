<div class="navbar bg-base-100 shadow-md px-4 md:px-8 border-b">
    <div class="flex-1">
        <a href="{{ route('siswa.dashboard') }}" class="btn btn-ghost text-xl text-primary font-bold">PerpusKita</a>
    </div>
    <div class="flex-none gap-4">
        <ul class="menu menu-horizontal px-1 hidden md:flex font-medium">
            <li><a href="{{ route('siswa.dashboard') }}">Cari Buku</a></li>
            <li><a href="{{ route('siswa.loans.index') }}">Pinjaman Saya</a></li>
            <li><a href="{{ route('siswa.book-requests.index') }}">Request</a></li>
        </ul>

        {{-- Badge Poin Siswa --}}
        <div class="badge badge-warning gap-2 p-4 font-bold">
            ⭐ {{ Auth::user()->points }} Poin
        </div>

        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" />
                </div>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52 border border-base-300">
                <li class="menu-title">{{ Auth::user()->name }}</li>
                <li><a href="/profile text-xs">{{ Auth::user()->nis }}</a></li>
                <div class="divider my-0"></div>
                <li><a href="/profile">Profile Saya</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-error font-semibold">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
