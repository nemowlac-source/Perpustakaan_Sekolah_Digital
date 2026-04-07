<x-app-layout>
<div class="p-4 sm:p-8 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-base-100 p-6 rounded-3xl shadow-sm border border-base-200">
        <div>
            <h2 class="text-2xl font-bold text-base-content">Manajemen Kategori</h2>
            <p class="text-sm text-base-content/60 mt-1">Kelola daftar kategori buku perpustakaan.</p>
        </div>
        <button onclick="document.getElementById('modal-add').classList.remove('hidden')"
            class="btn btn-primary rounded-full shadow-lg shadow-primary/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Kategori
        </button>
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

    <div class="bg-base-100 rounded-3xl shadow-sm border border-base-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead class="bg-base-200/50 text-base-content/70">
                    <tr>
                        <th class="w-16 text-center">#</th>
                        <th>Nama Kategori</th>
                        <th class="text-center">Jumlah Buku</th>
                        <th class="w-40 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr class="hover whitespace-nowrap">
                        <td class="text-center font-medium">{{ $loop->iteration }}</td>
                        <td class="font-semibold">{{ $cat->name }}</td>
                        <td class="text-center">
                            <span class="badge badge-ghost badge-md">{{ $cat->books_count }} Buku</span>
                        </td>
                        <td>
                            <div class="flex gap-2 justify-center">
                                {{-- Edit (inline modal) --}}
                                <button onclick="openEdit({{ $cat->id }}, '{{ addslashes($cat->name) }}')"
                                    class="btn btn-sm btn-circle btn-ghost text-warning hover:bg-warning hover:text-warning-content transition-colors duration-200" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>

                                {{-- Hapus --}}
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua data yang terkait mungkin terpengaruh.')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-circle btn-ghost text-error hover:bg-error hover:text-error-content transition-colors duration-200" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10">
                            <div class="flex flex-col items-center justify-center text-base-content/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <p class="text-lg font-medium">Belum ada data kategori</p>
                                <p class="text-sm">Tambahkan kategori buku baru untuk mulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($categories, 'hasPages') && $categories->hasPages())
        <div class="p-4 border-t border-base-200">
            {{ $categories->links() }}
        </div>
        @elseif($categories instanceof \Illuminate\Pagination\LengthAwarePaginator && $categories->hasPages())
        <div class="p-4 border-t border-base-200">
            {{ $categories->links() }}
        </div>
        @elseif(isset($categories) && method_exists($categories, 'links') && trim($categories->links()) != '')
        <div class="p-4 border-t border-base-200">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Modal Tambah --}}
<div id="modal-add" class="hidden fixed inset-0 bg-base-300/60 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
    <div class="bg-base-100 rounded-3xl p-6 md:p-8 w-full max-w-md shadow-2xl scale-100 animate-in fade-in zoom-in-95">
        <h3 class="text-xl font-bold mb-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </h3>
        <p class="text-sm text-base-content/70 mb-6">Masukkan nama kategori buku yang baru.</p>
        
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-control w-full mb-6">
                <label class="label">
                    <span class="label-text font-semibold">Nama Kategori</span>
                </label>
                <input name="name" class="input input-bordered w-full rounded-2xl focus:input-primary transition-colors" placeholder="Contoh: Fiksi, Sains, Sejarah..." required>
            </div>
            
            <div class="flex gap-3 justify-end mt-4">
                <button type="button"
                    onclick="document.getElementById('modal-add').classList.add('hidden')"
                    class="btn btn-ghost rounded-xl">Batal</button>
                <button class="btn btn-primary rounded-xl px-8 shadow-primary/30 shadow-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="modal-edit" class="hidden fixed inset-0 bg-base-300/60 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
    <div class="bg-base-100 rounded-3xl p-6 md:p-8 w-full max-w-md shadow-2xl scale-100 animate-in fade-in zoom-in-95">
        <h3 class="text-xl font-bold mb-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit Kategori
        </h3>
        <p class="text-sm text-base-content/70 mb-6">Perbarui nama kategori yang dipilih.</p>
        
        <form id="form-edit" method="POST">
            @csrf @method('PUT')
            <div class="form-control w-full mb-6">
                <label class="label">
                    <span class="label-text font-semibold">Nama Kategori</span>
                </label>
                <input id="edit-name" name="name" class="input input-bordered w-full rounded-2xl focus:input-warning transition-colors" required>
            </div>
            
            <div class="flex gap-3 justify-end mt-4">
                <button type="button"
                    onclick="document.getElementById('modal-edit').classList.add('hidden')"
                    class="btn btn-ghost rounded-xl">Batal</button>
                <button class="btn btn-warning rounded-xl px-8 shadow-warning/30 shadow-lg">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEdit(id, name) {
    document.getElementById('form-edit').action = `/admin/categories/${id}`;
    document.getElementById('edit-name').value = name;
    document.getElementById('modal-edit').classList.remove('hidden');
}

// Close modals when clicking outside
window.onclick = function(event) {
    const modalAdd = document.getElementById('modal-add');
    const modalEdit = document.getElementById('modal-edit');
    if (event.target == modalAdd) {
        modalAdd.classList.add('hidden');
    }
    if (event.target == modalEdit) {
        modalEdit.classList.add('hidden');
    }
}
</script>
</x-app-layout>
