<x-app-layout>
<div class="p-4 sm:p-8 max-w-3xl mx-auto space-y-6">

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.book-requests.index') }}" class="btn btn-circle btn-ghost shadow-sm bg-base-100 hover:bg-base-200 border border-base-200" title="Kembali">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h2 class="text-3xl font-bold text-base-content">Detail Pengajuan</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-2xl border border-success/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-base-100 shadow-xl shadow-base-200/50 rounded-3xl overflow-hidden border border-base-200">
        {{-- Header Card --}}
        <div class="relative bg-gradient-to-r from-base-200/50 to-base-100 p-8 sm:p-10 border-b border-base-200">
            <div class="absolute top-6 right-6 sm:top-10 sm:right-10">
                @php
                    $statusClasses = [
                        'pending' => 'badge-warning shadow-warning/30 text-warning-content',
                        'disetujui' => 'badge-success shadow-success/30 text-success-content',
                        'ditolak' => 'badge-error shadow-error/30 text-error-content'
                    ];
                    $statusIcons = [
                        'pending' => '⏳',
                        'disetujui' => '✅',
                        'ditolak' => '❌'
                    ];
                @endphp
                <span class="badge badge-lg sm:py-4 sm:px-5 py-3 px-3 font-bold shadow-lg border-none {{ $statusClasses[$bookRequest->status] ?? 'badge-ghost' }}">
                    <span class="mr-1">{{ $statusIcons[$bookRequest->status] ?? '' }}</span> {{ ucfirst($bookRequest->status) }}
                </span>
            </div>
            
            <div class="pr-32">
                <h3 class="text-2xl sm:text-4xl font-extrabold text-base-content mb-3 leading-tight">{{ $bookRequest->book_title }}</h3>
                <div class="flex items-center gap-2 text-base-content/70">
                    <div class="bg-base-300 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <span class="font-medium text-lg">{{ $bookRequest->author ?? 'Penulis tidak dicantumkan' }}</span>
                </div>
            </div>
        </div>

        {{-- Body Card --}}
        <div class="p-8 sm:p-10 space-y-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-base-200/40 p-6 rounded-3xl border border-base-200">
                <div>
                    <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Diajukan oleh</span>
                    <div class="flex items-center gap-3">
                        <div class="avatar placeholder shadow-sm rounded-full">
                            <div class="bg-primary text-primary-content rounded-full w-10">
                                <span class="text-sm font-bold">{{ substr($bookRequest->user->name, 0, 2) }}</span>
                            </div>
                        </div>
                        <span class="font-bold text-lg text-base-content">{{ $bookRequest->user->name }}</span>
                    </div>
                </div>
                <div>
                    <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">NIS Siswa</span>
                    <span class="inline-block font-mono text-base font-semibold bg-base-100 px-4 py-2 rounded-xl border border-base-300 shadow-sm">{{ $bookRequest->user->nis }}</span>
                </div>
                <div class="sm:col-span-2 pt-2 border-t border-base-300/50">
                    <span class="block text-xs font-bold text-base-content/50 uppercase tracking-wider mb-2">Waktu Pengajuan</span>
                    <div class="flex items-center gap-2 text-base-content/80 font-medium">
                        <div class="bg-base-100 p-1.5 rounded-lg border border-base-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-base">{{ $bookRequest->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                </div>
            </div>

            <div>
                <span class="flex items-center gap-2 text-sm font-bold text-base-content mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Alasan Pengajuan
                </span>
                <div class="bg-info/10 border-l-4 border-info p-5 rounded-r-2xl">
                    <p class="text-base leading-relaxed text-base-content/80 font-medium">{{ $bookRequest->reason ?? 'Tidak ada alasan yang diberikan.' }}</p>
                </div>
            </div>

            @if($bookRequest->rejection_reason)
            <div class="pt-2">
                <span class="flex items-center gap-2 text-sm font-bold text-error mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Alasan Penolakan Admin
                </span>
                <div class="bg-error/10 border-l-4 border-error p-5 rounded-r-2xl">
                    <p class="text-base leading-relaxed text-error font-semibold">{{ $bookRequest->rejection_reason }}</p>
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- Aksi --}}
    @if($bookRequest->status === 'pending')
    <div class="flex flex-col sm:flex-row gap-4 pt-4">
        <form action="{{ route('admin.book-requests.approve', $bookRequest) }}" method="POST"
            class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui request buku ini?')">
            @csrf @method('PATCH')
            <button class="btn btn-success btn-lg w-full rounded-2xl shadow-lg shadow-success/30 text-success-content hover:-translate-y-1 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Setujui Pengajuan
            </button>
        </form>

        <button onclick="document.getElementById('modal-reject-show').classList.remove('hidden')"
            class="btn btn-error btn-lg flex-1 rounded-2xl shadow-lg shadow-error/30 text-error-content hover:bg-error-focus hover:-translate-y-1 transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Tolak Pengajuan
        </button>
    </div>
    @endif

</div>

{{-- Modal Tolak --}}
<div id="modal-reject-show" class="hidden fixed inset-0 bg-base-300/60 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
    <div class="bg-base-100 rounded-3xl p-6 md:p-8 w-full max-w-md shadow-2xl scale-100 animate-in fade-in zoom-in-95">
        <h3 class="text-xl font-bold mb-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Tolak Request
        </h3>
        <p class="text-sm text-base-content/70 mb-5">Anda akan menolak pengajuan buku <span class="font-bold text-base-content">"{{ $bookRequest->book_title }}"</span>.</p>
        
        <form action="{{ route('admin.book-requests.reject', $bookRequest) }}" method="POST" class="space-y-5">
            @csrf @method('PATCH')
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Alasan Penolakan (Opsional)</span>
                </label>
                <textarea name="rejection_reason" rows="3"
                    class="textarea textarea-bordered w-full rounded-2xl focus:textarea-error transition-colors"
                    placeholder="Contoh: Maaf, buku ini tidak sesuai dengan kurikulum sekolah..."></textarea>
            </div>
            
            <div class="flex gap-3 justify-end pt-2">
                <button type="button"
                    onclick="document.getElementById('modal-reject-show').classList.add('hidden')"
                    class="btn btn-ghost rounded-xl">Batal</button>
                <button class="btn btn-error rounded-xl px-8 shadow-error/30 shadow-lg">Tolak Request</button>
            </div>
        </form>
    </div>
</div>

<script>
// Close modal when clicking outside
window.onclick = function(event) {
    const modalReject = document.getElementById('modal-reject-show');
    if (event.target == modalReject) {
        modalReject.classList.add('hidden');
    }
}
</script>
</x-app-layout>
