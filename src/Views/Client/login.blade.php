@extends('layouts.client')
@section('title')
    Đăng nhập đăng ký
@endsection
@section('css')
    <link href="{{ asset('assets/Client/css/account.css') }}" rel="stylesheet">
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
    @if (isset($_SESSION['status']) && $_SESSION['status'])
        <div class="container box position-relative">
            <ul class="box position-absolute text-danger" style="top: 20px; right: 70px;">
                <li>{{ $_SESSION['msg'] }}</li>
            </ul>
        </div>
        @php
            unset($_SESSION['status']);
            unset($_SESSION['msg']);
        @endphp
    @endif
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Danh mục</a></li>
                    <li>Trang hoạt động</li>
                </ul>
            </div>
            <h1>Đăng nhập hoặc đăng ký</h1>
        </div>
        <!-- /page_header -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <form action="{{ url('handle-login') }}" method="POST">
                    <div class="box_account">
                        <h3 class="client">Đăng nhập</h3>
                        <div class="form_container">
                            <div class="row no-gutters">
                                <div class="col-lg-6 pr-lg-1">
                                    <a href="#0" class="social_bt facebook">Đăng nhập với Facebook</a>
                                </div>
                                <div class="col-lg-6 pl-lg-1">
                                    <a href="#0" class="social_bt google">Đăng nhập với Google</a>
                                </div>
                            </div>
                            <div class="divider"><span>Hoặc</span></div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email*" value="{{ $_POST['email'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_in" id="password_in"
                                    value="{{ $_POST['password_in'] ?? '' }}" placeholder="Mật khẩu*">
                            </div>
                            <div class="clearfix add_bottom_15">
                                <div class="checkboxes float-start">
                                    <label class="container_check">Ghi nhớ tài khoản
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                {{-- javascript:void(0); --}}
                                <div class="float-end"><a id="forgot" href="#">Quên mật khẩu</a></div>
                            </div>
                            <div class="text-center"><input type="submit" name="login" value="Log In"
                                    class="btn_1 full-width"></div>
                            {{-- <div id="forgot_pw">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email_forgot" id="email_forgot"
                                        placeholder="Nhập email của bạn">
                                </div>
                                <p>Mật khẩu sẽ sớm được gửi đến</p>
                                <div class="text-center"><input type="submit" value="Đặt lại mật khẩu" class="btn_1">
                                </div>
                            </div> --}}
                        </div>
                        <!-- /end đăng nhập form_container -->
                    </div>
                    <!-- /box_account -->
                    <div class="row">
                        <div class="col-md-6 d-none d-lg-block">
                            <ul class="list_ok">
                                <li>Tìm kiếm vị trí</li>
                                <li>Kiểm tra vị trí</li>
                                <li>Bảo vệ dữ liệu</li>
                            </ul>
                        </div>
                        <div class="col-md-6 d-none d-lg-block">
                            <ul class="list_ok">
                                <li>Thanh toán an toàn</li>
                                <li>Hỗi trợ 24/24</li>
                            </ul>
                        </div>
                    </div>
                    <!-- /row -->
                </form>
            </div>
            <!-- Đăng ký ------------------->
            <div class="col-xl-6 col-lg-6 col-md-8">
                <form action="{{ url('singin') }}" method="POST">
                    <div class="box_account">
                        <h3 class="new_client">Đăng ký</h3> <small class="float-right pt-2">* Bắt buộc</small>
                        <div class="form_container">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email_2"
                                    placeholder="Email*">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" value=""
                                    placeholder="Mật khẩu*">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="repassword" id="password" value=""
                                    placeholder="Nhập lại mật khẩu*">
                            </div>
                            <hr>
                            <div class="private box">
                                <div class="row no-gutters">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Họ và tên*">
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /company -->
                            <div class="text-center"><input type="submit" value="Register" class="btn_1 full-width">
                            </div>
                        </div>
                        <!-- /form_container -->
                    </div>
                </form>
                <!-- /box_account -->
            </div>
        </div>
        <!-- /row -->
    </div>
@endsection
@section('scripts')
    <script>
        $('input[name="client_type"]').on("click", function() {
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    </script>
@endsection
