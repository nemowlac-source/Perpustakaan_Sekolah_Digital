<x-app-layout>
<div class="p-4 sm:p-8 space-y-6">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-base-100 p-6 rounded-3xl shadow-sm border border-base-200">
        <div>
            <h2 class="text-2xl font-bold text-base-content flex items-center gap-2">
                <span class="text-3xl">📬</span> Request Buku Siswa
            </h2>
            <p class="text-sm text-base-content/60 mt-1">Kelola permohonan pengadaan buku dari siswa.</p>
        </div>
        
        <form method="GET" class="w-full md:w-auto flex flex-row gap-2">
            <input name="status" type="hidden" value="{{ request('status') }}">
            <div class="relative w-full md:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input name="q" value="{{ request('q') }}"
                    placeholder="Cari buku, siswa..."
                    class="input input-bordered w-full pl-10 rounded-full focus:input-primary transition-colors bg-base-200/50">
            </div>
            <button class="btn btn-primary btn-circle shadow-lg shadow-primary/30 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-2xl border border-success/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error shadow-sm rounded-2xl border border-error/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Stat Badge --}}
    <div class="flex gap-3 flex-wrap">
        <a href="{{ route('admin.book-requests.index') }}"
            class="btn btn-sm rounded-full {{ !request('status') ? 'btn-light shadow-lg' : 'btn-ghost bg-base-200/50 hover:bg-base-200' }} border-none transition-all">
            Semua
        </a>
        <a href="{{ route('admin.book-requests.index', ['status' => 'pending']) }}"
            class="btn btn-sm rounded-full {{ request('status') === 'pending' ? 'btn-warning shadow-lg shadow-warning/30' : 'btn-ghost text-warning hover:bg-warning/10' }} border-none transition-all">
            ⏳ Pending
            <div class="badge badge-sm border-none shadow-sm {{ request('status') === 'pending' ? 'badge-neutral' : 'bg-warning text-warning-content' }} ml-1">{{ $counts['pending'] }}</div>
        </a>
        <a href="{{ route('admin.book-requests.index', ['status' => 'disetujui']) }}"
            class="btn btn-sm rounded-full {{ request('status') === 'disetujui' ? 'btn-success shadow-lg shadow-success/30' : 'btn-ghost text-success hover:bg-success/10' }} border-none transition-all">
            ✅ Disetujui
            <div class="badge badge-sm border-none shadow-sm {{ request('status') === 'disetujui' ? 'badge-neutral' : 'bg-success text-success-content' }} ml-1">{{ $counts['disetujui'] }}</div>
        </a>
        <a href="{{ route('admin.book-requests.index', ['status' => 'ditolak']) }}"
            class="btn btn-sm rounded-full {{ request('status') === 'ditolak' ? 'btn-error shadow-lg shadow-error/30' : 'btn-ghost text-error hover:bg-error/10' }} border-none transition-all">
            ❌ Ditolak
            <div class="badge badge-sm border-none shadow-sm {{ request('status') === 'ditolak' ? 'badge-neutral' : 'bg-error text-error-content' }} ml-1">{{ $counts['ditolak'] }}</div>
        </a>
    </div>

    {{-- Tabel --}}
    <div class="bg-base-100 rounded-3xl shadow-sm border border-base-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead class="bg-base-200/50 text-base-content/70">
                    <tr>
                        <th class="w-16 text-center">#</th>
                        <th>Siswa</th>
                        <th>Buku Request</th>
                        <th>Alasan</th>
                        <th class="text-center">Tgl Ajuan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                    <tr class="hover group">
                        <td class="text-center font-medium">{{ $loop->iteration }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-10">
                                        <span class="text-xs">{{ substr($req->user->name, 0, 2) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $req->user->name }}</div>
                                    <div class="text-xs opacity-50">{{ $req->user->nis }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-bold flex items-center gap-2">
                                <span class="block max-w-[180px] truncate" title="{{ $req->book_title }}">{{ $req->book_title }}</span>
                            </div>
                            <div class="text-sm opacity-70 flex items-center gap-1 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                <span class="truncate block max-w-[160px]" title="{{ $req->author }}">{{ $req->author ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="max-w-[200px]">
                            <p class="text-sm line-clamp-2 text-base-content/80" title="{{ $req->reason }}">{{ $req->reason ?? '-' }}</p>
                        </td>
                        <td class="text-sm text-center font-medium whitespace-nowrap">
                            <div class="flex flex-col items-center">
                                <span>{{ $req->created_at->format('d M Y') }}</span>
                                <span class="text-xs text-base-content/50">{{ $req->created_at->format('H:i') }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'badge-warning shadow-warning/20',
                                    'disetujui' => 'badge-success shadow-success/20',
                                    'ditolak' => 'badge-error shadow-error/20'
                                ];
                                $statusIcons = [
                                    'pending' => '⏳',
                                    'disetujui' => '✅',
                                    'ditolak' => '❌'
                                ];
                            @endphp
                            <span class="badge badge-sm font-semibold py-3 px-3 shadow-sm {{ $statusClasses[$req->status] ?? 'badge-ghost' }}">
                                {{ $statusIcons[$req->status] ?? '' }} {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2 justify-center opacity-100 transition-opacity">
                                <a href="{{ route('admin.book-requests.show', $req) }}"
                                    class="btn btn-sm btn-circle btn-ghost text-info hover:bg-info hover:text-info-content" title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </a>

                                @if($req->status === 'pending')
                                    {{-- Setujui --}}
                                    <form action="{{ route('admin.book-requests.approve', $req) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menyetujui request buku ini?')">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-circle btn-ghost text-success hover:bg-success hover:text-success-content" title="Setujui">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        </button>
                                    </form>

                                    {{-- Tolak --}}
                                    <button type="button" onclick="openReject({{ $req->id }}, '{{ addslashes($req->book_title) }}')"
                                        class="btn btn-sm btn-circle btn-ghost text-error hover:bg-error hover:text-error-content" title="Tolak">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                @endif

                                {{-- Hapus --}}
                                <form action="{{ route('admin.book-requests.destroy', $req) }}" method="POST"
                                    onsubmit="return confirm('Hapus request buku ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-circle btn-ghost text-base-content/50 hover:bg-error hover:text-error-content hover:opacity-100" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-16">
                            <div class="flex flex-col items-center justify-center text-base-content/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-lg font-medium">Belum ada request buku</p>
                                <p class="text-sm mt-1">Belum ada siswa yang mengajukan request buku.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($requests, 'hasPages') && $requests->hasPages())
        <div class="p-4 border-t border-base-200">
            {{ $requests->links() }}
        </div>
        @elseif($requests instanceof \Illuminate\Pagination\LengthAwarePaginator && $requests->hasPages())
        <div class="p-4 border-t border-base-200">
            {{ $requests->links() }}
        </div>
        @elseif(isset($requests) && method_exists($requests, 'links') && trim($requests->links()) != '')
        <div class="p-4 border-t border-base-200">
            {{ $requests->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Modal Tolak --}}
<div id="modal-reject" class="hidden fixed inset-0 bg-base-300/60 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
    <div class="bg-base-100 rounded-3xl p-6 md:p-8 w-full max-w-md shadow-2xl scale-100 animate-in fade-in zoom-in-95">
        <h3 class="text-xl font-bold mb-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Tolak Request
        </h3>
        <p class="text-sm text-base-content/70 mb-5">Anda akan menolak pengajuan <span id="reject-title" class="font-bold text-base-content"></span>.</p>
        
        <form id="form-reject" method="POST" class="space-y-5">
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
                    onclick="document.getElementById('modal-reject').classList.add('hidden')"
                    class="btn btn-ghost rounded-xl">Batal</button>
                <button class="btn btn-error rounded-xl px-8 shadow-error/30 shadow-lg">Tolak Request</button>
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

// Close modals when clicking outside
window.onclick = function(event) {
    const modalReject = document.getElementById('modal-reject');
    if (event.target == modalReject) {
        modalReject.classList.add('hidden');
    }
}
</script>
</x-app-layout>
