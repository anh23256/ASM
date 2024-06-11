@extends('layouts.client')
@section('title')
    Lịch sử mua hàng
@endsection
@section('css')
    <link href="{{ asset('assets/Client/css/cart.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Danh mục</a></li>
                    <li>Trang hoạt động</li>
                </ul>
            </div>
            <h1>Lịch sử mua hàng</h1>
        </div>
        <!-- /page_header -->
        <table class="table table-striped">
            <thead>
                @if (isset($historyOrder1))
                    <a class="btn btn-danger" href="{{ url('historyOrder') }}">Quay lại</a>
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
                                    <img src="{{ $values['img'] }}" class="lazy" alt="Image">
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
                                <strong class="item_cart">{{ $total = number_format($values['price']) }}VND</strong>
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
                                <a href="{{ url('historyDetail?idOder=') . $values['id'] }}" class="btn btn-warning">Chi
                                    tiết</a>
                                @if ($values['status_delivery'] == 0)
                                    <a href="{{ url('cancelOrder?idOder=') . $values['id'] }}"
                                        onclick="return confirm('Bạn có chắc hủy không')" class="btn btn-danger">Hủy
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
                    <li><a href="{{ url($history . '?page=' . ($page - 1 == 0 ? 1 : $page - 1)) }}" class="prev"
                            title="previous page">&#10094;</a></li>
                @endif
                @for ($i = 1; $i <= $totalPage; $i++)
                    <li>
                        <a href="{{ url($history . '?page=' . $i) }}"
                            class="{{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                    </li>
                @endfor
                @if ($page < $totalPage)
                    <li><a href="{{ url($history . '?page=' . ($page + 1 > $totalPage ? $totalPage : $page + 1)) }}"
                            class="next" title="next page">&#10095;</a></li>
                @endif
            </ul>
        </div>
        <!-- /cart_actions -->
    </div>
@endsection
