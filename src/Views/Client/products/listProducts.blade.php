@extends('layouts.client')
@section('title')
    Sản phẩm
@endsection
@section('css')
    <link href="{{ asset('assets/Client/css/listing.css') }}" rel="stylesheet">
    <style>
        .btn-no-border-bg {
            border: none;
            /* Loại bỏ viền */
            height: 2vw;
            cursor: pointer;
            /* Đổi con trỏ thành con trỏ chuột */
        }

        .btn-no-border-bg:hover {
            background-color: blue;
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="top_banner">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
            <div class="container">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('') }}">Trang chủ</a></li>
                        <li><a href="#">Danh mục</a></li>
                        <li>Danh sách sản phẩm</li>
                    </ul>
                </div>
                <h1>Shoes - Grid listing</h1>
            </div>
        </div>
        <img src="{{ asset('assets/Client/img/banner1.jpg') }}" class="img-fluid" alt="">
    </div>
    <!-- /end banner trên -->
    <!-- sắp xếp -->
    <div id="stick_here"></div>
    <div class="toolbox elemento_stick">
        <div class="container">
            <ul class="clearfix">
                <li>
                    <div class="sort_select">
                        <select name="sort" id="sort">
                            <option value="popularity" selected="selected">Phổ biến nhất</option>
                            <option value="date">Mới nhất</option>
                            <option value="price">Giá thấp đến cao</option>
                            <option value="price-desc">Giá cao đến thấp
                        </select>
                    </div>
                </li>
                <li>
                    <a href="#"><i class="ti-view-grid"></i></a>
                    <a href="#"><i class="ti-view-list"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="collapse" href="#filters" role="button" aria-expanded="false"
                        aria-controls="filters">
                        <i class="ti-filter"></i><span>Bộ lọc</span>
                    </a>
                </li>
            </ul>
            <div class="collapse" id="filters">
                <div class="row small-gutters filters_listing_1">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="drop">Loại sản phẩm</a>
                            <div class="dropdown-menu">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label class="container_check">Men <small>12</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a href="#0" class="apply_filter">Áp dụng</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="drop">Màu sắc</a>
                            <div class="dropdown-menu">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label class="container_check">Blue <small>06</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a href="#0" class="apply_filter">Áp dụng</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="drop">Thương hiệu</a>
                            <div class="dropdown-menu">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label class="container_check">Adidas <small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a href="#0" class="apply_filter">Áp dụng</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="drop">Giá</a>
                            <div class="dropdown-menu">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label class="container_check">$0 — $50<small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a href="#0" class="apply_filter">Áp dụng</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown -->
                        <!-- end sắp xếp -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /toolbox -->
    <!-- sản phẩm ---------------------------------------->
    <div class="container margin_30">
        <div class="row small-gutters">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="grid_item">
                        <figure>
                            <a href="{{ url('products-detail/') . $product['id'] }}">
                                <img class="img-fluid lazy" style="height: 250px;"
                                    src="{{ url($product['img_thumbnail']) }}" alt="">
                            </a>
                            <div data-countdown="2019/05/15" class="countdown"></div>
                        </figure>
                        <a href="{{ url('products-detail/') . $product['id'] }}">
                            <h3>{{ $product['name'] }}</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">{{ number_format($product['price_sale'] ?? 0) }}VND</span>
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
            <!-- /end sản phẩm ---------------------- -->

            <div class="pagination__wrapper">
                <ul class="pagination">
                    @if ($page > 1)
                        <li><a href="{{ url('products?page=' . ($page - 1 == 0 ? 1 : $page - 1)) }}" class="prev"
                                title="previous page">&#10094;</a></li>
                    @endif
                    @for ($i = 1; $i <= $totalPage; $i++)
                        <li>
                            <a href="{{ url('products?page=' . $i) }}"
                                class="{{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                        </li>
                    @endfor
                    @if ($page < $totalPage)
                        <li><a href="{{ url('products?page=' . ($page + 1 > $totalPage ? $totalPage : $page + 1)) }}"
                                class="next" title="next page">&#10095;</a></li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('assets/Client/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ url('assets/Client/js/specific_listing.js') }}"></script>
@endsection
