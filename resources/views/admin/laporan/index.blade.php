<x-app-layout>
<div class="p-6 max-w-2xl mx-auto">
    <div class="card bg-base-100 shadow-xl border border-base-300">
        <div class="card-body">
            <h2 class="card-title mb-4">Cetak Laporan Peminjaman</h2>
            <form action="{{ route('admin.laporan.pdf') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" class="input input-bordered" required>
                    </div>
                    <div class="form-control">
                        <label class="label">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" class="input input-bordered" required>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary w-full">
                        📥 Download PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
