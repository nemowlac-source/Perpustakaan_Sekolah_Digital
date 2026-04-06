<x-app-layout>
<div class="p-6 space-y-6">

    <h2 class="text-xl font-semibold">🏆 Leaderboard</h2>

    {{-- Posisi Saya --}}
    @php $myLevel = auth()->user()->getLevel(); @endphp
    <div class="bg-base-200 rounded-xl p-4 flex items-center gap-4">
        <div class="text-4xl">{{ $myLevel['icon'] }}</div>
        <div class="flex-1">
            <p class="text-sm text-base-content/60">Posisi kamu</p>
            <p class="text-2xl font-bold">#{{ $myRank }}</p>
        </div>
        <div class="text-right">
            <span class="badge {{ $myLevel['color'] }}">{{ $myLevel['name'] }}</span>
            <p class="text-2xl font-bold text-warning mt-1">{{ auth()->user()->points }}</p>
            <p class="text-xs text-base-content/50">poin</p>
        </div>
    </div>

    {{-- Podium Top 3 --}}
    @if($top3->count() >= 1)
    <div class="flex items-end justify-center gap-4 py-4">

        @if($top3->count() >= 2)
        <div class="flex flex-col items-center gap-2">
            <div class="avatar placeholder">
                <div class="bg-base-300 rounded-full w-12
                    {{ auth()->id() === $top3[1]->id ? 'ring ring-primary ring-offset-1' : '' }}">
                    <span class="text-sm">{{ strtoupper(substr($top3[1]->name, 0, 2)) }}</span>
                </div>
            </div>
            <p class="text-xs text-center font-medium">{{ $top3[1]->name }}</p>
            <p class="text-warning text-sm font-bold">{{ $top3[1]->points }}</p>
            <div class="bg-base-300 w-16 h-14 rounded-t-lg flex items-center justify-center">🥈</div>
        </div>
        @endif

        <div class="flex flex-col items-center gap-2">
            <div class="avatar placeholder">
                <div class="bg-warning text-warning-content rounded-full w-16
                    ring ring-warning ring-offset-2
                    {{ auth()->id() === $top3[0]->id ? 'ring-primary' : '' }}">
                    <span>{{ strtoupper(substr($top3[0]->name, 0, 2)) }}</span>
                </div>
            </div>
            <p class="text-sm text-center font-semibold">{{ $top3[0]->name }}</p>
            <p class="text-warning font-bold">{{ $top3[0]->points }}</p>
            <div class="bg-warning w-16 h-20 rounded-t-lg flex items-center justify-center">🥇</div>
        </div>

        @if($top3->count() >= 3)
        <div class="flex flex-col items-center gap-2">
            <div class="avatar placeholder">
                <div class="bg-base-300 rounded-full w-12
                    {{ auth()->id() === $top3[2]->id ? 'ring ring-primary ring-offset-1' : '' }}">
                    <span class="text-sm">{{ strtoupper(substr($top3[2]->name, 0, 2)) }}</span>
                </div>
            </div>
            <p class="text-xs text-center font-medium">{{ $top3[2]->name }}</p>
            <p class="text-warning text-sm font-bold">{{ $top3[2]->points }}</p>
            <div class="bg-base-300 w-16 h-10 rounded-t-lg flex items-center justify-center">🥉</div>
        </div>
        @endif

    </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr><th>Rank</th><th>Siswa</th><th>Level</th><th>Poin</th><th>Tepat Waktu</th></tr>
            </thead>
            <tbody>
                @foreach($siswas as $i => $siswa)
                @php $level = $siswa->getLevel(); @endphp
                <tr class="{{ auth()->id() === $siswa->id ? 'bg-primary/10 font-semibold' : '' }}">
                    <td>
                        @if($i === 0) 🥇
                        @elseif($i === 1) 🥈
                        @elseif($i === 2) 🥉
                        @else <span class="text-base-content/50">{{ $i + 1 }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar placeholder">
                                <div class="bg-neutral text-neutral-content rounded-full w-8">
                                    <span class="text-xs">{{ strtoupper(substr($siswa->name, 0, 2)) }}</span>
                                </div>
                            </div>
                            <span>{{ $siswa->name }}
                                @if(auth()->id() === $siswa->id)
                                    <span class="badge badge-primary badge-xs ml-1">Kamu</span>
                                @endif
                            </span>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $level['color'] }} badge-sm">
                            {{ $level['icon'] }} {{ $level['name'] }}
                        </span>
                    </td>
                    <td><span class="font-bold text-warning">{{ $siswa->points }}</span></td>
                    <td><span class="text-success">{{ $siswa->tepat_waktu_count }}x</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $siswas->links() }}

    {{-- Cara Dapat Poin --}}
    <div class="bg-base-200 rounded-xl p-4 text-sm space-y-1">
        <p class="font-semibold mb-2">💡 Cara Mendapat Poin</p>
        <p>📖 Meminjam buku → <strong>+2 poin</strong></p>
        <p>✅ Mengembalikan tepat waktu → <strong>+10 poin</strong></p>
        <p>💡 Request buku disetujui → <strong>+5 poin</strong></p>
    </div>

</div>
</x-app-layout>
