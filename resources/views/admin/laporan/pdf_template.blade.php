<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #999; }
        th { background-color: #f2f2f2; padding: 10px; text-align: left; }
        td { padding: 8px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .footer { margin-top: 40px; }
        .signature { float: right; width: 200px; text-align: center; }
        .empty-state { padding: 20px; text-align: center; color: #999; font-style: italic; }
        .total-row { background-color: #eee; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Peminjaman Buku Perpustakaan</h2>
        <p>Periode: <strong>{{ $range }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Nama Siswa</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $totalDenda = 0; @endphp

            @forelse($loans as $index => $loan)
                @php $totalDenda += $loan->fine; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d/m/Y') }}</td>
                    <td>{{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') : '-' }}</td>
                    <td class="text-center">{{ ucfirst($loan->status) }}</td>
                    <td class="text-right">{{ number_format($loan->fine, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        Tidak ada data peminjaman pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>

        @if($loans->isNotEmpty())
        <tfoot>
            <tr class="total-row">
                <td colspan="6" class="text-right">TOTAL DENDA TERKUMPUL</td>
                <td class="text-right">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        <div class="signature">
            <p>Dicetak pada: {{ $date }}</p>
            <p>Petugas Perpustakaan,</p>
            <br><br><br>
            <p class="font-bold">( {{ Auth::user()->name }} )</p>
        </div>
    </div>
</body>
</html>
