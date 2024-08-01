@extends('layouts.admin.main')

@section('title', __('Pesanan'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Data') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Pesanan') }}
                    </h2>
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
                                    <th style="width: 10%;">{{ __('No. Pesanan') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th>{{ __('Tanggal Order') }}</th>
                                    <th>{{ __('Sub Total') }}</th>
                                    <th>{{ __('Diskon') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_order ?? '-' }}</td>
                                        <td>{{ $item->user?->name ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at ?? '-')->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td>Rp.&nbsp;{{ number_format($item->total_price ?? '0', 0, ',', '.') }}</td>
                                        <td>Rp.&nbsp;{{ number_format($item->discount_amount ?? '0', 0, ',', '.') }}</td>
                                        <td>Rp.&nbsp;{{ number_format($item->payment_amount ?? '0', 0, ',', '.') }}</td>
                                        <td>
                                            <span class="text-{{ getColorStatus($item->id_status) }}">
                                                {{ $item->status->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="{{ route('admin.order.show', $item) }}" class="text-info">
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
