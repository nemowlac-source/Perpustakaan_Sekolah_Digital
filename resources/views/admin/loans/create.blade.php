<x-app-layout>
<div class="p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-semibold mb-6">Catat Peminjaman Baru</h2>

    @if(session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.loans.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="label"><span class="label-text">Siswa</span></label>
            <select name="user_id" class="select select-bordered w-full" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}" {{ old('user_id') == $siswa->id ? 'selected' : '' }}>
                        {{ $siswa->name }} — {{ $siswa->nis }}
                    </option>
                @endforeach
            </select>
            @error('user_id')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">Buku (stok tersedia)</span></label>
            <select name="book_id" class="select select-bordered w-full" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }} (stok: {{ $book->stock }})
                    </option>
                @endforeach
            </select>
            @error('book_id')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">Jatuh Tempo</span></label>
            <input type="date" name="due_date"
                value="{{ old('due_date', now()->addDays(7)->format('Y-m-d')) }}"
                min="{{ now()->addDay()->format('Y-m-d') }}"
                class="input input-bordered w-full" required>
            @error('due_date')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="bg-base-200 rounded-lg p-3 text-sm text-base-content/70">
            💡 Denda keterlambatan: <strong>Rp 1.000 / hari</strong><br>
            🏆 Pengembalian tepat waktu mendapat: <strong>+10 poin</strong>
        </div>

        <div class="flex gap-2 justify-end pt-2">
            <a href="{{ route('admin.loans.index') }}" class="btn btn-ghost">Batal</a>
            <button class="btn btn-primary">Catat Peminjaman</button>
        </div>
    </form>
</div>
</x-app-layout>
