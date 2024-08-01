<header class="header navbar-area">
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="top-left">
                        <ul class="menu-top-link">
                            <li>
                                <a href="#" class="text-white">
                                    <i class="lni lni-facebook-filled"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white">
                                    <i class="lni lni-twitter-original"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white">
                                    <i class="lni lni-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="top-end">
                        <ul class="user-login">
                            @guest
                                <li>
                                    <a href="{{ route('login') }}">
                                        {{ __('Masuk') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">
                                        {{ __('Daftar') }}
                                    </a>
                                </li>
                            @endguest
                            @auth
                                <li>
                                    {{ __('Halo') }}, {{ auth()->user()->name ?? 'User' }}
                                </li>
                            @endauth
                            @can('auth-user')
                                <li>
                                    <a href="{{ route('order.index') }}">
                                        {{ __('Pesanan') }}
                                    </a>
                                </li>
                            @endcan
                            @can('auth-admin')
                                <li>
                                    <a href="{{ route('admin.home') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                </li>
                            @endcan
                            @auth
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-7">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('') }}logo.png" alt="Logo" style="width: 35px; height: 40px;">
                        <span class="text-dark fw-bold me-3">Daffa Sport</span>
                    </a>
                </div>
                <div class="col-lg-5 col-md-7 d-xs-none">
                </div>
                <div class="col-lg-4 col-md-2 col-5 justify-content-end">
                    <div class="middle-right-area">
                        <div class="nav-hotline"></div>
                        <div class="navbar-cart">
                            <div class="wishlist">
                                <a href="{{ route('wishlist.index') }}">
                                    <i class="lni lni-heart"></i>
                                    @auth
                                        @if (auth()->user()->wishlist->count() > 0)
                                            <span class="total-items">{{ auth()->user()->wishlist->count() ?? 0 }}</span>
                                        @endif
                                    @endauth
                                </a>
                            </div>
                            <div class="cart-items">
                                <a href="{{ route('cart.index') }}" class="main-btn">
                                    <i class="lni lni-cart"></i>
                                    @auth
                                        @if (auth()->user()->cart->count() > 0)
                                            <span class="total-items">{{ auth()->user()->cart->count() ?? 0 }}</span>
                                        @endif
                                    @endauth
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-6 col-12">
                <div class="nav-inner">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="{{ route('home') }}"
                                        class="{{ request()->routeIs('home') ? 'active' : '' }}"
                                        aria-label="Toggle navigation">
                                        {{ __('Home') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('product.index') }}"
                                        class="{{ request()->routeIs('product.*') ? 'active' : '' }}"
                                        aria-label="Toggle navigation">
                                        {{ __('Belanja') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}"
                                        class="{{ request()->routeIs('contact') ? 'active' : '' }}"
                                        aria-label="Toggle navigation">
                                        {{ __('Kontak') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
