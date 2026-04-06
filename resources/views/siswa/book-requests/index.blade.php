<x-app-layout>
<div class="p-6 space-y-4">

    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">📬 Request Buku Saya</h2>
        <a href="{{ route('siswa.book-requests.create') }}" class="btn btn-primary btn-sm">
            + Ajukan Request
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="space-y-3">
        @forelse($requests as $req)
        <div class="bg-base-100 border border-base-300 rounded-xl p-4">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1">
                    <p class="font-semibold">{{ $req->book_title }}</p>
                    @if($req->author)
                        <p class="text-sm text-base-content/60">{{ $req->author }}</p>
                    @endif
                    <p class="text-sm text-base-content/50 mt-1">
                        Diajukan {{ $req->created_at->diffForHumans() }}
                    </p>
                    <p class="text-sm mt-2 bg-base-200 rounded-lg p-2">
                        <span class="text-base-content/60">Alasan:</span> {{ $req->reason }}
                    </p>
                    @if($req->rejection_reason)
                        <p class="text-sm mt-2 bg-error/10 text-error rounded-lg p-2">
                            <span class="font-medium">Alasan ditolak:</span> {{ $req->rejection_reason }}
                        </p>
                    @endif
                </div>
                <div class="flex flex-col items-end gap-2">
                    <span class="badge
                        {{ $req->status === 'pending'   ? 'badge-warning' : '' }}
                        {{ $req->status === 'disetujui' ? 'badge-success' : '' }}
                        {{ $req->status === 'ditolak'   ? 'badge-error'   : '' }}">
                        {{ $req->status === 'pending'   ? '⏳ Pending'   : '' }}
                        {{ $req->status === 'disetujui' ? '✅ Disetujui' : '' }}
                        {{ $req->status === 'ditolak'   ? '❌ Ditolak'   : '' }}
                    </span>

                    @if($req->status === 'pending')
                    <form action="{{ route('siswa.book-requests.destroy', $req) }}" method="POST"
                        onsubmit="return confirm('Batalkan request ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-xs btn-ghost text-error">Batalkan</button>
                    </form>
                    @endif

                    @if($req->status === 'disetujui')
                        <p class="text-xs text-success">+5 poin diterima 🎉</p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-12 text-base-content/50">
            <p class="text-4xl mb-3">📭</p>
            <p>Belum ada request buku.</p>
            <a href="{{ route('siswa.book-requests.create') }}"
                class="btn btn-primary btn-sm mt-4">Ajukan Sekarang</a>
        </div>
        @endforelse
    </div>

    {{ $requests->links() }}
</div>
</x-app-layout>
