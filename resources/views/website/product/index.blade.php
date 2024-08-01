@extends('layouts.website.main')

@section('title', __('Belanja'))

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">
                            {{ __('Produk') }}
                        </h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li>
                            <a href="{{ route('home') }}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li class="current_url" data-url={{ route('product.index') }}>
                            {{ __('Produk') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="product-sidebar">
                        <div class="single-widget search">
                            <h3>
                                {{ __('Cari Produk') }}
                            </h3>
                            <form action="{{ route('product.index') }}" method="GET">
                                <input name="search" type="text" placeholder="{{ __('Cari disini...') }}"
                                    value="{{ request()->get('search') ?? null }}" />
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <div class="single-widget condition">
                            <h3>
                                {{ __('Filter by Brand') }}
                            </h3>
                            @foreach (allBrand() as $item)
                                <div class="form-check">
                                    <input name="brand" class="form-check-input" type="checkbox"
                                        value="{{ $item->slug }}" id="{{ $item->slug }}"
                                        {{ in_array($item->slug, explode('.', request()->get('brand'))) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="{{ $item->slug }}">
                                        {{ $item->name ?? '-' }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="single-widget condition">
                            <h3>
                                {{ __('Filter by Category') }}
                            </h3>
                            @foreach (allCategory() as $item)
                                <div class="form-check">
                                    <input name="category" class="form-check-input" type="checkbox"
                                        value="{{ $item->slug }}" id="{{ $item->slug }}"
                                        {{ in_array($item->slug, explode('.', request()->get('category'))) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="{{ $item->slug }}">
                                        {{ $item->name ?? '-' }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                        <label for="sorting">Sort by:</label>
                                        <select name="sort" class="form-control" id="sorting">
                                            <option value="new" {{ request()->get('sort') == 'new' ? 'selected' : '' }}>
                                                Newest
                                            </option>
                                            <option value="asc_price"
                                                {{ request()->get('sort') == 'asc_price' ? 'selected' : '' }}>
                                                Low - High Price
                                            </option>
                                            <option value="desc_price"
                                                {{ request()->get('sort') == 'desc_price' ? 'selected' : '' }}>
                                                High - Low Price
                                            </option>
                                            <option value="asc_name"
                                                {{ request()->get('sort') == 'asc_name' ? 'selected' : '' }}>
                                                A - Z Order
                                            </option>
                                            <option value="desc_name"
                                                {{ request()->get('sort') == 'desc_name' ? 'selected' : '' }}>
                                                Z - A Order
                                            </option>
                                        </select>
                                        <h3 class="total-show-product">
                                            {{ __('Showing:') }}
                                            <span>
                                                {{ ($products->currentpage() - 1) * $products->perpage() + 1 }} to
                                                {{ $products->currentpage() * $products->perpage() }}
                                                of {{ $products->total() }} entries
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i
                                                    class="lni lni-grid-alt"></i></button>
                                            <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-list" type="button" role="tab"
                                                aria-controls="nav-list" aria-selected="false"><i
                                                    class="lni lni-list"></i></button>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row flex-wrap">
                                    @forelse ($products as $product)
                                        <div class="col-lg-4 col-md-6 col-12 d-flex">
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
                                                        <a href="{{ route('product.show', $product->slug) }}"
                                                            class="btn">
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="pagination left">
                                            {{ $products->links('website.product.pagination') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                                <div class="row">
                                    @forelse ($products as $product)
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="single-product">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="product-image">
                                                            <img src="{{ route('file.show', [
                                                                'file_path' => 'product',
                                                                'file_name' => $product->image_1 ?? '_blank.jpg',
                                                            ]) }}"
                                                                alt="img" style="height: 200px; border-radius: 6%;">
                                                            @if ($product->discount > 0)
                                                                <span
                                                                    class="sale-tag">-{{ $product->discount ?? 0 }}%</span>
                                                            @endif
                                                            <div class="button">
                                                                <a href="{{ route('product.show', $product->slug) }}"
                                                                    class="btn">
                                                                    <i class="lni lni-cart"></i>
                                                                    {{ __(' Add to Cart') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-12">
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="pagination left">
                                            {{ $products->links('website.product.pagination') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('') }}assets/js/jquery-query-object.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '[name="brand"]', function() {
                let urlProduct = $('.current_url').data('url');
                let brandsChecked = $('[name="brand"]:checked').map(function() {
                    return $(this).val();
                }).get();
                let brandsValue = brandsChecked.join(".");
                let brandsParam = $.query.set("brand", brandsValue).toString();
                window.location.replace(urlProduct + brandsParam);
            });
            $(document).on('change', '[name="category"]', function() {
                let urlProduct = $('.current_url').data('url');
                let categoriesChecked = $('[name="category"]:checked').map(function() {
                    return $(this).val();
                }).get();
                let categoriesValue = categoriesChecked.join(".");
                let categoriesParam = $.query.set("category", categoriesValue).toString();
                window.location.replace(urlProduct + categoriesParam);
            });
            $(document).on('change', '[name="sort"]', function() {
                let urlProduct = $('.current_url').data('url');
                let sortValue = $(this).val();
                let sortParam = $.query.set("sort", sortValue).toString();
                window.location.replace(urlProduct + sortParam);
            });
        });
    </script>
@endpush
