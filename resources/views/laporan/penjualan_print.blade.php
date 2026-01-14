<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
        }

        h3 {
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }

        th {
            text-align: center;
            background: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-border {
            border: none;
        }

        .item-table th,
        .item-table td {
            border: 1px solid #000;
            padding: 3px;
            font-size: 11px;
        }
    </style>
</head>

<body onload="window.print()">

<div class="header">
    <h3>LAPORAN PENJUALAN</h3>
    <small>Tanggal Cetak: {{ date('d-m-Y') }}</small>
</div>

<p>
    <strong>Total Pendapatan:</strong>
    Rp {{ number_format($totalPendapatan,0,',','.') }}
</p>

<table>
    <thead>
        <tr>
            <th width="30">No</th>
            <th width="130">No Bukti</th>
            <th width="120">Pelanggan</th>
            <th width="80">Tanggal</th>
            <th>Detail Item</th>
            <th width="90">Total</th>
        </tr>
    </thead>
    <tbody>

    @foreach ($penjualan as $no => $p)
        <tr>
            <td class="text-center">{{ $no + 1 }}</td>
            <td>{{ $p->nota }}</td>
            <td>{{ $p->pelanggan->nama ?? '-' }}</td>
            <td class="text-center">{{ $p->tanggal }}</td>
            <td>

                {{-- TABEL DETAIL ITEM --}}
                <table class="item-table" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th width="40">Qty</th>
                            <th width="70">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($p->detail as $d)
                        <tr>
                            <td>{{ $d->part->nama ?? '-' }}</td>
                            <td class="text-center">{{ $d->qty }}</td>
                            <td class="text-right">
                                {{ number_format($d->harga,0,',','.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </td>
            <td class="text-right">
                Rp {{ number_format($p->detail->sum('subtotal'),0,',','.') }}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

</body>
</html>
