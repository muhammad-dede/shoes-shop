<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @hasSection('title')
        <title>@yield('title')&nbsp;-&nbsp;{{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>No.</th>
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
                    <td>{{ number_format($item->total_price, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->discount_amount, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->payment_amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
