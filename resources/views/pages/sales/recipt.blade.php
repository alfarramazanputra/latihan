<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $saleData['sale_id'] }}</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background: #f0f0f0;
        }

        .info p {
            margin: 2px 0;
            font-size: 14px;
        }

        .notes, address {
            margin-top: 20px;
            font-size: 13px;
        }

        hr {
            margin: 30px 0 10px;
        }
    </style>
</head>

<body>
    <h1>Invoice #{{ $saleData['sale_id'] }}</h1>

    <div class="info">
        @if ($saleData['member_id'])
            <p>Member: {{ $saleData['member_name'] }}</p>
            <p>No. HP: {{ $saleData['member_phone'] }}</p>
            <p>Bergabung: {{ $saleData['member_date'] }}</p>
            <p>Poin: {{ $saleData['member_point'] }}</p>
        @else
            <p>Member: Bukan Member</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($saleData['products'] as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Poin Digunakan</th>
                <td>{{ $saleData['point_used'] }}</td>
            </tr>
            <tr>
                <th colspan="3">Tunai</th>
                <td>Rp {{ number_format($saleData['amount_paid'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th colspan="3">Kembalian</th>
                <td>Rp {{ number_format($saleData['change'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th colspan="3">Total</th>
                <td>Rp {{ number_format($saleData['total'], 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="notes">Terima kasih atas pembelian Anda.</div>

    <hr>

    <address>
        rjmNms<br>
        Jl. Raya Cisarua<br>
        Email: rjmnms@gmail.com
    </address>
</body>

</html>