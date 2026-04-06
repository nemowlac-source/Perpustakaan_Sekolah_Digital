<x-app-layout>
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Manajemen Kategori</h2>
        <button onclick="document.getElementById('modal-add').classList.remove('hidden')"
            class="btn btn-primary btn-sm">+ Tambah Kategori</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr><th>#</th><th>Nama Kategori</th><th>Jumlah Buku</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->books_count }}</td>
                    <td class="flex gap-2">
                        {{-- Edit (inline modal) --}}
                        <button onclick="openEdit({{ $cat->id }}, '{{ $cat->name }}')"
                            class="btn btn-xs btn-warning">Edit</button>

                        {{-- Hapus --}}
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                            onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-error">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $categories->links() }}
</div>

{{-- Modal Tambah --}}
<div id="modal-add" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-base-100 rounded-xl p-6 w-80">
        <h3 class="font-semibold mb-4">Tambah Kategori</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <input name="name" class="input input-bordered w-full mb-4" placeholder="Nama kategori" required>
            <div class="flex gap-2 justify-end">
                <button type="button"
                    onclick="document.getElementById('modal-add').classList.add('hidden')"
                    class="btn btn-ghost btn-sm">Batal</button>
                <button class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="modal-edit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-base-100 rounded-xl p-6 w-80">
        <h3 class="font-semibold mb-4">Edit Kategori</h3>
        <form id="form-edit" method="POST">
            @csrf @method('PUT')
            <input id="edit-name" name="name" class="input input-bordered w-full mb-4" required>
            <div class="flex gap-2 justify-end">
                <button type="button"
                    onclick="document.getElementById('modal-edit').classList.add('hidden')"
                    class="btn btn-ghost btn-sm">Batal</button>
                <button class="btn btn-warning btn-sm">Update</button>
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
</script>
</x-app-layout>
