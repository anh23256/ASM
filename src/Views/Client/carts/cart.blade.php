@extends('layouts.client')
@section('title')
    Giỏ hàng của bạn
@endsection
@section('css')
    <link href="{{ asset('assets/Client/css/cart.css') }}" rel="stylesheet">
@endsection
@section('content')
    @if (!empty($_SESSION['errors']))
        <div class="container box position-relative">
            <ul class="box position-absolute" style="top: 20px; right: 70px;">
                <li class="text-warning">{{ $_SESSION['errors'] }}</li>
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
                    <li>Giỏ hàng</li>
                </ul>
            </div>
            <h1>Giỏ hàng</h1>
        </div>
        <!-- /page_header -->
        <table class="table table-striped cart-list">
            <thead>
                <tr>
                    <th>
                        Sản phẩm
                    </th>
                    <th>
                        Giá
                    </th>
                    <th>
                        Số lượng
                    </th>
                    <th>
                        Thành tiền
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>

            <!-- phần sản phẩm được thêm vào giỏ hàng -->
            <tbody>
                @if (!empty($_SESSION[$key]))
                    @foreach ($_SESSION[$key] as $cart)
                        <tr>
                            <td>
                                <div class="thumb_cart">
                                    <img src="{{ url($cart['img_thumbnail']) }}"class="lazy" alt="Image">
                                </div>
                                <span class="item_cart">{{ $cart['name'] }}</span>
                            </td>
                            <td>
                                <strong>{{ number_format(!empty($cart['price_sale']) ? $cart['price_sale'] : $cart['price_regular']) }}VND</strong>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-danger"
                                        href="{{ url('cart/quantity?dec') . '&productId=' . $cart['id'] }}">-</a>
                                    <span class="btn border-dark">{{ $cart['quantity'] }}</span>
                                    <a class="btn btn-danger"
                                        href="{{ url('cart/quantity?inc') . '&productId=' . $cart['id'] }}">+</a>
                                </div>
                            </td>
                            <td>
                                <strong>{{ number_format((!empty($cart['price_sale']) ? $cart['price_sale'] : $cart['price_regular']) * $cart['quantity']) }}VND</strong>
                            </td>
                            <td class="options">
                                <a href="{{ url('cartDelete') . '?productID=' . $cart['id'] }}"
                                    onclick="return confirm('Bạn có chắc muốn xóa không?')"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- /container -->

    <div class="box_cart">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <ul>
                        <li>
                            <span>Thành tiền</span> {{ number_format($totalProduct) }}VND
                        </li>
                        <li>
                            <span>Phí ship</span> 7.000VND
                        </li>
                        <li>
                            <span>Tổng thanh toán</span> {{ number_format($totalProduct + 7000) }}VND
                        </li>
                    </ul>
                    <a href="{{ url('order') }}" class="btn_1 full-width cart">Tiến hành thanh toán</a>
                </div>
            </div>
        </div>
    </div>
@endsection
