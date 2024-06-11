@extends('layouts.client')
@section('title')
    Thanh toán
@endsection
@section('css')
    <link href="{{ asset('assets/Client/css/checkout.css') }}" rel="stylesheet">
@endsection
@section('content')
    @if (!empty($_SESSION['errors']))
        <div class="container box position-relative">
            <ul class="box position-absolute" style="top: 20px; right: 70px;">
                @foreach ($_SESSION['errors'] as $error)
                    <li class="text-warning">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @php
            unset($_SESSION['errors']);
        @endphp
    @endif
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{ url('') }}">Trang chủ</a></li>
                    <li><a href="#">Danh mục</a></li>
                    <li>Thanh toán</li>
                </ul>
            </div>
            <h1>Xác nhận thanh toán</h1>

        </div>
        <!-- /page_header -->
        <form action="{{ url('orderDetail') }}" method="POST">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="step first">
                        <h3>1. Thông tin người dùng và địa chỉ thanh toán</h3>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        value="{{ $_SESSION['users']['email'] ?? '' }}">
                                </div>
                                <hr>
                                <div class="row no-gutters">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Họ và tên"
                                            value="{{ $_SESSION['users']['name'] ?? '' }}">
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="form-group">
                                    <input type="text" class="form-control" name="adress" placeholder="Địa chỉ">
                                </div>
                                <!-- /row -->
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Điện thoại">
                                </div>
                                <hr>
                            </div>
                            <!-- /tab_1 -->
                        </div>
                    </div>
                    <!-- /step -->
                </div>
                <!-- Thanh toán và vận chuyển------------------------- -->
                <div class="col-lg-4 col-md-6">
                    <div class="step middle payments">
                        <h3>2. Thanh toán và vận chuyển</h3>
                        <ul>
                            <li>
                                <label class="container_radio">Thẻ tín dụng<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment" checked value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Thanh toán khi nhận hàng<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment" value="2">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Thanh toán qua VNPAY<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment" value="3">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                        <div class="payment_info d-none d-sm-block">
                            <figure><img src="img/cards_all.svg" alt=""></figure>
                            <p>Nó nên được hiểu là sự co rút của các giác quan, để lỗi lầm của chúng tôi và của bạn đều
                                không
                                phải là một triết lý tốt hơn. Nhưng hầu như không có nguy hiểm gì. Thông thường tritani lúc
                                đầu
                                không phải là những định nghĩa đó.</p>
                        </div>

                        <h6 class="pb-2">Phương thức vận chuyển</h6>


                        <ul>
                            <li>
                                <label class="container_radio">Giao hàng tiết kiệm<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="shipping" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Giao hàng nhanh<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="shipping">
                                    <span class="checkmark"></span>
                                </label>
                            </li>

                        </ul>

                    </div>
                    <!-- end Thanh toán và vận chuyển------------------------- -->

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. Tóm tắt đơn hàng</h3>
                        <div class="box_general summary">
                            <ul>
                                @foreach ($_SESSION[$key] as $item)
                                    <li class="clearfix d-flex justify-content-around"><em>{{$item['name']}}</em><em>{{$item['quantity']}}sp</em><span>{{number_format((!empty($item['price_sale'])?$item['price_sale']:$item['price_regular']))}}VND</span></li>
                                @endforeach
                            </ul>
                            <ul>
                                <li class="clearfix"><em><strong>Tổng</strong></em> <span>{{ number_format($totalProduct) }}VND</span></li>
                                <li class="clearfix"><em><strong>Vận chuyển</strong></em> <span>7.000VND</span></li>

                            </ul>
                            <div class="total clearfix">Thành tiền <span>{{ number_format($totalProduct + 7000) }}VND</span></div>
                            <input type="hidden" name="totalOrder" value="{{$totalProduct + 7000}}">
                            <button type="submit" class="btn_1 full-width">Xác nhận thanh toán</button>
                        </div>
                        <!-- /box_general -->
                    </div>
                    <!-- /step -->
                </div>
            </div>
        </form>
        <!-- /row -->
    </div>
@endsection
@section('scripts')
    <script>
        // Other address Panel
        $('#other_addr input').on("change", function() {
            if (this.checked)
                $('#other_addr_c').fadeIn('fast');
            else
                $('#other_addr_c').fadeOut('fast');
        });
    </script>
@endsection
