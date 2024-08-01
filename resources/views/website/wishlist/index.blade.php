@extends('layouts.website.main')

@section('title', __('Wishlist'))

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Wishlist</h1>
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
                        <li>{{ __('Wishlist') }}</li>
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
                        <div class="col-lg-10 col-md-9 col-12">
                            <p>{{ __('Produk') }}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                @forelse ($data as $key => $wishlist)
                    <div class="cart-single-list">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a
                                    href="{{ route('product.show', [
                                        'slug' => $wishlist->product->slug ?? '',
                                    ]) }}">
                                    <img src="{{ route('file.show', [
                                        'file_path' => 'product',
                                        'file_name' => $wishlist->product->image_1 ?? '_blank.jpg,',
                                    ]) }}"
                                        alt="img" />
                                </a>
                            </div>
                            <div class="col-lg-10 col-md-9 col-12">
                                <h5 class="product-name">
                                    <a href="{{ route('product.show', $wishlist->product->slug ?? '') }}">
                                        {{ $wishlist->product->name ?? '-' }}
                                    </a>
                                </h5>
                                <p class="product-des">
                                    <span><em>Kategori:</em> {{ $wishlist->product->category->name ?? '-' }}</span>
                                </p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a href="{{ route('wishlist.delete', $wishlist) }}" class="remove-item">
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
                                    <h5 class="mb-3">{{ __('Wishlist kamu kosong') }}</h5>
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
            </div>
        </div>
    </div>
    <form action="" class="form_delete_wishlist" method="POST">
        @csrf
        @method('delete')
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.remove-item', function(event) {
                event.preventDefault();
                let url = $(this).attr('href');
                $('.form_delete_wishlist').attr('action', url).submit();
            });
        });
    </script>
@endpush
