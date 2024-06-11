@extends('layouts.master')
@section('title')
    Quản lý đơn hàng
@endsection
@section('css')
    <style>
        .thumb_cart {
            width: 60px;
            height: 60px;
            overflow: hidden;
            margin-right: 10px;
            float: left;
            position: relative;
            background-color: #fff;
            padding: 5px;
            box-sizing: content-box;
        }

        .thumb_cart img {
            width: 60px;
            height: auto;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%) scale(1.1);
            -moz-transform: translate(-50%, -50%) scale(1.1);
            -ms-transform: translate(-50%, -50%) scale(1.1);
            -o-transform: translate(-50%, -50%) scale(1.1);
            transform: translate(-50%, -50%) scale(1.1);
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Đơn hàng:
                                {{ $status == 0 ? 'Chờ xác nhận' : ($status == 1 ? 'Chờ lấy hàng' : ($status == 2 ? 'Đang giao hàng' : ($status == 3 ? 'Đã giao' : ($status == 4 ? 'Đã hủy' : ($status == 5 ? 'Trả hàng' : ''))))) }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="d-flex">
                        <li><a class="btn btn-warning" href="{{ url('admin/order?status=0') }}">Chờ xác nhận</a></li>
                        <li><a class="btn btn-warning" href="{{ url('admin/order?status=1') }}">Chờ giao hàng</a></li>
                        <li><a class="btn btn-warning" href="{{ url('admin/order?status=2') }}">Đang giao hàng</a></li>
                        <li><a class="btn btn-warning" href="{{ url('admin/order?status=3') }}">Đã giao</a></li>
                        <li><a class="btn btn-warning" href="{{ url('admin/order?status=4') }}">Đã hủy</a></li>
                        <li><a class="btn btn-warning" href="{{ url('admin/order?status=5') }}">Hoàn hàng</a></li>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            @if (isset($historyOrder1))
                                <a class="btn btn-danger" href="{{ url('admin/order?') . $history }}">Quay lại</a>
                                <tr>
                                    <th>
                                        Sản phẩm
                                    </th>
                                    <th>
                                        Tên sản phẩm
                                    </th>
                                    <th>
                                        Số lượng
                                    </th>
                                    <th>
                                        Giá
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            @else
                                <tr>
                                    <th>
                                        Mã hóa đơn
                                    </th>
                                    <th>
                                        Tên khách hàng
                                    </th>
                                    <th>
                                        Số điện thoại
                                    </th>
                                    <th>
                                        Địa chỉ
                                    </th>
                                    <th>
                                        Thanh toán
                                    </th>
                                    <th>
                                        Thành tiền
                                    </th>
                                    <th>
                                        Trạng thái đơn hàng
                                    </th>
                                    <th>
                                        Thao tác
                                    </th>
                                </tr>
                            @endif
                        </thead>

                        <!-- phần sản phẩm được thêm vào giỏ hàng -->
                        <tbody>
                            @if (!empty($historyOrder1))
                                @foreach ($historyOrder1 as $key => $values)
                                    <tr>
                                        <td>
                                            <div class="thumb_cart">
                                                <img src="{{ asset($values['img']) }}" class="lazy" alt="Image">
                                            </div>
                                        </td>
                                        <td>
                                            <span class="item_cart">{{ $values['namesp'] }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="item_cart">{{ $values['quantity'] }} sản phẩm</span>
                                            </div>
                                        </td>
                                        <td>
                                            <strong
                                                class="item_cart">{{ $total = number_format($values['price']) }}VND</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif (!empty($historyOrder))
                                @foreach ($historyOrder as $key => $values)
                                    <tr>
                                        <td>
                                            <span style=" font-weight:bold;">OD-{{ $values['id'] }}</span>
                                        </td>
                                        <td>{{ $values['user_name'] }}</td>
                                        <td>{{ $values['user_phone'] }}</td>
                                        <td>{{ $values['user_address'] }}</td>
                                        <td>
                                            <div>
                                                <span>{{ $values['status_payment'] == 0 ? 'Chưa thanh toán' : ($values['status_payment'] == 1 ? 'Đã thanh toán' : ($values['status_payment'] == 2 ? 'Đã hoàn tiền' : '')) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $total = number_format($values['totalOrder']) }}VND</strong>
                                        </td>
                                        <td>
                                            <span class=" text-danger">
                                                {{ $values['status_delivery'] == 0 ? 'Chờ xác nhận' : ($values['status_delivery'] == 1 ? 'Chờ lấy hàng' : ($values['status_delivery'] == 2 ? 'Đang giao hàng' : ($values['status_delivery'] == 3 ? 'Đã giao' : ($values['status_delivery'] == 4 ? 'Đã hủy' : '')))) }}</span>
                                        </td>
                                        <td>
                                            @if ($values['status_delivery'] < 3)
                                                <a href="{{ url('admin/orderUpdate?') . $history . '&click=1' . '&idOder=' . $values['id'] }}"
                                                    class="btn btn-warning">Xác nhận</a>
                                            @endif
                                            <a href="{{ url('admin/orderdetail?' . $history . '&idOder=') . $values['id'] }}"
                                                class="btn btn-warning">Chi
                                                tiết</a>
                                            @if ($values['status_delivery'] == 0)
                                                <a href="{{ url('admin/cancelorder?' . $history . '&idOder=') . $values['id'] }}"
                                                    onclick="return confirm('Bạn có chắc hủy không')"
                                                    class="btn btn-danger">Hủy
                                                    đơn</a>
                                            @elseif ($values['status_delivery'] == 4)
                                                <a class="btn btn-danger">Đã hủy</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="pagination__wrapper">
                        <ul class="pagination">
                            @if ($page > 1)
                                <li><a href="{{ url('admin/order?' . $history . '?page=' . ($page - 1 == 0 ? 1 : $page - 1)) }}"
                                        class="prev" title="previous page">&#10094;</a></li>
                            @endif
                            @for ($i = 1; $i <= $totalPage; $i++)
                                <li>
                                    <a href="{{ url('admin/order?' . $history . '?page=' . $i) }}"
                                        class="{{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                                </li>
                            @endfor
                            @if ($page < $totalPage)
                                <li><a href="{{ url('admin/order?' . $history . '?page=' . ($page + 1 > $totalPage ? $totalPage : $page + 1)) }}"
                                        class="next" title="next page">&#10095;</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- /cart_actions -->
                </div>
            </div>
        </div>
    </div>
@endsection
