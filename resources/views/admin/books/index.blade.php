<x-app-layout>
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Manajemen Buku</h2>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm">+ Tambah Buku</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    {{-- Search --}}
    <form method="GET" class="mb-4 flex gap-2">
        <input name="q" value="{{ request('q') }}" placeholder="Cari judul / penulis / ISBN..."
            class="input input-bordered flex-1">
        <button class="btn btn-ghost">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>#</th><th>Cover</th><th>Judul</th><th>Penulis</th>
                    <th>ISBN</th><th>Kategori</th><th>Stok</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($book->cover)
                            <img src="{{ Storage::url($book->cover) }}" class="w-10 h-14 object-cover rounded">
                        @else
                            <div class="w-10 h-14 bg-base-300 rounded flex items-center justify-center text-xs">N/A</div>
                        @endif
                    </td>
                    <td class="font-medium">{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td class="font-mono text-sm">{{ $book->isbn }}</td>
                    <td><span class="badge badge-ghost">{{ $book->category->name }}</span></td>
                    <td>
                        <span class="badge {{ $book->stock > 0 ? 'badge-success' : 'badge-error' }}">
                            {{ $book->stock }}
                        </span>
                    </td>
                    <td class="flex gap-1">
                        <a href="{{ route('admin.books.show', $book) }}" class="btn btn-xs btn-info">Detail</a>
                        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-xs btn-warning">Edit</a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST"
                            onsubmit="return confirm('Hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-error">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $books->links() }}
</div>
</x-app-layout>
