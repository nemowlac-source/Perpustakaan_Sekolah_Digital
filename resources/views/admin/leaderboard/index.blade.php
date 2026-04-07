<x-app-layout>
    <div class="w-full space-y-6 min-w-0">
        
        <!-- Header Desk -->
        <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl p-6 md:p-8 text-primary-content shadow-lg shadow-orange-500/20 relative overflow-hidden flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 rounded-full border-4 border-white/10 opacity-50 pointer-events-none"></div>
            <div class="absolute top-1/2 right-4 w-16 h-16 bg-white/20 rounded-full blur-xl transform -translate-y-1/2 pointer-events-none"></div>

            <div class="relative z-10 flex items-center gap-5 w-full sm:w-auto">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-inner border border-white/30 shrink-0">
                    <span class="text-3xl filter drop-shadow-md">🏆</span>
                </div>
                <div class="min-w-0">
                    <h2 class="text-2xl sm:text-3xl font-black mb-1 truncate text-white drop-shadow-sm">Leaderboard Siswa</h2>
                    <p class="text-white/80 font-medium text-sm truncate">Peringkat poin membaca dan aktivitas sirkulasi</p>
                </div>
            </div>
            
            <div class="relative z-10 shrink-0 bg-white/10 backdrop-blur-md rounded-2xl p-3 border border-white/20 shadow-inner flex items-center gap-4">
                <div class="text-right">
                    <p class="text-xs font-bold text-white/70 uppercase">Total Partisipan</p>
                    <p class="text-xl font-black text-white">{{ $siswas->total() }} Siswa</p>
                </div>
            </div>
        </div>

        {{-- Podium Top 3 --}}
        @if($top3->count() >= 1)
        <div class="bg-base-100 rounded-3xl border border-base-200 shadow-sm p-6 sm:p-10 relative overflow-hidden">
            <!-- Decorative BG for Podium -->
            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-base-200 to-transparent pointer-events-none rounded-b-3xl"></div>
            
            <div class="flex items-end justify-center gap-2 sm:gap-6 relative z-10 min-h-[220px]">
                {{-- Rank 2 (Silver) --}}
                @if($top3->count() >= 2)
                <div class="flex flex-col items-center group w-24 sm:w-32 animate-fade-in" style="animation-delay: 0.1s">
                    <div class="relative mb-3 group-hover:-translate-y-2 transition-transform duration-300">
                        <div class="absolute -top-3 -right-3 text-2xl z-20 drop-shadow-sm">🥈</div>
                        <div class="avatar placeholder">
                            <div class="bg-gradient-to-br from-slate-200 to-slate-400 text-slate-800 rounded-full w-14 sm:w-16 ring-4 ring-slate-200 ring-offset-base-100 ring-offset-2 shadow-lg">
                                <span class="text-lg font-black">{{ strtoupper(substr($top3[1]->name, 0, 2)) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-b from-slate-200 to-slate-300 w-full pt-4 pb-2 px-2 rounded-t-xl sm:rounded-t-2xl flex flex-col items-center justify-center shadow-inner border border-slate-300 relative">
                        <p class="font-bold text-[10px] sm:text-xs text-center text-slate-700 line-clamp-1 w-full">{{ $top3[1]->name }}</p>
                        <p class="text-slate-800 font-black text-sm mt-0.5">{{ $top3[1]->points }}<span class="text-[9px] font-bold opacity-70 ml-0.5">PTS</span></p>
                        <div class="h-16 sm:h-20"></div>
                    </div>
                </div>
                @endif

                {{-- Rank 1 (Gold) --}}
                <div class="flex flex-col items-center group w-28 sm:w-36 -mx-1 sm:-mx-2 z-10 animate-fade-in">
                    <div class="relative mb-3 group-hover:-translate-y-2 transition-transform duration-300">
                        <div class="absolute -top-4 -right-4 text-4xl z-20 drop-shadow-lg animate-bounce" style="animation-duration: 2s">👑</div>
                        <div class="avatar placeholder">
                            <div class="bg-gradient-to-br from-yellow-300 to-amber-500 text-amber-900 rounded-full w-16 sm:w-20 ring-4 ring-amber-300 ring-offset-base-100 ring-offset-2 shadow-xl">
                                <span class="text-xl sm:text-2xl font-black">{{ strtoupper(substr($top3[0]->name, 0, 2)) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-b from-amber-300 to-yellow-500 w-full pt-5 pb-2 px-2 rounded-t-2xl sm:rounded-t-3xl flex flex-col items-center justify-center shadow-inner border border-amber-400 relative">
                        <p class="font-black text-[11px] sm:text-sm text-center text-amber-900 line-clamp-1 w-full">{{ $top3[0]->name }}</p>
                        <p class="text-amber-950 font-black text-base sm:text-lg mt-0.5">{{ $top3[0]->points }}<span class="text-[10px] font-bold opacity-70 ml-1">PTS</span></p>
                        <div class="h-20 sm:h-28"></div>
                    </div>
                </div>

                {{-- Rank 3 (Bronze) --}}
                @if($top3->count() >= 3)
                <div class="flex flex-col items-center group w-24 sm:w-32 animate-fade-in" style="animation-delay: 0.2s">
                    <div class="relative mb-3 group-hover:-translate-y-2 transition-transform duration-300">
                        <div class="absolute -top-3 -right-3 text-2xl z-20 drop-shadow-sm">🥉</div>
                        <div class="avatar placeholder">
                            <div class="bg-gradient-to-br from-orange-300 to-amber-700 text-orange-100 rounded-full w-14 sm:w-16 ring-4 ring-orange-300 ring-offset-base-100 ring-offset-2 shadow-lg">
                                <span class="text-lg font-black">{{ strtoupper(substr($top3[2]->name, 0, 2)) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-b from-orange-200 to-orange-300 w-full pt-4 pb-2 px-2 rounded-t-xl sm:rounded-t-2xl flex flex-col items-center justify-center shadow-inner border border-orange-300 relative">
                        <p class="font-bold text-[10px] sm:text-xs text-center text-orange-950 line-clamp-1 w-full">{{ $top3[2]->name }}</p>
                        <p class="text-orange-950 font-black text-sm mt-0.5">{{ $top3[2]->points }}<span class="text-[9px] font-bold opacity-70 ml-0.5">PTS</span></p>
                        <div class="h-12 sm:h-16"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Tabel Lengkap (Kiri / 2 Kolom) --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-base-100 rounded-2xl border border-base-200 shadow-sm overflow-hidden flex flex-col h-full">
                    <div class="px-6 py-5 border-b border-base-200 flex items-center gap-3 bg-base-100/50">
                        <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                        <h3 class="font-bold text-lg text-base-content">Klasemen Lengkap</h3>
                    </div>

                    <div class="overflow-x-auto w-full flex-1">
                        <table class="table w-full whitespace-nowrap">
                            <thead>
                                <tr class="bg-base-200/50 text-base-content/70 border-b-2 border-base-200 text-xs uppercase tracking-wider">
                                    <th class="font-semibold text-center w-16">Rank</th>
                                    <th class="font-semibold">Informasi Siswa</th>
                                    <th class="font-semibold text-center">Poin & Level</th>
                                    <th class="font-semibold text-center">Aktivitas</th>
                                    <th class="font-semibold text-right px-6">Manajemen</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-base-200">
                                @foreach($siswas as $i => $siswa)
                                @php 
                                    $level = $siswa->getLevel();
                                    $rankInfo = ($siswas->currentPage() - 1) * $siswas->perPage() + $i + 1;
                                @endphp
                                <tr class="hover:bg-base-200/30 transition-colors {{ $rankInfo <= 3 ? 'bg-warning/5' : '' }}">
                                    <td class="text-center font-bold">
                                        @if($rankInfo === 1) <span class="text-2xl drop-shadow-sm">🥇</span>
                                        @elseif($rankInfo === 2) <span class="text-xl drop-shadow-sm">🥈</span>
                                        @elseif($rankInfo === 3) <span class="text-xl drop-shadow-sm">🥉</span>
                                        @else <span class="text-base-content/40 text-sm">#{{ $rankInfo }}</span>
                                        @endif
                                    </td>
                                    
                                    <td class="py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-base-200 text-base-content/60 rounded-full w-10 border border-base-300">
                                                    <span class="text-xs font-bold">{{ strtoupper(substr($siswa->name, 0, 2)) }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-bold text-base-content text-sm">{{ $siswa->name }}</p>
                                                <p class="text-[11px] font-semibold text-base-content/50 uppercase tracking-wider mt-0.5">NIS: {{ $siswa->nis }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="flex flex-col items-center gap-1.5">
                                            <span class="inline-flex items-center font-black text-amber-500 text-sm">
                                                {{ $siswa->points }} <span class="ml-1 text-[10px] font-bold text-amber-500/60 uppercase">Pts</span>
                                            </span>
                                            <span class="badge {{ $level['color'] }} badge-xs border-none font-bold px-2 py-2 gap-1 uppercase tracking-wider text-[10px]">
                                                {{ $level['icon'] }} {{ $level['name'] }}
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="flex items-center justify-center gap-4 text-xs font-bold">
                                            <div class="flex items-center gap-1.5 tooltip" data-tip="Total Pinjam Buku">
                                                <div class="w-6 h-6 rounded-md bg-info/10 text-info flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                                </div>
                                                <span class="text-base-content/80">{{ $siswa->loans_count }}x</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 tooltip" data-tip="Tepat Waktu Kembali">
                                                <div class="w-6 h-6 rounded-md bg-success/10 text-success flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                </div>
                                                <span class="text-base-content/80">{{ $siswa->tepat_waktu_count }}x</span>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="text-right px-6">
                                        <button onclick="openAdjust({{ $siswa->id }}, '{{ addslashes($siswa->name) }}')" class="btn btn-sm btn-outline btn-primary rounded-xl hover:-translate-y-0.5 transition-transform font-bold tooltip tooltip-left" data-tip="Sesuaikan Poin Manual">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 sm:hidden md:block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                                            <span class="hidden sm:inline">Atur Poin</span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($siswas->hasPages())
                        <div class="px-6 py-4 border-t border-base-200 bg-base-100/50">
                            {{ $siswas->links() }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar Kanan (Info Sistem Poin) --}}
            <div class="space-y-6">
                <div class="bg-gradient-to-b from-indigo-700 to-indigo-900 rounded-2xl shadow-lg p-6 text-indigo-50 relative overflow-hidden h-full">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-bl-full pointer-events-none"></div>
                    
                    <div class="flex items-center gap-3 mb-6 relative z-10">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <span class="text-xl">🌟</span>
                        </div>
                        <h3 class="font-black text-lg text-white">Sistem Poin</h3>
                    </div>

                    <div class="space-y-4 relative z-10">
                        <div class="bg-indigo-950/50 rounded-xl p-4 border border-indigo-500/30">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-300 mb-3">Pemerolehan Poin</h4>
                            <ul class="space-y-3 text-sm font-medium">
                                <li class="flex items-start gap-3">
                                    <div class="mt-0.5 w-5 h-5 rounded-md bg-info/20 text-info flex items-center justify-center shrink-0">📖</div>
                                    <div><span class="text-white">Pinjam Buku</span><br><span class="text-indigo-300 text-xs font-bold">+2 Poin / Buku</span></div>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="mt-0.5 w-5 h-5 rounded-md bg-success/20 text-success flex items-center justify-center shrink-0">✅</div>
                                    <div><span class="text-white">Tepat Waktu Kembali</span><br><span class="text-green-400 text-xs font-bold">+10 Poin Bonus</span></div>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="mt-0.5 w-5 h-5 rounded-md bg-warning/20 text-warning flex items-center justify-center shrink-0">💡</div>
                                    <div><span class="text-white">Usulan Buku Disetujui</span><br><span class="text-yellow-400 text-xs font-bold">+5 Poin / Usulan</span></div>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-indigo-950/50 rounded-xl p-4 border border-indigo-500/30">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-300 mb-3">Tingkatan (Level)</h4>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center justify-between text-sm bg-black/20 p-2 rounded-lg">
                                    <span class="flex items-center gap-2 font-bold"><span class="text-base">📚</span> Pemula</span>
                                    <span class="text-[10px] bg-white/10 px-2 py-0.5 rounded text-indigo-200">0–49 pts</span>
                                </div>
                                <div class="flex items-center justify-between text-sm bg-orange-950/40 p-2 rounded-lg border border-orange-500/20">
                                    <span class="flex items-center gap-2 font-bold text-orange-300"><span class="text-base">🥉</span> Bronze</span>
                                    <span class="text-[10px] bg-orange-500/20 px-2 py-0.5 rounded text-orange-200">50–99 pts</span>
                                </div>
                                <div class="flex items-center justify-between text-sm bg-slate-800/40 p-2 rounded-lg border border-slate-400/20">
                                    <span class="flex items-center gap-2 font-bold text-slate-300"><span class="text-base">🥈</span> Silver</span>
                                    <span class="text-[10px] bg-slate-400/20 px-2 py-0.5 rounded text-slate-200">100–199 pts</span>
                                </div>
                                <div class="flex items-center justify-between text-sm bg-amber-900/40 p-2 rounded-lg border border-amber-500/20">
                                    <span class="flex items-center gap-2 font-bold text-amber-400"><span class="text-base">🥇</span> Gold</span>
                                    <span class="text-[10px] bg-amber-500/20 px-2 py-0.5 rounded text-amber-200">200–499 pts</span>
                                </div>
                                <div class="flex items-center justify-between text-sm bg-cyan-900/40 p-2 rounded-lg border border-cyan-400/20">
                                    <span class="flex items-center gap-2 font-bold text-cyan-300"><span class="text-base">💎</span> Platinum</span>
                                    <span class="text-[10px] bg-cyan-500/20 px-2 py-0.5 rounded text-cyan-200">500+ pts</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Modal Adjust Poin (Glassmorphism) --}}
    <div id="modal-adjust" class="hidden fixed inset-0 bg-base-300/80 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 px-4">
        <div class="bg-base-100 rounded-3xl p-8 w-full max-w-sm shadow-2xl border border-white/20 transform scale-95 transition-all duration-300" id="modal-content">
            <div class="flex items-center gap-4 mb-2">
                <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-base-content">Modifikasi Poin</h3>
                    <p class="text-[10px] font-bold text-primary uppercase tracking-wider mt-0.5">Penyesuaian Manual</p>
                </div>
            </div>
            
            <div class="bg-base-200/50 p-4 rounded-2xl my-6 border border-base-200 text-center">
                <p class="text-[10px] font-semibold text-base-content/50 uppercase tracking-wider mb-1">Target Siswa</p>
                <p id="adjust-name" class="font-bold text-base-content text-sm"></p>
            </div>

            <form id="form-adjust" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="label pb-1"><span class="font-bold text-sm text-base-content">Jumlah Poin (+/-)</span></label>
                    <input name="amount" type="number" min="-1000" max="1000" class="input flex-1 h-12 bg-base-200/50 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-bold text-lg w-full" placeholder="-10 / 25" required>
                    <p class="text-[10px] font-medium text-base-content/50 mt-1.5 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Gunakan minus memotong poin
                    </p>
                </div>
                <div>
                    <label class="label pb-1"><span class="font-bold text-sm text-base-content">Alasan / Catatan</span></label>
                    <input name="reason" class="input h-12 bg-base-200/50 focus:bg-base-100 border-base-300 focus:border-primary rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-sm w-full" placeholder="Ketik alasan perubahan..." required autocomplete="off">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeAdjust()" class="btn btn-ghost bg-base-200 hover:bg-base-300 rounded-xl flex-1 font-bold">Batal</button>
                    <button class="btn btn-primary rounded-xl flex-1 font-bold shadow-md shadow-primary/20">Eksekusi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openAdjust(id, name) {
        const modal = document.getElementById('modal-adjust');
        const content = document.getElementById('modal-content');
        
        document.getElementById('form-adjust').action = `/admin/siswa/${id}/points`;
        document.getElementById('adjust-name').textContent = name;
        
        modal.classList.remove('hidden');
        // trigger render
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
        }, 10);
    }

    function closeAdjust() {
        const modal = document.getElementById('modal-adjust');
        const content = document.getElementById('modal-content');
        
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // match transition duration
    }
    </script>
</x-app-layout>
