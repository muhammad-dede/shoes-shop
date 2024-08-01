@extends('layouts.website.main')

@section('title', __('Cart'))

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li>
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.index') }}">
                                {{ __('Belanja') }}
                            </a>
                        </li>
                        <li>{{ __('Cart') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12"></div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>{{ __('Produk') }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{ __('Diskon') }}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('cart.update') }}" class="form_update_cart" method="POST">
                    @csrf
                    @forelse ($carts as $key => $cart)
                        <div class="cart-single-list">
                            <div class="row align-items-center">
                                <div class="col-lg-1 col-md-1 col-12">
                                    <a
                                        href="{{ route('product.show', [
                                            'slug' => $cart->product->slug ?? '',
                                        ]) }}">
                                        <img src="{{ route('file.show', [
                                            'file_path' => 'product',
                                            'file_name' => $cart->product->image_1 ?? '_blank.jpg,',
                                        ]) }}"
                                            alt="img" />
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-3 col-12">
                                    <h5 class="product-name">
                                        <a href="{{ route('product.show', $cart->product->slug ?? '') }}">
                                            {{ $cart->product->name ?? '-' }}
                                        </a>
                                    </h5>
                                    <p class="product-des">
                                        <span><em>Kategori:</em> {{ $cart->product->category->name ?? '-' }}</span>
                                        <span><em>Size:</em> {{ $cart->productVariant->size ?? '-' }}</span>
                                    </p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <div class="count-input">
                                        <input type="hidden" name="cart[{{ $key }}][id_product]"
                                            value="{{ $cart->id_product }}" />
                                        <input type="hidden" name="cart[{{ $key }}][id_product_variant]"
                                            value="{{ $cart->id_product_variant }}" />
                                        <select name="cart[{{ $key }}][qty]" class="form-control cart_qty">
                                            @for ($i = 0; $i < $cart->productVariant->qty + 1; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $cart->qty == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>
                                        Rp.&nbsp;{{ number_format($cart->sub_total ?? 0, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>
                                        Rp.&nbsp;{{ number_format($cart->discount, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <a href="{{ route('cart.delete', $cart) }}" class="remove-item">
                                        <i class="lni lni-close"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="cart-single-list">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="text-center my-5">
                                        <h5 class="mb-3">{{ __('Keranjang kamu kosong') }}</h5>
                                        <div class="button">
                                            <a href="{{ route('product.index') }}" class="btn">
                                                {{ __('Ayo Belanja') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </form>
            </div>
            @if ($carts->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="total-amount">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>
                                                Subtotal
                                                <span>
                                                    Rp.&nbsp;{{ number_format($carts->sum('sub_total') ?? 0, 0, ',', '.') }}
                                                </span>
                                            </li>
                                            <li>
                                                Total Berat<span>{{ $carts->sum('weight') / 1000 }}&nbsp;Kg</span>
                                            </li>
                                            <li>
                                                {{ __('Total Diskon') }}
                                                <span>
                                                    Rp.&nbsp;{{ number_format($carts->sum('discount') ?? 0, 0, ',', '.') }}
                                                </span>
                                            </li>
                                            <li class="last">
                                                Total<span
                                                    class="fw-bold">Rp.&nbsp;{{ number_format($carts->sum('total') ?? 0, 0, ',', '.') }}</span>
                                            </li>
                                        </ul>
                                        <div class="button">
                                            <a href="{{ route('checkout.index') }}" class="btn">
                                                {{ __('Checkout') }}
                                            </a>
                                            <a href="{{ route('product.index') }}" class="btn btn-alt">
                                                {{ __('Lanjut Belanja') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <form action="" class="form_delete_cart" method="POST">
        @csrf
        @method('delete')
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('change', '.cart_qty', function() {
                $('.form_update_cart').submit();
            });
            $(document).on('click', '.remove-item', function(event) {
                event.preventDefault();
                let url = $(this).attr('href');
                $('.form_delete_cart').attr('action', url).submit();
            });
        });
    </script>
@endpush
