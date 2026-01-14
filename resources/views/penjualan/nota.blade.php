<!DOCTYPE html>
<html>
<head>
    <title>Nota Penjualan</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, sans-serif;
            font-size: 13px;
            background: #f5f5f5;
            padding: 20px;
        }

        .nota-wrapper {
            width: 700px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .sub-title {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
            color: #777;
        }

        .info { margin-bottom: 15px; line-height: 1.6; }
        .info strong { width: 120px; display: inline-block; }

        table { width: 100%; border-collapse: collapse; margin-top: 12px; font-size: 13px; }

        thead { background: #007bff; color: #fff; }

        th, td { padding: 8px; border: 1px solid #ddd; }

        tbody tr:nth-child(even) { background: #f9f9f9; }

        .total { text-align: right; margin-top: 15px; font-size: 16px; font-weight: bold; }

        .footer { margin-top: 35px; text-align: center; font-size: 12px; color: #777; }

        @media print {
            body { background: white; }
            .nota-wrapper { box-shadow: none; }
        }
    </style>
</head>
<body>

<div class="nota-wrapper">

    <h2>NOTA TRANSAKSI</h2>
    <div class="sub-title">Bengkel Resmi – Layanan Terpercaya</div>

    <div class="info">
        <p><strong>No Nota</strong>: {{ $transaksi->nota }}</p>
        <p><strong>Tanggal</strong>: {{ $transaksi->tanggal }}</p>
        <p><strong>Pelanggan</strong>: {{ $transaksi->pelanggan->nama }}</p>
        <p><strong>Mekanik</strong>: {{ $transaksi->mekanik->namamk }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Part</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @php $grandtotal = 0; @endphp

            @foreach($transaksi->detail as $d)
            @php $grandtotal += $d->subtotal; @endphp

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->part->nama }}</td>
                <td>{{ $d->qty }}</td>
                <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Pembayaran: Rp {{ number_format($grandtotal, 0, ',', '.') }}
    </div>

    <div class="footer">
        Terima kasih telah melakukan servis di bengkel kami.<br>
        Semoga Anda puas dengan layanan kami.
    </div>

</div>

</body>
</html>
