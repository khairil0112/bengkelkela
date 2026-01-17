<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Pembelian</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        h3 {
            margin-bottom: 5px;
        }
        hr {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .no-border td {
            border: none;
            padding: 3px;
        }
    </style>
</head>
<body onload="window.print()">

    <h3 align="center">LAPORAN PEMBELIAN</h3>
    <hr>

    <table class="no-border">
        <tr>
            <td width="150">Kode Pembelian</td>
            <td>: {{ $pembelian->kode_pembelian }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ $pembelian->tanggal_pembelian }}</td>
        </tr>
        <tr>
            <td>Pemasok</td>
            <td>: {{ $pembelian->pemasok->nama }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>: {{ $pembelian->keterangan ?? '-' }}</td>
        </tr>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Nama Part / Jasa</th>
                <th width="60">Qty</th>
                <th width="120">Harga</th>
                <th width="120">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelian->details as $no => $detail)
                <tr>
                    <td align="center">{{ $no + 1 }}</td>
                    <td>{{ $detail->part->nama }}</td>
                    <td align="center">{{ $detail->qty }}</td>
                    <td class="text-right">
                        {{ number_format($detail->harga, 0, ',', '.') }}
                    </td>
                    <td class="text-right">
                        {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">TOTAL</th>
                <th class="text-right">
                    {{ number_format($pembelian->grand_total, 0, ',', '.') }}
                </th>
            </tr>
        </tfoot>
    </table>

    <br><br>

    <table class="no-border" width="100%">
        <tr>
            <td width="70%"></td>
            <td align="center">
                <p>{{ date('d-m-Y') }}</p>
                <p>Mengetahui,</p>
                <br><br>
                <p><b>_____________________</b></p>
            </td>
        </tr>
    </table>

</body>
</html>
