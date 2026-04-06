<div class="navbar bg-primary text-primary-content shadow-lg px-4 md:px-8">
    <div class="flex-1">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost text-xl normal-case">📚 LibAdmin</a>
    </div>
    <div class="flex-none gap-2">
        <ul class="menu menu-horizontal px-1 hidden md:flex">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li>
                <details>
                    <summary>Master Data</summary>
                    <ul class="p-2 bg-primary text-primary-content rounded-t-none shadow-xl z-50">
                        <li><a href="{{ route('admin.books.index') }}">Buku</a></li>
                        <li><a href="{{ route('admin.siswa.index') }}">Anggota</a></li>
                    </ul>
                </details>
            </li>
            <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
            <li><a href="{{ route('admin.loan-requests.index') }}">Permintaan Peminjaman</a></li>
            <li><a href="{{ route('admin.loans.index') }}">Peminjaman</a></li>
            <li><a href="{{ route('admin.leaderboard') }}">Leaderboard</a></li>
            <li><a href="{{ route('admin.book-requests.index') }}">Request</a></li>
            <li><a href="{{ route('admin.laporan.index') }}">Laporan</a></li>
        </ul>

        <div class="dropdown dropdown-end text-base-content">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full border-2 border-white">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" />
                </div>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                <li class="menu-title text-primary">Admin</li>
                <li><a href="/profile">Edit Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-error">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
