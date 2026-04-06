<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Verifikasi Reservasi Buku</h2>
            <div class="badge badge-primary">{{ $requests->count() }} Permohonan Baru</div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Buku</th>
                            <th>Tanggal Request</th>
                            <th>Stok Tersedia</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                            <tr>
                                <td>
                                    <div class="font-bold">{{ $req->user->name }}</div>
                                    <div class="text-xs opacity-50">{{ $req->user->username }}</div>
                                </td>
                                <td>
                                    <div class="font-medium">{{ $req->book->title }}</div>
                                    <div class="text-xs italic">{{ $req->book->author }}</div>
                                </td>
                                <td>{{ $req->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="badge {{ $req->book->stock > 0 ? 'badge-success' : 'badge-error' }}">
                                        {{ $req->book->stock }} unit
                                    </div>
                                </td>
                                <td class="flex justify-center gap-2">
                                    {{-- Tombol Setuju --}}
                                    <form action="{{ route('admin.loan-requests.approve', $req->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm text-white"
                                            onclick="return confirm('Siswa sudah di depan meja dan menerima buku?')">
                                            ✅ Serahkan Buku
                                        </button>
                                    </form>

                                    {{-- Tombol Tolak (Modal bisa ditambahkan jika perlu alasan) --}}
                                    <form action="{{ route('admin.loan-requests.reject', $req->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-error btn-sm text-white"
                                            onclick="return confirm('Tolak pengajuan ini?')">
                                            ❌ Tolak
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 opacity-50 italic">
                                    Belum ada pengajuan peminjaman baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    </div>
</x-app-layout>
