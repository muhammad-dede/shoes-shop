<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tittle</title>
    <style>
        table,
        td,
        th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div style="text-align: center">
        <h1>Laporan Pesanan</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 1%;">No.</th>
                <th>{{ __('No. Pesanan') }}</th>
                <th>{{ __('Subtotal') }}</th>
                <th>{{ __('Diskon') }}</th>
                <th>{{ __('Total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->no_order }}</td>
                    <td>{{ number_format($item->total_price, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->discount_amount, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->payment_amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
