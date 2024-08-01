@extends('layouts.website.main')

@section('title', __('Daftar Akun'))

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('Daftar') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li>
                            <a href="{{ route('home') }}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li>{{ __('Daftar') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>{{ __('Daftar Akun') }}</h3>
                            <p>{{ __('Registrasi memakan waktu kurang dari satu menit tetapi memberi Anda kendali penuh atas pesanan Anda.') }}
                            </p>
                        </div>
                        <form action="{{ route('register') }}" class="row" method="post">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">{{ __('Nama') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus />
                                    @error('name')
                                        <small class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" />
                                    @error('email')
                                        <small class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="password" />
                                    @error('password')
                                        <small class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Konfirmasi Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="confirm-password">
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">{{ __('Daftar') }}</button>
                            </div>
                            <p class="outer-link">
                                {{ __('Sudah punya akun?') }}
                                <a href="{{ route('login') }}">
                                    {{ __('Masuk') }}
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
