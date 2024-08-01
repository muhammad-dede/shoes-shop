<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="bottom-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer f-contact">
                            <h3>{{ __('Get In Touch With Us') }}</h3>
                            <p class="phone">Phone: +62 812 9570 5672</p>
                            <ul>
                                <li><span>{{ __('Monday-Friday') }}: </span> 9.00 am - 8.00 pm</li>
                                <li><span>{{ __('Saturday') }}: </span> 10.00 am - 6.00 pm</li>
                            </ul>
                            <p class="mail">
                                <a href="mailto:support@daffasport.com">support@daffasport.com</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h3>Information</h3>
                            <ul>
                                <li><a href="javascript:void(0)">About Us</a></li>
                                <li><a href="javascript:void(0)">Contact Us</a></li>
                                <li><a href="javascript:void(0)">FAQs Page</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h3>Brand</h3>
                            <ul>
                                @foreach (brandInRandom(5) as $item)
                                    <li><a href="javascript:void(0)">{{ $item->name ?? '-' }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h3>Kategori</h3>
                            <ul>
                                @foreach (categoryInRandom(5) as $item)
                                    <li><a href="javascript:void(0)">{{ $item->name ?? '-' }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="inner-content">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12">
                        <p class="text-white">Copyright &copy; 2024
                            <a href="{{ route('home') }}" rel="nofollow" target="_blank" class="text-white">
                                {{ config('app.name') }}
                            </a>
                        </p>
                    </div>
                    <div class="col-lg-6 col-12">
                        <ul class="socila">
                            <li>
                                <span>{{ __('Follow Us On') }}:</span>
                            </li>
                            <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
