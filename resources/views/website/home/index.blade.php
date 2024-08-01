@extends('layouts.website.main')

@section('content')
    <section class="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 custom-padding-right">
                    <div class="slider-head">
                        <div class="hero-slider">
                            <div class="single-slider"
                                style="background-image: url({{ route('file.show', [
                                    'file_path' => 'banner',
                                    'file_name' => '01.jpg',
                                ]) }});">
                            </div>
                            <div class="single-slider"
                                style="background-image: url({{ route('file.show', [
                                    'file_path' => 'banner',
                                    'file_name' => '02.jpg',
                                ]) }});">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold">{{ __('New Arrival') }}</h5>
                </div>
                <div>
                    <a href="{{ route('product.index', [
                        'sort' => 'new',
                    ]) }}"
                        class="text-dark fw-bold">{{ __('Lihat Semua') }}</a>
                </div>
            </div>
            <div class="row">
                @forelse ($new_arrivals as $new_arrival)
                    <div class="col-lg-3 col-md-6 col-12 d-flex">
                        <div class="single-product">
                            <div class="product-image">
                                <img src="{{ route('file.show', [
                                    'file_path' => 'product',
                                    'file_name' => $new_arrival->image_1 ?? '_blank.jpg',
                                ]) }}"
                                    alt="img" style="height: 225px; border-radius: 6%;">
                                @if ($new_arrival->discount > 0)
                                    <span class="sale-tag">-{{ $new_arrival->discount ?? 0 }}%</span>
                                @endif
                                <div class="button">
                                    <a href="{{ route('product.show', $new_arrival->slug) }}" class="btn">
                                        <i class="lni lni-cart"></i>
                                        {{ __('Add to Cart') }}
                                    </a>
                                </div>
                            </div>
                            <div class="product-info">
                                <span class="category">
                                    {{ $new_arrival->brand->name ?? '-' }}
                                </span>
                                <h4 class="title">
                                    <a href="{{ route('product.show', $new_arrival->slug) }}">
                                        {{ $new_arrival->name ?? '-' }}
                                    </a>
                                </h4>
                                <div class="price">
                                    <span>
                                        Rp.&nbsp;{{ number_format($new_arrival->price - ($new_arrival->price * $new_arrival->discount) / 100, 0, ',', '.') }}
                                    </span>
                                    @if ($new_arrival->discount > 0)
                                        <span class="discount-price">
                                            Rp.&nbsp;{{ number_format($new_arrival->price ?? 0, 0, ',', '.') }}
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
    @foreach ($brands as $brand)
        <section class="section pb-5 pt-3">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold">{{ $brand->name ?? '-' }}</h5>
                    </div>
                    <div>
                        <a href="{{ route('product.index', [
                            'brand' => $brand->slug,
                        ]) }}"
                            class="text-dark fw-bold">{{ __('Lihat Semua') }}</a>
                    </div>
                </div>
                <div class="row equal-height-row">
                    @forelse ($brand->product as $product)
                        <div class="col-lg-3 col-md-6 col-12 d-flex">
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ route('file.show', [
                                        'file_path' => 'product',
                                        'file_name' => $product->image_1 ?? '_blank.jpg',
                                    ]) }}"
                                        alt="img" style="height: 225px; border-radius: 6%;">
                                    @if ($product->discount > 0)
                                        <span class="sale-tag">-{{ $product->discount ?? 0 }}%</span>
                                    @endif
                                    <div class="button">
                                        <a href="{{ route('product.show', $product->slug) }}" class="btn">
                                            <i class="lni lni-cart"></i>
                                            {{ __('Add to Cart') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="category">
                                        {{ $product->brand->name ?? '-' }}
                                    </span>
                                    <h4 class="title">
                                        <a href="{{ route('product.show', $product->slug) }}">
                                            {{ $product->name ?? '-' }}
                                        </a>
                                    </h4>
                                    <div class="price">
                                        <span>
                                            Rp.&nbsp;{{ number_format($product->price - ($product->price * $product->discount) / 100, 0, ',', '.') }}
                                        </span>
                                        @if ($product->discount > 0)
                                            <span class="discount-price">
                                                Rp.&nbsp;{{ number_format($product->price ?? 0, 0, ',', '.') }}
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
    @endforeach
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <h2 class="title">Popular Brands</h2>
                </div>
            </div>
            <div class="brands-logo-wrapper">
                <div class="brands-logo-carousel d-flex align-items-center justify-content-between">
                    @foreach (populerBrand() as $item)
                        <div class="brand-logo">
                            <img src="{{ route('file.show', [
                                'file_path' => 'brand',
                                'file_name' => $item->image,
                            ]) }}"
                                alt="img">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });
    </script>
@endpush
