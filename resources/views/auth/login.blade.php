@extends('layouts.website.main')

@section('title', __('Masuk'))

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('Masuk') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li>
                            <a href="{{ route('home') }}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li>{{ __('Masuk') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form action="{{ route('login') }}" class="card login-form" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>{{ __('Masuk Sekarang') }}</h3>
                                <p>{{ __('Anda dapat masuk menggunakan alamat email Anda.') }}</p>
                            </div>
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
                            <div class="form-group input-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input name="password" class="form-control @error('password') is-invalid @enderror"
                                    type="password" id="password" autocomplete="password" />
                                @error('password')
                                    <small class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input name="remember" type="checkbox" class="form-check-input width-auto"
                                        id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="remember">{{ __('Ingat saya') }}</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="lost-pass" href="{{ route('password.request') }}">
                                        {{ __('Lupa Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">{{ __('Masuk') }}</button>
                            </div>
                            <p class="outer-link">
                                {{ __('Belum punya akun?') }}
                                <a href="{{ route('register') }}">
                                    {{ __('Daftar disini') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
