@extends('layouts.website.main')

@section('title', __('Checkout'))

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('Checkout') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li><a href="{{ route('product.index') }}">{{ __('Belanja') }}</a></li>
                        <li class="checkout_url" data-url="{{ route('checkout.index') }}">
                            {{ __('Checkout') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="checkout-wrapper section">
        <div class="container">
            <form action="{{ route('checkout.store') }}" class="row justify-content-center" method="POST">
                @csrf
                <div class="col-lg-8">
                    <div class="checkout-steps-form-style-1">
                        <ul id="accordionExample">
                            <li>
                                <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="true" aria-controls="collapseThree">
                                    {{ __('Billing Detail') }}
                                </h6>
                                <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>
                                                    {{ __('Nama Depan') }}
                                                </label>
                                                <div class="form-input form">
                                                    <input name="first_name" type="text"
                                                        placeholder="{{ __('Nama Depan') }}"
                                                        value="{{ old('last_name') ?? auth()->user()->userAddress?->first_name }}" />
                                                    @error('first_name')
                                                        <small class="text-danger text-error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>
                                                    {{ __('Nama Belakang') }}
                                                </label>
                                                <div class="form-input form">
                                                    <input name="last_name" type="text"
                                                        placeholder="{{ __('Nama Belakang') }}"
                                                        value="{{ old('last_name') ?? auth()->user()->userAddress?->last_name }}" />
                                                    @error('last_name')
                                                        <small class="text-danger text-error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>
                                                    {{ __('Provinsi') }}
                                                </label>
                                                <div class="select-items">
                                                    <select name="id_province" class="form-control">
                                                        <option value="">{{ __('Pilih') }}</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province['province_id'] }}">
                                                                {{ $province['province'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_province')
                                                        <small class="text-danger text-error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>
                                                    {{ __('Kota') }}
                                                </label>
                                                <div class="select-items">
                                                    <select name="id_city" class="form-control" disabled>
                                                        <option value="">{{ __('Pilih') }}</option>
                                                    </select>
                                                    @error('id_city')
                                                        <small class="text-danger text-error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form form-default">
                                                <label>
                                                    {{ __('Alamat Jalan') }}
                                                </label>
                                                <div class="form-input form">
                                                    <input name="street_address" type="text"
                                                        placeholder="{{ __('Alamat Jalan') }}"
                                                        value="{{ old('street_address') ?? auth()->user()->userAddress?->street_address }}" />
                                                    @error('street_address')
                                                        <small class="text-danger text-error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>
                                                    {{ __('Kode POS') }}
                                                </label>
                                                <div class="form-input form">
                                                    <input name="postal_code" type="text"
                                                        placeholder="{{ __('Kode POS') }}"
                                                        value="{{ old('postal_code') ?? auth()->user()->userAddress?->postal_code }}" />
                                                    @error('postal_code')
                                                        <small class="text-danger text-error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form form-default">
                                                <label>
                                                    {{ __('Telepon') }}
                                                </label>
                                                <div class="form-input form">
                                                    <input name="phone" type="text" placeholder="{{ __('Telepon') }}"
                                                        value="{{ old('phone') ?? auth()->user()->userAddress?->phone }}" />
                                                    @error('phone')
                                                        <small class="text-danger text-error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form form-default">
                                                <label>
                                                    {{ __('Catatan') }}
                                                </label>
                                                <div class="form-input form">
                                                    <input name="note" type="text" placeholder="{{ __('Catatan') }}"
                                                        value="{{ old('note') ?? auth()->user()->userAddress?->note }}" />
                                                    @error('note')
                                                        <small class="text-danger text-error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </li>
                            <li>
                                <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    {{ __('Pengirirman') }}
                                </h6>
                                <section class="checkout-steps-form-content collapse" id="collapseFour"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="checkout-payment-option">
                                                <h6 class="heading-6 font-weight-400 payment-title">
                                                    {{ __('Pilih Kurir') }}
                                                </h6>
                                                <div class="payment-option-wrapper">
                                                    @foreach (allCourier() as $courier)
                                                        <div class="single-payment-option d-flex">
                                                            <input type="radio" name="code_courier"
                                                                id="courier-{{ $courier->code }}"
                                                                value="{{ $courier->code }}">
                                                            <label for="courier-{{ $courier->code }}">
                                                                <img src="{{ route('file.show', [
                                                                    'file_path' => 'courier',
                                                                    'file_name' => $courier->image ?? '',
                                                                ]) }}"
                                                                    alt="img" style="height: 50px;">
                                                                <p>{{ $courier->name ?? '-' }}</p>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-none">
                                            <div class="checkout-payment-option">
                                                <h6 class="heading-6 font-weight-400 payment-title">
                                                    {{ __('Pilih Layanan') }}
                                                </h6>
                                                <div class="payment-option-wrapper courier_service">
                                                    {{-- <div class="single-payment-option d-flex">
                                                        <input type="radio" name="service" id="courier-1" />
                                                        <label for="courier-1">
                                                            <p class="fw-bold">Reguler</p>
                                                            <small>Estimasi 1-2 Hari</small>
                                                            <h6 class="mt-1">Rp. 15.000</h6>
                                                        </label>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <input type="hidden" name="description" value="" />
                                            <input type="hidden" name="etd" value="" />
                                            <input type="hidden" name="cost" value="" />
                                        </div>
                                    </div>
                                </section>
                            </li>
                            <li>
                                <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapsefive"
                                    aria-expanded="false" aria-controls="collapsefive">
                                    {{ __('Pembayaran') }}
                                </h6>
                                <section class="checkout-steps-form-content collapse" id="collapsefive"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="checkout-payment-option">
                                                <div class="payment-option-wrapper">
                                                    <div class="single-payment-option">
                                                        <input type="radio" name="id_bank_account" checked
                                                            id="id_bank_account-1" value="1" />
                                                        <label for="id_bank_account-1">
                                                            <img src="{{ route('file.show', [
                                                                'file_path' => 'bank_account',
                                                                'file_name' => 'bca.png',
                                                            ]) }}"
                                                                alt="img" style="height: 50px;">
                                                            <p>{{ __('SRINATIN') }}</p>
                                                            <span class="price">
                                                                3890645720
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="alert alert-warning" role="alert">
                                                {{ __('Transfer Bank') }}
                                                ({{ __('Verifikasi Manual / Kirim Bukti Bayar') }})
                                                <p class="text-muted">
                                                    {{ __('Setelah melakukan transfer, silahkan konfirmasi di') }}
                                                    <a href="#">WhatsApp</a>
                                                    atau
                                                    <a href="#">{{ __('Halaman Konfirmasi') }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="checkout-sidebar-price-table">
                            <h5 class="title fw-bold">
                                {{ __('Pesananku') }}
                            </h5>
                            <div class="sub-total-price">
                                @if ($carts->count() > 0)
                                    @foreach ($carts as $cart)
                                        <div class="total-price">
                                            <p class="value text-muted">
                                                {{ $cart->product?->name ?? '-' }}
                                                - {{ $cart->productVariant->size ?? '-' }} x {{ $cart->qty }}
                                            </p>
                                            <p class="price text-muted">
                                                Rp.&nbsp;{{ number_format($cart->sub_total, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    @endforeach
                                    <hr>
                                @endif
                                <div class="total-price">
                                    <p class="value">{{ __('Subotal Harga') }}</p>
                                    <p class="price">
                                        Rp.&nbsp;{{ number_format($carts->sum('sub_total'), 0, ',', '.') }}
                                        <input type="hidden" name="total_price"
                                            value="{{ $carts->sum('sub_total') }}" />
                                    </p>
                                </div>
                                <div class="total-price">
                                    <p class="value">{{ __('Total Berat') }}</p>
                                    <p class="price">{{ ($carts->sum('weight') ?? 0) / 1000 }}&nbsp;Kg</p>
                                    <input type="hidden" name="total_weight" value="{{ $carts->sum('weight') }}" />
                                </div>
                                <div class="total-price">
                                    <p class="value">{{ __('Total Diskon') }}</p>
                                    <p class="price">
                                        Rp.&nbsp;{{ number_format($carts->sum('discount'), 0, ',', '.') }}
                                        <input type="hidden" name="discount_amount"
                                            value="{{ $carts->sum('discount') }}" />
                                    </p>
                                </div>
                                <div class="total-price">
                                    <p class="value">{{ __('Biaya Pengiriman') }}</p>
                                    <p class="price">
                                        Rp.&nbsp;<span class="shipping_cost">0</span>
                                        <input type="hidden" name="shipping_cost" value="0" />
                                    </p>
                                </div>
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value fw-bold">Total</p>
                                    <p class="price">
                                        Rp.&nbsp;<span
                                            class="payment_amount">{{ number_format($carts->sum('total'), 0, ',', '.') }}</span>
                                        <input type="hidden" name="payment_amount" value="{{ $carts->sum('total') }}"
                                            data-payment_amount="{{ $carts->sum('total') }}" />
                                    </p>
                                </div>
                            </div>
                            <div class="price-table-btn button">
                                <button type="submit" class="btn btn-alt w-100">
                                    {{ __('Place Order') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('change', '[name="id_province"]', function() {
                let url = $('.checkout_url').data('url');
                $('[name="id_city"]').attr('disabled', true).empty().append(
                    '<option value="">Pilih</option>'
                );
                showLoader();
                $.get(url, {
                    id_province: $(this).val()
                }, function(data, status) {
                    if (data.cities) {
                        $.each(data.cities, function(key, value) {
                            $('[name="id_city"]').append(
                                `<option value="${value.city_id}">${value.type} ${value.city_name}</option>`
                            );
                        });
                    }
                }).done(function() {
                    $('[name="id_city"]').attr('disabled', false);
                    hideLoader();
                });
            });
            $(document).on('change', '[name="id_city"], [name="code_courier"]', function() {
                let url = $('.checkout_url').data('url');
                let id_city = $('[name="id_city"]').find(":selected").val();
                let code_courier = $('[name="code_courier"]:checked').val();
                let payment_amount = $('[name="payment_amount"]').data('payment_amount');

                $('.courier_service').parent().parent().addClass('d-none');
                $('.courier_service').empty();

                $('[name="description"]').val('');
                $('[name="etd"]').val('');
                $('[name="cost"]').val('');
                $('.shipping_cost').html(format(0));
                $('[name="shipping_cost"]').val(0);
                $('.payment_amount').html(format(payment_amount));
                $('[name="payment_amount"]').val(payment_amount);
                if (id_city && code_courier) {
                    showLoader();
                    $.get(url, {
                        id_city: id_city,
                        code_courier: code_courier,
                    }, function(data, status) {
                        if (data.courier_services[0]['costs'].length > 0) {
                            $.each(data.courier_services[0]['costs'], function(key, value) {
                                $('.courier_service').append(
                                    `<div class="single-payment-option d-flex">
                                        <input type="radio" name="service" id="courier-${key}" value="${value.service}" data-description="${value.description}" data-etd="${value.cost[0]['etd']}" data-cost="${value.cost[0]['value']}" />
                                        <label for="courier-${key}">
                                            <p class="fw-bold">${value.description}</p>
                                            <small>Estimasi ${value.cost[0]['etd']}</small>
                                            <h6 class="mt-1">Rp. ${format(value.cost[0]['value'])}</h6>
                                        </label>
                                    </div>`
                                );
                            });
                            $('.courier_service').parent().parent().removeClass('d-none');
                        }
                    }).done(function() {
                        hideLoader();
                    });
                }
            });
            $(document).on('change', '[name="service"]', function() {
                let description = $(this).data('description');
                let etd = $(this).data('etd');
                let cost = $(this).data('cost');
                let payment_amount = $('[name="payment_amount"]').data('payment_amount');
                // Shipping
                $('[name="description"]').val(description);
                $('[name="etd"]').val(etd);
                $('[name="cost"]').val(cost);
                // Payment
                $('.shipping_cost').html(format(cost));
                $('[name="shipping_cost"]').val(cost);
                $('.payment_amount').html(format(payment_amount + cost));
                $('[name="payment_amount"]').val(payment_amount + cost);
            });

            var format = function(num) {
                var str = num.toString().replace("", ""),
                    parts = false,
                    output = [],
                    i = 1,
                    formatted = null;
                if (str.indexOf(".") > 0) {
                    parts = str.split(".");
                    str = parts[0];
                }
                str = str.split("").reverse();
                for (var j = 0, len = str.length; j < len; j++) {
                    if (str[j] != ".") {
                        output.push(str[j]);
                        if (i % 3 == 0 && j < (len - 1)) {
                            output.push(".");
                        }
                        i++;
                    }
                }
                formatted = output.reverse().join("");
                return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
            };
        });
    </script>
@endpush
