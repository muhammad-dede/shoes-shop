@extends('layouts.admin.main')

@section('title', __('Ubah Brand'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Ubah') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Brand') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.master.brand.update', $brand) }}" class="card" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="name">
                                {{ __('Nama') }}
                            </label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Input nama" value="{{ $brand->name ?? old('name') }}" />
                            @error('name')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="image">
                                {{ __('Image') }}
                            </label>
                            <input name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                id="image" />
                            <small class="text-muted">
                                {{ __('Max: 1Mb | Ext: jpg,png') }}
                                |
                                <a href="{{ route('file.show', [
                                    'file_path' => 'brand',
                                    'file_name' => $brand->image ?? 'blank.jpg',
                                ]) }}"
                                    target="_blank">Lihat</a>
                            </small>
                            @error('image')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.master.brand.index') }}" class="btn btn-secondary">
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
