@extends('layouts.admin.main')

@section('title', __('Detail Pesanan'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Detail') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Pesanan') }}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    @if ($order->id_status == 2)
                        <button type="button" class="btn btn-{{ getColorStatus($order->id_status) }}" data-bs-toggle="modal"
                            data-bs-target="#confirmOrderModal">
                            {{ __('Konfirmasi Pesanan') }}
                        </button>
                    @endif
                    @if ($order->id_status == 3)
                        <button type="button" class="btn btn-{{ getColorStatus($order->id_status) }}"
                            data-bs-toggle="modal" data-bs-target="#sendOrderModal">
                            {{ __('Kirim Pesanan') }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="h3">
                                {{ $order->userAddress?->first_name ?? '-' }}
                                {{ $order->userAddress?->last_name ?? '-' }}
                                - <span
                                    class="badge text-bg-{{ getColorStatus($order->id_status) }}">{{ $order->status?->name ?? '-' }}</span>
                            </p>
                            <address>
                                {{ $order->userAddress?->street_address ?? '-' }}<br>
                                {{ getCityRajaOngkir($order->userAddress?->id_city)['city_name'] ?? '-' }},
                                {{ getCityRajaOngkir($order->userAddress?->id_city)['province'] ?? '-' }}<br>
                                {{ $order->userAddress?->postal_code ?? '-' }},
                                {{ $order->userAddress?->phone ?? '-' }}<br>
                                {{ $order->user?->email ?? '-' }}
                                @if ($order->id_status == 6)
                                    <br>
                                    {{ __('Tanggal Terima') }}:
                                    {{ \Carbon\Carbon::parse($order->receipt_date ?? '-')->isoFormat('D MMMM Y') }}
                                @endif
                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <p class="h3">
                                {{ __('Pengiriman') }}
                            </p>
                            <address>
                                {{ $order->orderShipping?->courier?->name ?? '-' }}<br>
                                {{ $order->orderShipping?->description ?? '-' }}<br>
                                {{ __('Estimasi pengiriman') }}: {{ $order->orderShipping?->etd ?? '-' }}<br>
                                @if ($order->tracking_number)
                                    {{ __('Nomor Resi') }}: {{ $order->tracking_number ?? '-' }}
                                    <br>
                                @endif
                                <strong>{{ $order->orderShipping?->service ?? '-' }}</strong>
                            </address>
                        </div>
                        <div class="col-12 my-5">
                            <h1>Invoice {{ $order->no_order ?? '-' }}</h1>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>{{ __('Produk') }}</th>
                                <th class="text-center" style="width: 1%">{{ __('Qty') }}</th>
                                <th class="text-end" style="width: 1%">{{ __('Sub Total') }}</th>
                                <th class="text-end" style="width: 1%">{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        @foreach ($order->orderItem as $key => $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <p class="strong mb-1">{{ $item->product?->name ?? '-' }}</p>
                                    <div class="text-secondary">
                                        {{ $item->product?->brand?->name ?? '-' }} -
                                        {{ $item->product?->category?->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $item->qty ?? '0' }}
                                </td>
                                <td class="text-end">
                                    Rp.&nbsp;{{ number_format($item->sub_total ?? '0', 0, ',', '.') }}
                                </td>
                                <td class="text-end">
                                    Rp.&nbsp;{{ number_format($item->total ?? '0', 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="strong text-end">{{ __('Subtotal') }}</td>
                            <td class="text-end">
                                Rp.&nbsp;{{ number_format($order->total_price ?? '0', 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">{{ __('Diskon') }}</td>
                            <td class="text-end">
                                Rp.&nbsp;{{ number_format($order->discount_amount ?? '0', 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">{{ __('Biaya Pengiriman') }}</td>
                            <td class="text-end">
                                Rp.&nbsp;{{ number_format($order->shipping_cost ?? '0', 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">
                                {{ __('Total Bayar') }}
                            </td>
                            <td class="font-weight-bold text-end">
                                Rp.&nbsp;{{ number_format($order->payment_amount ?? '0', 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                    <div class="row mt-5">
                        <div class="col-6">
                            <p class="h3">
                                {{ __('Pembayaran Transfer') }}
                            </p>
                            <address>
                                {{ $order->orderPayment?->bankAccount?->account_name ?? '-' }}<br>
                                {{ $order->orderPayment?->bankAccount?->account_number ?? '-' }}<br>
                                <strong>{{ $order->orderPayment?->bankAccount?->bank_name ?? '-' }}</strong>
                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <p class="h3">
                                {{ __('Konfirmasi Pembayaran') }}
                            </p>
                            <address>
                                {{ $order->orderPayment?->account_name ?? '-' }}<br>
                                {{ $order->orderPayment?->account_number ?? '-' }}<br>
                                <strong>{{ $order->orderPayment?->bank_name ?? '-' }}</strong><br>
                                @if ($order->orderPayment?->transfer_receipt)
                                    <a href="{{ route('file.show', [
                                        'file_path' => 'order_payment',
                                        'file_name' => $order->orderPayment?->transfer_receipt ?? '_blank.png',
                                    ]) }}"
                                        target="_blank">
                                        {{ __('Lihat Bukti Transfer') }}
                                    </a>
                                @endif
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal C0nfirmation --}}
    @if ($order->id_status == 2)
        <div class="modal fade" id="confirmOrderModal" tabindex="-1" aria-labelledby="confirmOrderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('admin.order.status', $order) }}" class="modal-content" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmOrderModalLabel">
                            {{ __('Konfirmasi Pesanan') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="id_status" value="3" class="form-selectgroup-input"
                                    checked>
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>
                                        {{ __('Proses Pesanan') }}
                                    </div>
                                </div>
                            </label>
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="id_status" value="7" class="form-selectgroup-input">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>
                                        {{ __('Tolak Pesanan') }}
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Kirim') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($order->id_status == 3)
        <div class="modal fade" id="sendOrderModal" tabindex="-1" aria-labelledby="sendOrderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('admin.order.status', $order) }}" class="modal-content" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendOrderModalLabel">
                            {{ __('Kirim Pesanan') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_status" value="4" />
                        <div class="mb-3">
                            <label for="tracking_number" class="form-label">
                                {{ __('Nomor Resi') }}
                            </label>
                            <input name="tracking_number" type="text" class="form-control" id="tracking_number"
                                required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Kirim') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
