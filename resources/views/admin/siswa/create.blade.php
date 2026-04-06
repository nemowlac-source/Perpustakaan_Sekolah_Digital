<x-app-layout>
<div class="p-6 max-w-lg mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost btn-sm">← Kembali</a>
        <h2 class="text-xl font-semibold">Tambah Anggota Siswa</h2>
    </div>

    <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="label"><span class="label-text">Nama Lengkap</span></label>
            <input name="name" value="{{ old('name') }}"
                class="input input-bordered w-full @error('name') input-error @enderror"
                placeholder="Contoh: Budi Santoso" required>
            @error('name')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">NIS</span></label>
            <input name="nis" value="{{ old('nis') }}"
                class="input input-bordered w-full font-mono @error('nis') input-error @enderror"
                placeholder="Contoh: 2024001" required>
            @error('nis')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">Username</span></label>
            <input name="username" value="{{ old('username') }}"
                class="input input-bordered w-full @error('username') input-error @enderror"
                placeholder="Contoh: budi_santoso" required>
            @error('username')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">Email</span></label>
            <input name="email" type="email" value="{{ old('email') }}"
                class="input input-bordered w-full @error('email') input-error @enderror"
                placeholder="Contoh: budi@sekolah.sch.id" required>
            @error('email')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="label"><span class="label-text">Password</span></label>
                <input name="password" type="password"
                    class="input input-bordered w-full @error('password') input-error @enderror"
                    placeholder="Min. 6 karakter" required>
                @error('password')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="label"><span class="label-text">Konfirmasi Password</span></label>
                <input name="password_confirmation" type="password"
                    class="input input-bordered w-full"
                    placeholder="Ulangi password" required>
            </div>
        </div>

        <div class="bg-base-200 rounded-lg p-3 text-sm text-base-content/70">
            💡 Tips: gunakan NIS sebagai password awal agar mudah diingat siswa.
        </div>

        <div class="flex gap-2 justify-end pt-2">
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost">Batal</a>
            <button class="btn btn-primary">Simpan Akun</button>
        </div>
    </form>
</div>
</x-app-layout>
