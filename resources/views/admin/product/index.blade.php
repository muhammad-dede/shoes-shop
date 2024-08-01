@extends('layouts.admin.main')

@section('title', __('Produk'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Data') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Produk') }}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            {{ __('Tambah') }}
                        </a>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary d-sm-none btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">No</th>
                                    <th style="width: 10%;">{{ __('Image') }}</th>
                                    <th>{{ __('Nama') }}</th>
                                    <th>{{ __('Harga') }}</th>
                                    <th class="text-start">{{ __('Disc') }}</th>
                                    <th class="text-start">{{ __('Stok') }}</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ route('file.show', ['file_path' => 'product', 'file_name' => $item->image_1 ?? '_blank.jpg']) }}"
                                                alt="img" class="img-fluid rounded w-50 h-50" />
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $item->name ?? '-' }}</span>
                                            <p class="mb-0">
                                                <small>{{ $item->brand->name ?? '-' }}</small>
                                                -
                                                <small>{{ $item->category->name ?? '-' }}</small>
                                            </p>
                                        </td>
                                        <td>
                                            Rp.&nbsp;{{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="text-start">
                                            {{ $item->discount ?? '-' }}%
                                        </td>
                                        <td class="text-start">
                                            {{ $item->productVariant->sum('qty') }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="{{ route('admin.product.edit', $item) }}" class="text-secondary">
                                                    {{ __('Ubah') }}
                                                </a>
                                                <a href="{{ route('admin.product.show', $item) }}" class="text-info">
                                                    {{ __('Detail') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            let table = $('#dataTable').DataTable({
                responsive: true,
            });
        });
    </script>
@endpush
