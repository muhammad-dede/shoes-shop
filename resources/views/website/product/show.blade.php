@extends('layouts.website.main')

@section('title', $product->name ?? 'Detail Produk')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">
                            {{ $product->name ?? 'Detail Produk' }}
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
                        <li>
                            <a href="{{ route('product.index') }}">
                                {{ __('Belanja') }}
                            </a>
                        </li>
                        <li>
                            {{ $product->name ?? 'Detail Produk' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <img src="{{ route('file.show', [
                                        'file_path' => 'product',
                                        'file_name' => $product->image_1 ?? '_blank.jpg',
                                    ]) }}"
                                        id="current" alt="img">
                                </div>
                                <div class="images">
                                    <img src="{{ route('file.show', [
                                        'file_path' => 'product',
                                        'file_name' => $product->image_1 ?? '_blank.jpg',
                                    ]) }}"
                                        class="img" alt="img">
                                    @if ($product->image_2)
                                        <img src="{{ route('file.show', [
                                            'file_path' => 'product',
                                            'file_name' => $product->image_2 ?? '_blank.jpg',
                                        ]) }}"
                                            class="img" alt="img">
                                    @endif
                                    @if ($product->image_3)
                                        <img src="{{ route('file.show', [
                                            'file_path' => 'product',
                                            'file_name' => $product->image_3 ?? '_blank.jpg',
                                        ]) }}"
                                            class="img" alt="img">
                                    @endif
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <form action="#" class="product-info" method="POST">
                            @csrf
                            <input type="hidden" name="id_product" value="{{ $product->id }}" />
                            <h2 class="title">
                                {{ $product->name ?? '-' }}
                            </h2>
                            <p class="category">
                                <i class="lni lni-tag"></i> Kategori:
                                <a
                                    href="{{ route('product.index', [
                                        'category' => $product->category->slug ?? '',
                                    ]) }}">
                                    {{ $product->category->name ?? '-' }}
                                </a>
                            </p>
                            <h3 class="price">
                                Rp.&nbsp;{{ number_format($product->price - ($product->price * $product->discount) / 100, 0, ',', '.') }}
                                @if ($product->discount > 0)
                                    <span>Rp.&nbsp;{{ number_format($product->price ?? 0, 0, ',', '.') }}</span>
                                @endif
                            </h3>
                            <p class="info-text">
                                <strong>Berat:</strong>
                                {{ $product->weight / 1000 ?? 0 }}&nbsp;Kg
                            </p>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="id_product_variant">
                                            {{ __('Ukuran') }}
                                        </label>
                                        <select name="id_product_variant" class="form-control" id="id_product_variant"
                                            data-url="{{ route('ajax.product-variant.qty') }}">
                                            <option value="">Pilih</option>
                                            @foreach ($product->productVariant as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_product_variant') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->size ?? '-' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_product_variant')
                                            <small class="text-danger text-error">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group quantity">
                                        <label for="qty">
                                            {{ __('Quantity') }}
                                        </label>
                                        <select name="qty" class="form-control" id="qty">
                                            <option value="">Pilih</option>
                                        </select>
                                        @error('qty')
                                            <small class="text-danger text-error">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-content">
                                <div class="row align-items-end">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="button cart-button">
                                            <button type="button" data-url="{{ route('cart.store') }}"
                                                class="btn add_to_cart">
                                                {{ __('Add to Cart') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="wish-button">
                                            <button type="button" data-url="{{ route('wishlist.store') }}"
                                                class="btn add_to_wishlist">
                                                <i class="lni lni-heart"></i>
                                                {{ __('To Wishlist') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="single-block">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="info-body custom-responsive-margin">
                                <h4>Deskripsi</h4>
                                {!! $product->description ?? '<p>' . __('Tidak ada deskripsi') . '</p>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold">{{ __('Produck Terkait') }}</h5>
                </div>
                <div>
                    <a href="{{ route('product.index', [
                        'category' => $product->category->slug ?? '',
                    ]) }}"
                        class="text-dark fw-bold">{{ __('Lihat Semua') }}</a>
                </div>
            </div>
            <div class="row">
                @forelse ($related_products as $related_product)
                    <div class="col-lg-3 col-md-6 col-12 d-flex">
                        <div class="single-product">
                            <div class="product-image">
                                <img src="{{ route('file.show', [
                                    'file_path' => 'product',
                                    'file_name' => $related_product->image_1 ?? '_blank.jpg',
                                ]) }}"
                                    alt="img" style="height: 225px; border-radius: 6%;">
                                @if ($related_product->discount > 0)
                                    <span class="sale-tag">-{{ $related_product->discount ?? 0 }}%</span>
                                @endif
                                <div class="button">
                                    <a href="{{ route('product.show', $related_product->slug) }}" class="btn">
                                        <i class="lni lni-cart"></i>
                                        {{ __('Add to Cart') }}
                                    </a>
                                </div>
                            </div>
                            <div class="product-info">
                                <span class="category">
                                    {{ $related_product->brand->name ?? '-' }}
                                </span>
                                <h4 class="title">
                                    <a href="{{ route('product.show', $related_product->slug) }}">
                                        {{ $related_product->name ?? '-' }}
                                    </a>
                                </h4>
                                <div class="price">
                                    <span>
                                        Rp.&nbsp;{{ number_format($related_product->price - ($related_product->price * $related_product->discount) / 100, 0, ',', '.') }}
                                    </span>
                                    @if ($related_product->discount > 0)
                                        <span class="discount-price">
                                            Rp.&nbsp;{{ number_format($related_product->price ?? 0, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="text-center my-5">
                            <h5>{{ __('Produk Tidak Tersedia') }}</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        const current = document.getElementById("current");
        const opacity = 0.6;
        const imgs = document.querySelectorAll(".img");
        imgs.forEach(img => {
            img.addEventListener("click", (e) => {
                imgs.forEach(img => {
                    img.style.opacity = 1;
                });
                current.src = e.target.src;
                e.target.style.opacity = opacity;
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '[name="id_product_variant"]', function() {
                let url = $(this).data('url');
                let qty = $('[name="qty"]');
                qty.attr('disabled', true).empty().append(
                    '<option value="">Pilih</option>'
                );
                $.get(url, {
                    'id': $(this).val(),
                }, function(data, status) {
                    if (data.data != null) {
                        for (let index = 0; index < data.data.qty; index++) {
                            qty.append(
                                `<option value="${index + 1}">${index + 1}</option>`
                            );
                        }
                    }
                }).done(function() {
                    qty.attr('disabled', false);
                });
            });
        });
        $(document).on('click', '.add_to_cart', function(event) {
            event.preventDefault();
            let url = $(this).data('url');
            $('.product-info').attr('action', url).submit();
        });
        $(document).on('click', '.add_to_wishlist', function(event) {
            event.preventDefault();
            let url = $(this).data('url');
            $('.product-info').attr('action', url).submit();
        });
    </script>
@endpush
