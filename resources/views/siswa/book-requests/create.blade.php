<x-app-layout>
<div class="p-6 max-w-lg mx-auto">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('siswa.book-requests.index') }}" class="btn btn-ghost btn-sm">← Kembali</a>
        <h2 class="text-xl font-semibold">Ajukan Request Buku</h2>
    </div>

    @if(session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('siswa.book-requests.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="label"><span class="label-text">Judul Buku <span class="text-error">*</span></span></label>
            <input name="book_title" value="{{ old('book_title') }}"
                class="input input-bordered w-full @error('book_title') input-error @enderror"
                placeholder="Masukkan judul buku yang ingin diajukan" required>
            @error('book_title')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label"><span class="label-text">Penulis / Pengarang</span></label>
            <input name="author" value="{{ old('author') }}"
                class="input input-bordered w-full"
                placeholder="Opsional — isi jika tahu">
        </div>

        <div>
            <label class="label">
                <span class="label-text">Alasan Pengajuan <span class="text-error">*</span></span>
                <span class="label-text-alt text-base-content/50">Maks. 500 karakter</span>
            </label>
            <textarea name="reason" rows="4"
                class="textarea textarea-bordered w-full @error('reason') textarea-error @enderror"
                placeholder="Jelaskan mengapa buku ini perlu diadakan oleh perpustakaan..."
                maxlength="500" required>{{ old('reason') }}</textarea>
            @error('reason')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="bg-base-200 rounded-lg p-3 text-sm text-base-content/70 space-y-1">
            <p>💡 <strong>Tips request yang cepat disetujui:</strong></p>
            <p>• Jelaskan manfaat buku untuk pelajaran atau pengembangan diri</p>
            <p>• Sertakan nama penulis jika memungkinkan</p>
            <p>• Maksimal 3 request pending dalam satu waktu</p>
            <p>🏆 Request disetujui → kamu dapat <strong>+5 poin!</strong></p>
        </div>

        <div class="flex gap-2 justify-end pt-2">
            <a href="{{ route('siswa.book-requests.index') }}" class="btn btn-ghost">Batal</a>
            <button class="btn btn-primary">Kirim Request</button>
        </div>
    </form>
</div>
</x-app-layout>
