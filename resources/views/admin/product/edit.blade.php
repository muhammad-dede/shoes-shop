@extends('layouts.admin.main')

@section('title', __('Ubah Produk'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Ubah') }}
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
            <form action="{{ route('admin.product.update', $product) }}" class="card" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h2>
                                {{ __('Informasi Produk') }}
                            </h2>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="name">
                                {{ __('Nama') }}
                            </label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Input nama" value="{{ old('name') ?? $product->name }}" />
                            @error('name')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="id_brand">
                                {{ __('Brand') }}
                            </label>
                            <select name="id_brand" class="form-select select2 @error('id_brand') is-invalid @enderror"
                                id="id_brand" data-placeholder="Pilih Brand">
                                <option></option>
                                @foreach (allBrand() as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('id_brand') ?? $product->id_brand) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_brand')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="id_category">
                                {{ __('Kategori') }}
                            </label>
                            <select name="id_category"
                                class="form-select select2 @error('id_category') is-invalid @enderror" id="id_category"
                                data-placeholder="Pilih Kategori">
                                <option></option>
                                @foreach (allCategory() as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('id_category') ?? $product->id_category) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_category')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="description">
                                {{ __('Deskripsi') }}
                            </label>
                            <textarea name="description" id="description" class="form-control tinymce @error('name') is-invalid @enderror">{{ old('description') ?? $product->description }}</textarea>
                            @error('description')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="image_1">
                                {{ __('Image Utama') }}
                            </label>
                            <input name="image_1" type="file" class="form-control @error('image_1') is-invalid @enderror"
                                id="image_1" />
                            <small class="text-muted">
                                {{ __('Max: 1Mb | Ext: jpg,png') }}
                                @if ($product->image_1)
                                    |
                                    <a href="{{ route('file.show', [
                                        'file_path' => 'product',
                                        'file_name' => $product->image_1 ?? '_blank.jpg',
                                    ]) }}"
                                        target="_blank">Lihat</a>
                                @endif
                            </small>
                            @error('image_1')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="image_2">
                                {{ __('Image') }}
                            </label>
                            <input name="image_2" type="file" class="form-control @error('image_2') is-invalid @enderror"
                                id="image_2" />
                            <small class="text-muted">
                                {{ __('Max: 1Mb | Ext: jpg,png') }}
                                @if ($product->image_2)
                                    |
                                    <a href="{{ route('file.show', [
                                        'file_path' => 'product',
                                        'file_name' => $product->image_2 ?? '_blank.jpg',
                                    ]) }}"
                                        target="_blank">Lihat</a>
                                @endif
                            </small>
                            @error('image_2')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="image_3">
                                {{ __('Image') }}
                            </label>
                            <input name="image_3" type="file" class="form-control @error('image_3') is-invalid @enderror"
                                id="image_3" />
                            <small class="text-muted">
                                {{ __('Max: 1Mb | Ext: jpg,png') }}
                                @if ($product->image_3)
                                    |
                                    <a href="{{ route('file.show', [
                                        'file_path' => 'product',
                                        'file_name' => $product->image_3 ?? '_blank.jpg',
                                    ]) }}"
                                        target="_blank">Lihat</a>
                                @endif
                            </small>
                            @error('image_3')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="weight">
                                {{ __('Berat Produk') }}
                            </label>
                            <div class="input-group">
                                <input name="weight" type="number"
                                    class="form-control @error('weight') is-invalid @enderror" id="weight"
                                    placeholder="Input berat produk" value="{{ old('weight') ?? $product->weight }}" />
                                <span class="input-group-text">
                                    gram
                                </span>
                            </div>
                            @error('weight')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="price">
                                {{ __('Harga Produk') }}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    Rp.
                                </span>
                                <input name="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    placeholder="Input harga produk" value="{{ old('price') ?? $product->price }}" />
                            </div>
                            @error('price')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="discount">
                                {{ __('Diskon') }}
                            </label>
                            <div class="input-group">
                                <input name="discount" type="number"
                                    class="form-control @error('discount') is-invalid @enderror" id="discount"
                                    placeholder="Input diskon" value="{{ old('discount') ?? $product->discount }}" />
                                <span class="input-group-text">
                                    %
                                </span>
                            </div>
                            @error('discount')
                                <small class="text-danger text-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <h2>
                                {{ __('Variasi Produk') }}
                            </h2>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-success add_product_variant mb-2">
                                {{ __('Tambah Variasi') }}
                            </button>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Size') }}</th>
                                        <th>{{ __('Qty') }}</th>
                                        <th style="width: 1%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (old('product_variant'))
                                        @foreach (old('product_variant') as $key => $item)
                                            <tr class="product_variant">
                                                <td>
                                                    <input type="hidden" name="product_variant[{{ $key }}][id]"
                                                        value="{{ $item['id'] }}" />
                                                    <input name="product_variant[{{ $key }}][size]"
                                                        type="number" class="form-control"
                                                        value="{{ $item['size'] }}" />
                                                    @if ($errors->has('product_variant.' . $key . '.size'))
                                                        <small class="text-danger text-error">
                                                            {{ $errors->first('product_variant.' . $key . '.size') }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input name="product_variant[{{ $key }}][qty]"
                                                        type="number" class="form-control"
                                                        value="{{ $item['qty'] }}" />
                                                    @if ($errors->has('product_variant.' . $key . '.qty'))
                                                        <small class="text-danger text-error">
                                                            {{ $errors->first('product_variant.' . $key . '.qty') }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-danger delete_product_variant {{ $key == 0 ? 'd-none' : '' }}">
                                                        {{ __('Hapus') }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @if ($product->productVariant)
                                            @foreach ($product->productVariant as $key => $item)
                                                <tr class="product_variant">
                                                    <td>
                                                        <input type="hidden"
                                                            name="product_variant[{{ $key }}][id]"
                                                            value="{{ $item->id }}" />
                                                        <input name="product_variant[{{ $key }}][size]"
                                                            type="number" class="form-control"
                                                            value="{{ $item->size ?? 0 }}" />
                                                    </td>
                                                    <td>
                                                        <input name="product_variant[{{ $key }}][qty]"
                                                            type="number" class="form-control"
                                                            value="{{ $item->qty ?? 0 }}" />
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-danger delete_product_variant {{ $key == 0 ? 'd-none' : '' }}">
                                                            {{ __('Hapus') }}
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="product_variant">
                                                <td>
                                                    <input type="hidden" name="product_variant[0][id]" value="" />
                                                    <input name="product_variant[0][size]" type="number"
                                                        class="form-control" value="0" />
                                                </td>
                                                <td>
                                                    <input name="product_variant[0][qty]" type="number"
                                                        class="form-control" value="0" />
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-danger delete_product_variant d-none">
                                                        {{ __('Hapus') }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                        {{ __('Kembali') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Simpan') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('') }}templates/dist/libs/tinymce/tinymce.min.js?1692870487" defer></script>
    <script>
        $(".select2").select2({
            theme: "bootstrap-5",
        });
        document.addEventListener("DOMContentLoaded", function() {
            let options = {
                selector: '.tinymce',
                menubar: false,
                statusbar: false,
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
            }
            if (localStorage.getItem("tablerTheme") === 'dark') {
                options.skin = 'oxide-dark';
                options.content_css = 'dark';
            }
            tinyMCE.init(options);
        })
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.add_product_variant', function(event) {
                event.preventDefault();
                let index = $(document).find('.product_variant').length;
                cloneProductVariant(index).insertAfter('.product_variant:last');
            });

            $(document).on('click', '.delete_product_variant', function(event) {
                event.preventDefault();
                $(this).closest('.product_variant').remove();
            });

            function cloneProductVariant(index) {
                let clone = $('.product_variant:first').clone();
                clone.find('.delete_product_variant').removeClass('d-none');
                clone.find('[name="product_variant[0][id]"]').attr('name', 'product_variant[' + index +
                        '][id]')
                    .val('');
                clone.find('[name="product_variant[0][size]"]').attr('name', 'product_variant[' + index +
                        '][size]')
                    .val('');
                clone.find('[name="product_variant[0][qty]"]').attr('name', 'product_variant[' + index +
                        '][qty]')
                    .val('');
                clone.find('.text-error').remove();
                return clone;
            }
        });
    </script>
@endpush
