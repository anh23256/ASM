@extends('layouts.master')

@section('title')
Xem chi tiết: {{ $product['name'] }}
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1 class="m-0">Danh sách</h1>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>TRƯỜNG</th>
                        <th>GIÁ TRỊ</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($product as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{!! $value !!}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection