@extends('layouts.website.main')

@section('title', __('Lupa Password'))

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('Lupa Password') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li>
                            <a href="{{ route('home') }}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li>{{ __('Lupa Password') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form action="{{ route('password.email') }}" class="card login-form" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>{{ __('Lupa Password') }}</h3>
                                <p>{{ __('Masukan email untuk mengatur ulang password Anda') }}</p>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus />
                                @error('email')
                                    <small class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">
                                    {{ __('Kirim Link Atur Ulang Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
