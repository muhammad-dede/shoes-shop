@extends('layouts.admin.main')

@section('title', __('Detail Produk'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Detail') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Produk') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h2>
                                {{ __('Informasi Produk') }}
                            </h2>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                {{ __('Image') }}
                            </label>
                            <div class="row row-cols-6 g-3">
                                <div class="col">
                                    <a data-fslightbox="gallery"
                                        href="{{ route('file.show', [
                                            'file_path' => 'product',
                                            'file_name' => $product->image_1,
                                        ]) }}">
                                        <div class="img-responsive img-responsive-1x1 rounded border"
                                            style="background-image: url({{ route('file.show', [
                                                'file_path' => 'product',
                                                'file_name' => $product->image_1,
                                            ]) }})">
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a data-fslightbox="gallery"
                                        href="{{ route('file.show', [
                                            'file_path' => 'product',
                                            'file_name' => $product->image_2,
                                        ]) }}">
                                        <div class="img-responsive img-responsive-1x1 rounded border"
                                            style="background-image: url({{ route('file.show', [
                                                'file_path' => 'product',
                                                'file_name' => $product->image_2,
                                            ]) }})">
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a data-fslightbox="gallery"
                                        href="{{ route('file.show', [
                                            'file_path' => 'product',
                                            'file_name' => $product->image_3,
                                        ]) }}">
                                        <div class="img-responsive img-responsive-1x1 rounded border"
                                            style="background-image: url({{ route('file.show', [
                                                'file_path' => 'product',
                                                'file_name' => $product->image_3,
                                            ]) }})">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                {{ __('Nama') }}
                            </label>
                            <div class="form-control-plaintext">
                                {{ $product->name ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                {{ __('Brand') }}
                            </label>
                            <div class="form-control-plaintext">
                                {{ $product->brand->name ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                {{ __('Kategori') }}
                            </label>
                            <div class="form-control-plaintext">
                                {{ $product->category->name ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                {{ __('Deskripsi') }}
                            </label>
                            <div class="form-control-plaintext">
                                {!! $product->description ?? '' !!}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                {{ __('Berat Product') }}
                            </label>
                            <div class="form-control-plaintext">
                                {!! $product->weight ?? '0' !!} gram
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                {{ __('Harga Product') }}
                            </label>
                            <div class="form-control-plaintext">
                                Rp. {!! $product->price ?? '0' !!}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                {{ __('Diskon') }}
                            </label>
                            <div class="form-control-plaintext">
                                {!! $product->discount ?? '0' !!} %
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <h2>
                                {{ __('Variasi Produk') }}
                            </h2>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Size') }}</th>
                                        <th>{{ __('Qty') }}</th>
                                        <th style="width: 1%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->productVariant as $item)
                                        <tr>
                                            <td>{{ $item->size }}</td>
                                            <td>{{ $item->qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                        {{ __('Kembali') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('') }}templates/dist/libs/fslightbox/index.js?1692870487" defer></script>
@endpush
