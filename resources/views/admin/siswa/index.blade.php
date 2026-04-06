<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Manajemen Anggota Siswa</h2>
            <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm">+ Tambah Siswa</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error mb-4">{{ session('error') }}</div>
        @endif

        {{-- Search --}}
        <form method="GET" class="mb-4 flex gap-2">
            <input name="q" value="{{ request('q') }}" placeholder="Cari nama / NIS / username..."
                class="input input-bordered flex-1">
            <button class="btn btn-ghost">Cari</button>
            @if (request('q'))
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-ghost">Reset</a>
            @endif
        </form>
        <div class="card bg-base-100 p-6 shadow-sm border border-base-300 mb-6">
            <h3 class="font-bold mb-4">Bulk Import Siswa (Excel)</h3>
            <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit">Import Sekarang</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Poin</th>
                        <th>Pinjaman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="avatar placeholder">
                                        <div class="bg-neutral text-neutral-content rounded-full w-8">
                                            <span class="text-xs">{{ strtoupper(substr($siswa->name, 0, 2)) }}</span>
                                        </div>
                                    </div>
                                    <span class="font-medium">{{ $siswa->name }}</span>
                                </div>
                            </td>
                            <td class="font-mono text-sm">{{ $siswa->nis }}</td>
                            <td>{{ $siswa->username }}</td>
                            <td class="text-sm">{{ $siswa->email }}</td>
                            <td>
                                <span class="badge badge-warning badge-sm">
                                    🏆 {{ $siswa->points }}
                                </span>
                            </td>
                            <td>
                                <span class="text-sm">{{ $siswa->loans_count }} total</span>
                                @if ($siswa->aktif_count > 0)
                                    <span class="badge badge-info badge-xs ml-1">
                                        {{ $siswa->aktif_count }} aktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex gap-1 flex-wrap">
                                    <a href="{{ route('admin.siswa.show', $siswa) }}"
                                        class="btn btn-xs btn-info">Detail</a>
                                    <a href="{{ route('admin.siswa.edit', $siswa) }}"
                                        class="btn btn-xs btn-warning">Edit</a>

                                    {{-- Reset Password --}}
                                    <form action="{{ route('admin.siswa.reset-password', $siswa) }}" method="POST"
                                        onsubmit="return confirm('Reset password ke NIS siswa?')">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-xs btn-ghost">Reset PW</button>
                                    </form>

                                    {{-- Hapus --}}
                                    <form action="{{ route('admin.siswa.destroy', $siswa) }}" method="POST"
                                        onsubmit="return confirm('Hapus akun {{ $siswa->name }}?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-xs btn-error">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-base-content/50 py-8">
                                Belum ada data siswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $siswas->links() }}
    </div>
</x-app-layout>
