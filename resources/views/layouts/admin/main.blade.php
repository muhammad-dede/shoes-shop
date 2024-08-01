<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @hasSection('title')
        <title>@yield('title')&nbsp;-&nbsp;{{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}logo.png" />
    <!-- CSS files -->
    <link href="{{ asset('') }}templates/dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}templates/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}templates/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}templates/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}templates/dist/css/demo.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}templates/dist/css/font.css" rel="stylesheet" />
    <link href="{{ asset('') }}templates/dist/libs/dataTables/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="{{ asset('') }}templates/dist/libs/toastr/toastr.min.css" rel="stylesheet" />
    <link href="{{ asset('templates/dist/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('templates/dist/libs/select2/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('templates/dist/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    @stack('css')
</head>

<body>
    <script src="{{ asset('') }}templates/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
        <!-- Navbar -->
        @include('layouts.admin.navbar')
        <div class="page-wrapper">
            @yield('content')
            @include('layouts.admin.footer')
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('') }}templates/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}templates/dist/js/demo.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}templates/dist/libs/jquery/jquery.js"></script>
    <script src="{{ asset('') }}templates/dist/libs/dataTables/dataTables.js"></script>
    <script src="{{ asset('') }}templates/dist/libs/dataTables/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('') }}templates/dist/libs/toastr/toastr.min.js"></script>
    <script src="{{ asset('') }}templates/dist/libs/select2/select2.full.min.js"></script>
    <script src="{{ asset('') }}templates/dist/libs/sweetalert2/sweetalert2.all.min.js"></script>
    @stack('js')
    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}")
        </script>
    @endif
</body>

</html>
