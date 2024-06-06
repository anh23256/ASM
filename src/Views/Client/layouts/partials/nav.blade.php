<div class="layer"></div><!-- Mobile menu overlay mask -->
<div class="main_header">
    <div class="container">
        <div class="row small-gutters">
            <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                <div id="logo">
                    <a href="index.html"><img src="{{asset('assets/Client/img/logo.svg')}}" alt="" width="100" height="35"></a>
                </div>
            </div>
            <nav class="col-xl-6 col-lg-7">
                <a class="open_close" href="javascript:void(0);">
                    <div class="hamburger hamburger--spin">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <!-- Menu -->
                <div class="main-menu">
                    <div id="header_menu">
                        <a href="index.html"><img src="{{asset('assets/Client/img/logo_black.svg')}}" alt="" width="100" height="35"></a>
                        <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                    </div>
                    <ul>
                        <li>
                            <a href="{{url('')}}">Trang chủ</a>
                        </li>

                        <li>
                            <a href="{{url('products')}}">Sản phẩm</a>
                        </li>
                        <li><a href="{{url('')}}">Giới thiệu</a></li>
                        <li><a href="{{url('')}}">Tạo tài khoản</a></li>
                        <li><a href="{{url('')}}">Trợ giúp</a></li>
                    </ul>
                </div>
                <!--/main-menu -->
            </nav>
            <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
                <a class="phone_top" href="#"><strong><span>Cần trợ giúp?</span>+84 423-23-221</strong></a>
            </div>
        </div>
        <!-- /row -->
    </div>
</div>
<!-- /main_header -->

<div class="main_nav inner">
    <div class="container">
        <div class="row small-gutters">
            <div class="col-xl-3 col-lg-3 col-md-3">
                <nav class="categories">
                    <ul class="clearfix">
                        <li><span>
                                <a href="#">
                                    <span class="hamburger hamburger--spin">
                                        <span class="hamburger-box">
                                            <span class="hamburger-inner"></span>
                                        </span>
                                    </span>
                                    Danh mục
                                </a>
                            </span>
                            <div id="menu">
                                <ul>
                                    <li>
                                        <a href="{{url('')}}">Trang chủ</a>
                                    </li>

                                    <li>
                                        <a href="{{url('products')}}">Sản phẩm</a>
                                    </li>
                                    <li><a href="{{url('')}}">Giới thiệu</a></li>
                                    <li><a href="{{url('')}}">Tạo tài khoản</a></li>
                                    <li><a href="{{url('')}}">Trợ giúp</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                <div class="custom-search-input">
                    <input type="text" placeholder="Tìm kiếm sản phẩm">
                    <button type="submit"><i class="header-icon_search_custom"></i></button>
                </div>
            </div>
            <!-- end tìm kiếm -->
            <div class="col-xl-3 col-lg-2 col-md-3">
                <ul class="top_tools">
                    <li>
                        <div class="dropdown dropdown-cart">
                            <a href="cart.html" class="cart_bt"><strong>1</strong></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <a href="product-detail-1.html">
                                            <figure><img src="{{asset('assets/Client/img/products/product_placeholder_square_small.jpg')}}" data-src="img/products/shoes/thumb/1.jpg" alt="" width="50" height="50" class="lazy"></figure>
                                            <strong><span>1x Armor Air x Fear</span>$90.00</strong>
                                        </a>
                                        <a href="#0" class="action"><i class="ti-trash"></i></a>
                                    </li>
                                </ul>
                                <div class="total_drop">
                                    <div class="clearfix"><strong>Tổng</strong><span>$200.00</span></div>
                                    <a href="cart.html" class="btn_1 outline">Giỏ hàng</a><a href="checkout.html" class="btn_1">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown-cart-->
                    </li>
                    <li>
                        <a href="#0" class="wishlist"><span>Yêu thích</span></a>
                    </li>
                    <li>
                        <div class="dropdown dropdown-access">
                            <a href="account.html" class="access_link"><span>Tài khoản</span></a>
                            <div class="dropdown-menu">
                                <a href="account.html" class="btn_1">Đăng nhập hoặc đăng ký</a>
                                <ul>
                                    <li>
                                        <a href="account.html"><i class="ti-package"></i>Giỏ hàng của
                                            tôi</a>
                                    </li>
                                    <li>
                                        <a href="account.html"><i class="ti-user"></i>Thông tin tài
                                            khoản</a>
                                    </li>
                                    <li>
                                        <a href="help.html"><i class="ti-help-alt"></i>Trợ giúp và câu hỏi
                                            thường gặp</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /dropdown-access-->
                    </li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /search_mobile -->
</div>
<!-- /main_nav -->