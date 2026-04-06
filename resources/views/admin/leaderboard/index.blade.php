<x-app-layout>
<div class="p-6 space-y-6">

    <h2 class="text-xl font-semibold">🏆 Leaderboard Siswa</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Podium Top 3 --}}
    @if($top3->count() >= 1)
    <div class="flex items-end justify-center gap-4 py-6">

        {{-- Rank 2 --}}
        @if($top3->count() >= 2)
        <div class="flex flex-col items-center gap-2">
            <div class="avatar placeholder">
                <div class="bg-base-300 text-base-content rounded-full w-14">
                    <span>{{ strtoupper(substr($top3[1]->name, 0, 2)) }}</span>
                </div>
            </div>
            <p class="font-medium text-sm text-center">{{ $top3[1]->name }}</p>
            <p class="text-warning font-bold">{{ $top3[1]->points }} poin</p>
            <div class="bg-base-300 w-20 h-16 rounded-t-lg flex items-center justify-center text-2xl">🥈</div>
        </div>
        @endif

        {{-- Rank 1 --}}
        <div class="flex flex-col items-center gap-2">
            <div class="avatar placeholder">
                <div class="bg-warning text-warning-content rounded-full w-16 ring ring-warning ring-offset-2">
                    <span class="text-lg">{{ strtoupper(substr($top3[0]->name, 0, 2)) }}</span>
                </div>
            </div>
            <p class="font-semibold text-sm text-center">{{ $top3[0]->name }}</p>
            <p class="text-warning font-bold text-lg">{{ $top3[0]->points }} poin</p>
            <div class="bg-warning w-20 h-24 rounded-t-lg flex items-center justify-center text-2xl">🥇</div>
        </div>

        {{-- Rank 3 --}}
        @if($top3->count() >= 3)
        <div class="flex flex-col items-center gap-2">
            <div class="avatar placeholder">
                <div class="bg-base-300 text-base-content rounded-full w-14">
                    <span>{{ strtoupper(substr($top3[2]->name, 0, 2)) }}</span>
                </div>
            </div>
            <p class="font-medium text-sm text-center">{{ $top3[2]->name }}</p>
            <p class="text-warning font-bold">{{ $top3[2]->points }} poin</p>
            <div class="bg-base-300 w-20 h-12 rounded-t-lg flex items-center justify-center text-2xl">🥉</div>
        </div>
        @endif

    </div>
    @endif

    {{-- Tabel Lengkap --}}
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Siswa</th>
                    <th>Level</th>
                    <th>Poin</th>
                    <th>Total Pinjam</th>
                    <th>Tepat Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswas as $i => $siswa)
                @php $level = $siswa->getLevel(); @endphp
                <tr class="{{ $i < 3 ? 'bg-warning/5' : '' }}">
                    <td>
                        <span class="font-bold text-lg">
                            @if($i === 0) 🥇
                            @elseif($i === 1) 🥈
                            @elseif($i === 2) 🥉
                            @else {{ $i + 1 }}
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar placeholder">
                                <div class="bg-neutral text-neutral-content rounded-full w-8">
                                    <span class="text-xs">{{ strtoupper(substr($siswa->name, 0, 2)) }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="font-medium">{{ $siswa->name }}</p>
                                <p class="text-xs text-base-content/50">{{ $siswa->nis }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $level['color'] }} badge-sm gap-1">
                            {{ $level['icon'] }} {{ $level['name'] }}
                        </span>
                    </td>
                    <td>
                        <span class="font-bold text-warning">{{ $siswa->points }}</span>
                    </td>
                    <td>{{ $siswa->loans_count }}</td>
                    <td>
                        <span class="text-success font-medium">{{ $siswa->tepat_waktu_count }}</span>
                        <span class="text-base-content/40 text-xs"> kali</span>
                    </td>
                    <td>
                        {{-- Adjust Poin Manual --}}
                        <button onclick="openAdjust({{ $siswa->id }}, '{{ $siswa->name }}')"
                            class="btn btn-xs btn-ghost">Atur Poin</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $siswas->links() }}

    {{-- Info Sistem Poin --}}
    <div class="bg-base-200 rounded-xl p-4 text-sm space-y-1">
        <p class="font-semibold mb-2">📋 Cara Mendapat Poin</p>
        <p>📖 Meminjam buku → <strong>+2 poin</strong></p>
        <p>✅ Mengembalikan tepat waktu → <strong>+10 poin</strong></p>
        <p>💡 Request buku disetujui → <strong>+5 poin</strong></p>
        <p class="font-semibold mt-3 mb-1">🎖️ Level</p>
        <div class="flex flex-wrap gap-2">
            <span class="badge badge-ghost">📚 Pemula (0–49)</span>
            <span class="badge badge-accent">🥉 Bronze (50–99)</span>
            <span class="badge badge-secondary">🥈 Silver (100–199)</span>
            <span class="badge badge-warning">🥇 Gold (200–499)</span>
            <span class="badge badge-primary">💎 Platinum (500+)</span>
        </div>
    </div>

</div>

{{-- Modal Adjust Poin --}}
<div id="modal-adjust" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-base-100 rounded-xl p-6 w-80">
        <h3 class="font-semibold mb-1">Atur Poin</h3>
        <p id="adjust-name" class="text-sm text-base-content/60 mb-4"></p>
        <form id="form-adjust" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="label"><span class="label-text">Jumlah Poin</span></label>
                <input name="amount" type="number" min="-1000" max="1000"
                    class="input input-bordered w-full"
                    placeholder="+ tambah / - kurangi" required>
                <p class="text-xs text-base-content/50 mt-1">Contoh: 10 atau -5</p>
            </div>
            <div>
                <label class="label"><span class="label-text">Alasan</span></label>
                <input name="reason" class="input input-bordered w-full"
                    placeholder="Contoh: Bonus lomba baca" required>
            </div>
            <div class="flex gap-2 justify-end pt-1">
                <button type="button"
                    onclick="document.getElementById('modal-adjust').classList.add('hidden')"
                    class="btn btn-ghost btn-sm">Batal</button>
                <button class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAdjust(id, name) {
    document.getElementById('form-adjust').action = `/admin/siswa/${id}/points`;
    document.getElementById('adjust-name').textContent = name;
    document.getElementById('modal-adjust').classList.remove('hidden');
}
</script>
</x-app-layout>
