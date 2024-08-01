@extends('layouts.website.main')

@section('title', __('Pesanan'))

@push('css')
    <style>
        .nav-tabs {
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
        }
    </style>
@endpush

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">
                            {{ __('Pesanan') }}
                        </h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li>
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li>{{ __('Pesanan') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="shopping-cart section">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="status-order-0-tab" data-bs-toggle="tab"
                        data-bs-target="#status-order-0-tab-pane" type="button" role="tab"
                        aria-controls="status-order-0-tab-pane" aria-selected="true">
                        {{ __('Semua Pesanan') }}
                    </button>
                </li>
                @foreach (allStatusOrder() as $key => $item)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="status-order-{{ $item->id }}-tab" data-bs-toggle="tab"
                            data-bs-target="#status-order-{{ $item->id }}-tab-pane" type="button" role="tab"
                            aria-controls="status-order-{{ $item->id }}-tab-pane" aria-selected="false">
                            {{ $item->name ?? '-' }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="status-order-0-tab-pane" role="tabpanel"
                    aria-labelledby="status-order-0-tab" tabindex="0">
                    <div class="card border border-top-0"
                        style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Produk') }}</th>
                                            <th>{{ __('No. Pesanan') }}</th>
                                            <th>{{ __('Diskon') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            <th>{{ __('Status Pesanan') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-column">
                                                        @foreach ($order->orderItem as $order_item)
                                                            <div class="d-flex gap-3">
                                                                <img src="{{ route('file.show', [
                                                                    'file_path' => 'product',
                                                                    'file_name' => $order_item->product?->image_1 ?? '_blank.png',
                                                                ]) }}"
                                                                    alt="img" style="height: 50px; width: 50px;">
                                                                <div>
                                                                    <p>{{ $order_item->product?->name ?? '-' }}</p>
                                                                    <small>
                                                                        Ukuran:
                                                                        {{ $order_item->productVariant?->size ?? '-' }}
                                                                        -
                                                                        Qty: {{ $order_item->qty ?? '-' }}
                                                                    </small>
                                                                    <p>
                                                                        Rp.
                                                                        {{ number_format($order_item->total ?? 0, 0, ',', '.') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    {{ $order->no_order ?? '-' }}
                                                    @if ($order->tracking_number)
                                                        <p>
                                                            {{ __('Resi') }}:
                                                            <strong>{{ $order->tracking_number }}</strong>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    Rp. {{ number_format($order->discount_amount ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td class="align-middle">
                                                    Rp. {{ number_format($order->payment_amount ?? 0, 0, ',', '.') }}
                                                </td>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-{{ getColorStatus($order->id_status) }}">
                                                        {{ $order->status->name ?? '-' }}
                                                    </span>
                                                    @if ($order->id_status == 6)
                                                        <p>
                                                            {{ __('Tanggal Terima') }}:
                                                            <strong>{{ \Carbon\Carbon::parse($order->receipt_date)->isoFormat('D MMMM Y') }}</strong>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-column gap-2">
                                                        @if ($order->id_status == 1)
                                                            <button class="btn btn-secondary btn-sm w-100 payment_confirm"
                                                                data-bs-toggle="modal" data-bs-target="#paymentConfirmModal"
                                                                data-url="{{ route('order.payment-confirm', $order) }}">
                                                                {{ __('Konfirmasi Pembayaran') }}
                                                            </button>
                                                            <form action="{{ route('order.cancel', $order) }}"
                                                                method="POST" class="order_cancel">
                                                                @csrf
                                                                <button
                                                                    class="btn btn-danger btn-sm w-100">{{ __('Batalkan Pesanan') }}</button>
                                                            </form>
                                                        @endif
                                                        @if ($order->id_status == 4)
                                                            <form action="{{ route('order.receipt', $order) }}"
                                                                method="POST" class="order_receipt">
                                                                @csrf
                                                                <button
                                                                    class="btn btn-{{ getColorStatus($order->id_status) }} btn-sm w-100">
                                                                    {{ __('Pesanan Diterima') }}
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    <div class="text-center my-5">
                                                        <span>{{ __('Belum ada pesanan') }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach (allStatusOrder() as $key => $item)
                    <div class="tab-pane fade" id="status-order-{{ $item->id }}-tab-pane" role="tabpanel"
                        aria-labelledby="status-order-{{ $item->id }}-tab" tabindex="0">
                        <div class="card border border-top-0"
                            style="border-top-left-radius: 0px; border-top-right-radius: 0px;">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Produk') }}</th>
                                                <th>{{ __('No. Pesanan') }}</th>
                                                <th>{{ __('Diskon') }}</th>
                                                <th>{{ __('Total') }}</th>
                                                <th>{{ __('Status Pesanan') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders->where('id_status', $item->id) as $order)
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="d-flex flex-column">
                                                            @foreach ($order->orderItem as $order_item)
                                                                <div class="d-flex gap-3">
                                                                    <img src="{{ route('file.show', [
                                                                        'file_path' => 'product',
                                                                        'file_name' => $order_item->product?->image_1 ?? '_blank.png',
                                                                    ]) }}"
                                                                        alt="img" style="height: 50px; width: 50px;">
                                                                    <div>
                                                                        <p>{{ $order_item->product?->name ?? '-' }}</p>
                                                                        <small>
                                                                            Ukuran:
                                                                            {{ $order_item->productVariant?->size ?? '-' }}
                                                                            -
                                                                            Qty: {{ $order_item->qty ?? '-' }}
                                                                        </small>
                                                                        <p>
                                                                            Rp.
                                                                            {{ number_format($order_item->total ?? 0, 0, ',', '.') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        {{ $order->no_order ?? '-' }}
                                                        @if ($order->tracking_number)
                                                            <p>
                                                                {{ __('Resi') }}:
                                                                <strong>{{ $order->tracking_number }}</strong>
                                                            </p>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        Rp. {{ number_format($order->discount_amount ?? 0, 0, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle">
                                                        Rp. {{ number_format($order->payment_amount ?? 0, 0, ',', '.') }}
                                                    </td>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span class="text-{{ getColorStatus($order->id_status) }}">
                                                            {{ $order->status->name ?? '-' }}
                                                        </span>
                                                        @if ($order->id_status == 6)
                                                            <p>
                                                                {{ __('Tanggal Terima') }}:
                                                                <strong>{{ \Carbon\Carbon::parse($order->receipt_date)->isoFormat('D MMMM Y') }}</strong>
                                                            </p>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="d-flex flex-column gap-2">
                                                            @if ($order->id_status == 1)
                                                                <button
                                                                    class="btn btn-secondary btn-sm w-100 payment_confirm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#paymentConfirmModal"
                                                                    data-url="{{ route('order.payment-confirm', $order) }}">
                                                                    {{ __('Konfirmasi Pembayaran') }}
                                                                </button>
                                                                <form action="{{ route('order.cancel', $order) }}"
                                                                    method="POST" class="order_cancel">
                                                                    @csrf
                                                                    <button
                                                                        class="btn btn-danger btn-sm w-100">{{ __('Batalkan Pesanan') }}</button>
                                                                </form>
                                                            @endif
                                                            @if ($order->id_status == 4)
                                                                <form action="{{ route('order.receipt', $order) }}"
                                                                    method="POST" class="order_receipt">
                                                                    @csrf
                                                                    <button
                                                                        class="btn btn-{{ getColorStatus($order->id_status) }} btn-sm w-100">
                                                                        {{ __('Pesanan Diterima') }}
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center my-5">
                                                            <span>{{ __('Belum ada pesanan') }}</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Modal Payment COnfirmation --}}
    <div class="modal fade" id="paymentConfirmModal" tabindex="-1" aria-labelledby="paymentConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="#" class="modal-content form_payment_confirm" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentConfirmModalLabel">
                        {{ __('Konfirmasi Pembayaran') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="transfer_date" class="form-label">
                            {{ __('Tanggal Transfer') }}
                        </label>
                        <input name="transfer_date" type="date" class="form-control" id="transfer_date" required />
                    </div>
                    <div class="mb-3">
                        <label for="account_name" class="form-label">
                            {{ __('Nama Pengirim') }}
                        </label>
                        <input name="account_name" type="text" class="form-control" id="account_name" required />
                    </div>
                    <div class="mb-3">
                        <label for="account_number" class="form-label">
                            {{ __('Nomor Rekening') }}
                        </label>
                        <input name="account_number" type="text" class="form-control" id="account_number" required />
                    </div>
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">
                            {{ __('Nama Bank') }}
                        </label>
                        <input name="bank_name" type="text" class="form-control" id="bank_name" required />
                    </div>
                    <div class="mb-3">
                        <label for="transfer_receipt" class="form-label">
                            {{ __('Bukti Transfer') }}
                        </label>
                        <input name="transfer_receipt" type="file" class="form-control" id="transfer_receipt"
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
    <div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="#" class="modal-content form_receipt" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="receiptModalLabel">
                        {{ __('Konfirmasi Penerimaan') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="transfer_date" class="form-label">
                            {{ __('Tanggal Transfer') }}
                        </label>
                        <input name="transfer_date" type="date" class="form-control" id="transfer_date" required />
                    </div>
                    <div class="mb-3">
                        <label for="account_name" class="form-label">
                            {{ __('Nama Pengirim') }}
                        </label>
                        <input name="account_name" type="text" class="form-control" id="account_name" required />
                    </div>
                    <div class="mb-3">
                        <label for="account_number" class="form-label">
                            {{ __('Nomor Rekening') }}
                        </label>
                        <input name="account_number" type="text" class="form-control" id="account_number" required />
                    </div>
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">
                            {{ __('Nama Bank') }}
                        </label>
                        <input name="bank_name" type="text" class="form-control" id="bank_name" required />
                    </div>
                    <div class="mb-3">
                        <label for="transfer_receipt" class="form-label">
                            {{ __('Bukti Transfer') }}
                        </label>
                        <input name="transfer_receipt" type="file" class="form-control" id="transfer_receipt"
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.order_cancel', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Batalkan Pesanan",
                    text: "Kamu yakin ingin membatalkan pesanan ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, batal",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).submit();
                    }
                });
            });
            $(document).on('click', '.payment_confirm', function(event) {
                event.preventDefault();
                let url = $(this).data('url');
                $('.form_payment_confirm').attr('action', url);
            });
            $(document).on('click', '.order_receipt', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Konfirmasi Penerimaan",
                    text: "Kamu yakin sudah menerima pesanan ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).submit();
                    }
                });
            });
        });
    </script>
@endpush
