@extends('layouts.admin.main')

@section('title', __('Laporan'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Data') }}
                    </div>
                    <h2 class="page-title" data-url="{{ route('admin.report.index') }}">
                        {{ __('Laporan') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <form action="#" class="d-flex gap-3 align-items-end form_report" method="GET">
                        <div class="mb-3">
                            <label class="form-label" for="start_date">
                                {{ __('Tanggal Awal') }}
                            </label>
                            <input name="start_date" type="date" class="form-control" id="start_date" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="end_date">
                                {{ __('Tanggal Akhir') }}
                            </label>
                            <input name="end_date" type="date" class="form-control" id="end_date" />
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('admin.report.filter') }}" class="btn btn-primary filter_order">
                                {{ __('Filter') }}
                            </a>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('admin.report.pdf-report-order') }}" class="btn btn-success report_order">
                                {{ __('Cetak PDF') }}
                            </a>
                        </div>
                    </form>
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
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @include('admin.report.data')
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
            $(document).on('click', '.filter_order', function(event) {
                event.preventDefault();
                let start_date = $('[name="start_date"]').val();
                let end_date = $('[name="end_date"]').val();
                $.get($(this).attr('href'), {
                    start_date: start_date,
                    end_date: end_date,
                }, function(data, status) {
                    $('.table-tbody').html(data);
                });
            });
            $(document).on('click', '.report_order', function(event) {
                event.preventDefault();
                let url = $(this).attr('href');
                $('.form_report').attr('action', url).submit();
            });
        });
    </script>
@endpush
