@extends('layouts.admin.main')

@section('title', __('Tambah Kategori'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Tambah') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Kategori') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('admin.master.category.store') }}" class="card" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="name">
                                {{ __('Nama') }}
                            </label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Input nama" value="{{ old('name') }}" />
                            @error('name')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.master.category.index') }}" class="btn btn-secondary">
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
