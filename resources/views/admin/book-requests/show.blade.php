<x-app-layout>
<div class="p-6 max-w-lg mx-auto space-y-4">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.book-requests.index') }}" class="btn btn-ghost btn-sm">← Kembali</a>
        <h2 class="text-xl font-semibold">Detail Request Buku</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="bg-base-100 border border-base-300 rounded-xl p-5 space-y-3">

        <div class="flex justify-between items-start">
            <div>
                <p class="text-lg font-semibold">{{ $bookRequest->book_title }}</p>
                <p class="text-sm text-base-content/60">{{ $bookRequest->author ?? 'Penulis tidak dicantumkan' }}</p>
            </div>
            <span class="badge
                {{ $bookRequest->status === 'pending'   ? 'badge-warning' : '' }}
                {{ $bookRequest->status === 'disetujui' ? 'badge-success' : '' }}
                {{ $bookRequest->status === 'ditolak'   ? 'badge-error'   : '' }}">
                {{ ucfirst($bookRequest->status) }}
            </span>
        </div>

        <div class="divider my-1"></div>

        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-base-content/60">Diajukan oleh</span>
                <span class="font-medium">{{ $bookRequest->user->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-base-content/60">NIS</span>
                <span class="font-mono">{{ $bookRequest->user->nis }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-base-content/60">Tanggal Ajuan</span>
                <span>{{ $bookRequest->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <div class="divider my-1"></div>

        <div>
            <p class="text-sm text-base-content/60 mb-1">Alasan Pengajuan</p>
            <p class="text-sm bg-base-200 rounded-lg p-3">{{ $bookRequest->reason }}</p>
        </div>

        @if($bookRequest->rejection_reason)
        <div>
            <p class="text-sm text-error mb-1">Alasan Penolakan</p>
            <p class="text-sm bg-error/10 text-error rounded-lg p-3">{{ $bookRequest->rejection_reason }}</p>
        </div>
        @endif

    </div>

    {{-- Aksi --}}
    @if($bookRequest->status === 'pending')
    <div class="flex gap-2">
        <form action="{{ route('admin.book-requests.approve', $bookRequest) }}" method="POST"
            class="flex-1" onsubmit="return confirm('Setujui request ini?')">
            @csrf @method('PATCH')
            <button class="btn btn-success w-full">✓ Setujui Request</button>
        </form>

        <button onclick="document.getElementById('modal-reject-show').classList.remove('hidden')"
            class="btn btn-error flex-1">✗ Tolak Request</button>
    </div>
    @endif

</div>

{{-- Modal Tolak --}}
<div id="modal-reject-show" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-base-100 rounded-xl p-6 w-80">
        <h3 class="font-semibold mb-4">Tolak Request</h3>
        <form action="{{ route('admin.book-requests.reject', $bookRequest) }}" method="POST" class="space-y-3">
            @csrf @method('PATCH')
            <div>
                <label class="label"><span class="label-text">Alasan Penolakan (opsional)</span></label>
                <textarea name="rejection_reason" rows="3"
                    class="textarea textarea-bordered w-full"
                    placeholder="Contoh: Buku tidak sesuai kurikulum..."></textarea>
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button"
                    onclick="document.getElementById('modal-reject-show').classList.add('hidden')"
                    class="btn btn-ghost btn-sm">Batal</button>
                <button class="btn btn-error btn-sm">Tolak</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
