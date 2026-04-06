<x-app-layout>
<div class="p-6 space-y-4">

    <h2 class="text-xl font-semibold">📬 Request Buku dari Siswa</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    {{-- Stat Badge --}}
    <div class="flex gap-3 flex-wrap">
        <a href="{{ route('admin.book-requests.index') }}"
            class="badge badge-lg {{ !request('status') ? 'badge-neutral' : 'badge-ghost' }} gap-1 cursor-pointer">
            Semua
        </a>
        <a href="{{ route('admin.book-requests.index', ['status' => 'pending']) }}"
            class="badge badge-lg {{ request('status') === 'pending' ? 'badge-warning' : 'badge-ghost' }} gap-1 cursor-pointer">
            ⏳ Pending ({{ $counts['pending'] }})
        </a>
        <a href="{{ route('admin.book-requests.index', ['status' => 'disetujui']) }}"
            class="badge badge-lg {{ request('status') === 'disetujui' ? 'badge-success' : 'badge-ghost' }} gap-1 cursor-pointer">
            ✅ Disetujui ({{ $counts['disetujui'] }})
        </a>
        <a href="{{ route('admin.book-requests.index', ['status' => 'ditolak']) }}"
            class="badge badge-lg {{ request('status') === 'ditolak' ? 'badge-error' : 'badge-ghost' }} gap-1 cursor-pointer">
            ❌ Ditolak ({{ $counts['ditolak'] }})
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" class="flex gap-2">
        <input name="status" type="hidden" value="{{ request('status') }}">
        <input name="q" value="{{ request('q') }}"
            placeholder="Cari judul buku / penulis / nama siswa..."
            class="input input-bordered flex-1">
        <button class="btn btn-ghost">Cari</button>
    </form>

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Siswa</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Alasan</th>
                    <th>Tgl Ajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <p class="font-medium">{{ $req->user->name }}</p>
                        <p class="text-xs text-base-content/50">{{ $req->user->nis }}</p>
                    </td>
                    <td class="font-medium max-w-[160px]">
                        <p class="truncate">{{ $req->book_title }}</p>
                    </td>
                    <td class="text-sm">{{ $req->author ?? '-' }}</td>
                    <td class="text-sm max-w-[200px]">
                        <p class="line-clamp-2">{{ $req->reason }}</p>
                    </td>
                    <td class="text-sm">{{ $req->created_at->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge badge-sm
                            {{ $req->status === 'pending'   ? 'badge-warning' : '' }}
                            {{ $req->status === 'disetujui' ? 'badge-success' : '' }}
                            {{ $req->status === 'ditolak'   ? 'badge-error'   : '' }}">
                            {{ ucfirst($req->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-1 flex-wrap">
                            <a href="{{ route('admin.book-requests.show', $req) }}"
                                class="btn btn-xs btn-ghost">Detail</a>

                            @if($req->status === 'pending')
                                {{-- Setujui --}}
                                <form action="{{ route('admin.book-requests.approve', $req) }}" method="POST"
                                    onsubmit="return confirm('Setujui request ini?')">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-xs btn-success">✓ Setujui</button>
                                </form>

                                {{-- Tolak --}}
                                <button onclick="openReject({{ $req->id }}, '{{ addslashes($req->book_title) }}')"
                                    class="btn btn-xs btn-error">✗ Tolak</button>
                            @endif

                            {{-- Hapus --}}
                            <form action="{{ route('admin.book-requests.destroy', $req) }}" method="POST"
                                onsubmit="return confirm('Hapus request ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-ghost text-error">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-base-content/50 py-8">
                        Tidak ada request buku.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $requests->links() }}
</div>

{{-- Modal Tolak --}}
<div id="modal-reject" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-base-100 rounded-xl p-6 w-80">
        <h3 class="font-semibold mb-1">Tolak Request</h3>
        <p id="reject-title" class="text-sm text-base-content/60 mb-4"></p>
        <form id="form-reject" method="POST" class="space-y-3">
            @csrf @method('PATCH')
            <div>
                <label class="label"><span class="label-text">Alasan Penolakan (opsional)</span></label>
                <textarea name="rejection_reason" rows="3"
                    class="textarea textarea-bordered w-full"
                    placeholder="Contoh: Buku tidak sesuai kurikulum..."></textarea>
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button"
                    onclick="document.getElementById('modal-reject').classList.add('hidden')"
                    class="btn btn-ghost btn-sm">Batal</button>
                <button class="btn btn-error btn-sm">Tolak Request</button>
            </div>
        </form>
    </div>
</div>

<script>
function openReject(id, title) {
    document.getElementById('form-reject').action = `/admin/book-requests/${id}/reject`;
    document.getElementById('reject-title').textContent = `"${title}"`;
    document.getElementById('modal-reject').classList.remove('hidden');
}
</script>
</x-app-layout>
