<x-app-layout>
<div class="p-6 max-w-lg mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost btn-sm">← Kembali</a>
        <h2 class="text-xl font-semibold">Edit Data Siswa</h2>
    </div>

    <form action="{{ route('admin.siswa.update', $siswa) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="label"><span class="label-text">Nama Lengkap</span></label>
            <input name="name" value="{{ old('name', $siswa->name) }}"
                class="input input-bordered w-full @error('name') input-error @enderror" required>
            @error('name')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">NIS</span></label>
            <input name="nis" value="{{ old('nis', $siswa->nis) }}"
                class="input input-bordered w-full font-mono @error('nis') input-error @enderror" required>
            @error('nis')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">Username</span></label>
            <input name="username" value="{{ old('username', $siswa->username) }}"
                class="input input-bordered w-full @error('username') input-error @enderror" required>
            @error('username')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">Email</span></label>
            <input name="email" type="email" value="{{ old('email', $siswa->email) }}"
                class="input input-bordered w-full @error('email') input-error @enderror" required>
            @error('email')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="divider text-sm">Ganti Password (opsional)</div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="label"><span class="label-text">Password Baru</span></label>
                <input name="password" type="password"
                    class="input input-bordered w-full"
                    placeholder="Kosongkan jika tidak diubah">
            </div>
            <div>
                <label class="label"><span class="label-text">Konfirmasi Password</span></label>
                <input name="password_confirmation" type="password"
                    class="input input-bordered w-full"
                    placeholder="Ulangi password baru">
            </div>
        </div>

        <div class="flex gap-2 justify-end pt-2">
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost">Batal</a>
            <button class="btn btn-warning">Update Data</button>
        </div>
    </form>
</div>
</x-app-layout>
