@extends('layouts.client')
@section('title')
    Trang chủ
@endsection
@section('css')
    <link href="{{ asset('assets/Client/css/home_1.css') }}" rel="stylesheet">
    <style>
        .btn-no-border-bg {
            border: none;
            /* Loại bỏ viền */
            height: 2vw;
            cursor: pointer;
            /* Đổi con trỏ thành con trỏ chuột */
        }
        .btn-no-border-bg:hover{
            background-color: blue;
            color: white;
        }
    </style>
@endsection
@section('content')
    <div id="carousel-home-2">
        <div class="owl-carousel owl-theme">
            @foreach ($products as $key => $product)
                <div class="owl-slide cover" style="background-image:url({{ asset($product['img_thumbnail']) }});">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-12 static">
                                    <div class="slide-text text-center white">
                                        <h2 class="owl-slide-animated owl-slide-title">Sản phẩm<br>Nổi bật</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            Giá tốt nhất cho bạn
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                                href="listing-grid-1-full.html" role="button">Shop Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($key == 4)
                    @php
                        break;
                    @endphp
                @endif
            @endforeach
        </div>
        <div id="icon_drag_mobile"></div>
    </div>
    <!--/carousel-->

    <!-- phẩn freeship -->
    <div class="feat">
        <div class="container">
            <ul>
                <li>
                    <div class="box">
                        <i class="ti-gift"></i>
                        <div class="justify-content-center">
                            <h3>Free Shipping</h3>
                            <p>For all oders over $99</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-wallet"></i>
                        <div class="justify-content-center">
                            <h3>Secure Payment</h3>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-headphone-alt"></i>
                        <div class="justify-content-center">
                            <h3>24/7 Support</h3>
                            <p>Online top support</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--/feat-->


    <!-- /container -->
    <!-- đoạn mã sản phẩm bán chạy -->
    <hr class="mb-0">
    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Sản phẩm</h2>
            <span></span>
            <p>Sản phẩm bán chạy nhất mọi thời đại</p>
        </div>
        <div class="row small-gutters">
            @foreach ($products as $key => $product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="grid_item">
                        <figure>
                            <a href="{{ url('products-detail/') . $product['id'] }}">
                                <img style="height: 250px;" class="img-fluid lazy"
                                    src="{{ asset($product['img_thumbnail']) }}" alt="">
                            </a>
                            <div data-countdown="2019/05/15" class="countdown"></div>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="{{ url('products-detail/') . $product['id'] }}">
                            <h3>{{ $product['name'] }}</h3>
                        </a>
                        <div class="price_box">
                            <span
                                class="new_price">{{ number_format($product['price_sale'] ?? $product['price_regular']) }}VND</span>
                            <span class="old_price">{{ number_format($product['price_regular'] ?? 0) }}VND</span>
                        </div>
                        <ul>
                            <form action="{{ url('cart?index') }}" method="POST">
                                <input type="hidden" name="productID" value="{{ $product['id'] }}">
                                <li><button type="submit" class="btn-no-border-bg tooltip-1" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to cart"><i
                                                class="ti-shopping-cart"></i></button>
                                </li>
                            </form>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            @endforeach
        </div>
        <!-- /row -->
    </div>
    <!-- /end sản phẩm top sell -->
    <!-- /container -->


    <!-- phẩn sản phẩm sau top sell -->
    <div class="featured lazy" data-bg="url({{ asset('assets/Client/img/banner1.jpg') }})">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <div class="container margin_60">
                <div class="row justify-content-center justify-content-md-start">
                    <div class="col-lg-6 wow" data-wow-offset="150">
                        <h3>Armor<br>Air Color 720</h3>
                        <p>Lightweight cushioning and durable support with a Phylon midsole</p>
                        <div class="feat_text_block">
                            <div class="price_box">
                                <span class="new_price">120.000 VND</span>
                                <span class="old_price">170.000 VND</span>
                            </div>
                            <a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /featured -->


    <!-- phẩn sản phẩm mới -->
    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Sản phẩm mới</h2>
            <span>Products</span>
            <p></p>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            @foreach ($products as $product)
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="{{ url('products-detail/') . $product['id'] }}">
                                <img class="owl-lazy" style ="height:250px;" src="{{ asset($product['img_thumbnail']) }}"
                                    data-src="{{ asset($product['img_thumbnail']) }}" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i>
                        </div>
                        <a href="{{ url('products-detail/') . $product['id'] }}">
                            <h3>{{ $product['name'] }}</h3>
                        </a>
                        <div class="price_box">
                            <span
                                class="new_price">{{ number_format($product['price_sale'] ?? $product['price_regular']) }}VND</span>
                            <span class="old_price">{{ number_format($product['price_regular'] ?? 0) }}VND</span>
                        </div>
                        <ul>
                            <form action="{{ url('cart') }}" method="POST">
                                <input type="hidden" name="productID" value="{{ $product['id'] }}">
                                <input type="hidden" name="index" value="1">
                                <li><button type="submit" class="btn-no-border-bg tooltip-1" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Add to cart"><i
                                                class="ti-shopping-cart"></i></button>
                                </li>
                            </form>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            @endforeach
        </div>
        <!-- /products_carousel -->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/Client/js/carousel-home-2.js') }}"></script>
@endsection
