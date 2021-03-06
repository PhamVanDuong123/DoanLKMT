@php
$total = filter_var(Cart::total(),FILTER_SANITIZE_NUMBER_INT);
$promotion = Session::get('promotion');
$feeship = Session::get('feeship')?Session::get('feeship')['fee']:null;
@endphp

@extends('layout.home')

@section('content')
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
        @endif
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <div class="row">
                    <div class="col-md-12">
                        <p class="title-checkout text-danger">Khuyến mãi</p>
                        <form action="" method="post" class="">
                            @csrf
                            <label for="promotion_code">Nhập mã khuyến mãi:</label>
                            <input type="text" name="promotion_code" id="promotion_code" class="" value="{{$promotion?$promotion[0]['code']:''}}">
                            <input type="button" id="btn-promotion-code" value="Sử dụng" class="btn btn-warning">
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <form>
                            @csrf
                            <p class="title-checkout text-danger">Địa điểm giao hàng</p>
                            <div class="row address">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="province" id="province" class="form-control choose">
                                            <option value="">-- Chọn tỉnh/thành phố --</option>
                                            @if($list_province)
                                            @foreach($list_province as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="district" id="district" class="form-control choose">
                                            <option value="">-- Chọn quận/huyện --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-top: 25px;">
                                        <select name="ward" id="ward" class="form-control">
                                            <option value="">-- Chọn xã/phường/thị trấn --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Số nhà / Tên đường / Tên ấp</label>
                                        <input type="text" name="address" id="address" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <form>
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <p class="title-checkout text-danger">Thông tin người nhận</p>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Họ tên</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="tel" name="phone" id="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note">Ghi chú</label>
                                        <textarea rows="3" name="note" id="note" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="place-order-wp clearfix">
                                        <input type="button" class="btn btn-primary px-5 py-3" id="order-now" value="Đặt hàng">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::content() as $product)
                        <tr class="cart-item">
                            <td class="product-name">{{$product->name}}<strong class="product-quantity">x {{$product->qty}}</strong></td>
                            <td class="product-total">{{number_format($product->subtotal,0,',','.')}}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @if($promotion||$feeship)
                        <tr class="order-total">
                            <td>Tổng giá tiền:</td>
                            <td>{{number_format($total,0,',','.')}}đ</td>
                        </tr>
                        @endif

                        @php
                        $total_after = $total;
                        @endphp

                        @if($promotion)
                        @if($promotion[0]['condition']==1)
                        <tr class="order-total">
                            <td>Giảm giá:</td>
                            <td>{{$promotion[0]['number']}}%<a href="{{route('cart.del_promotion_code')}}" class="ml-2" title="Hủy mã giảm giá"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <tr class="order-total">
                            <td>Số tiền giảm:</td>
                            <td>{{number_format($total*$promotion[0]['number']/100,0,',','.')}}đ</td>

                        </tr>
                        @php
                        $total_after = $total-($total*$promotion[0]['number']/100)
                        @endphp
                        @elseif($promotion[0]['condition']==2)
                        <tr class="order-total">
                            <td>Giảm giá:</td>
                            <td>{{number_format($promotion[0]['number'],0,',','.')}}đ<a href="{{route('cart.del_promotion_code')}}" class="ml-2" title="Hủy mã giảm giá"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        @php
                        $total_after = $total-$promotion[0]['number']
                        @endphp
                        @endif
                        @endif

                        @if($feeship)
                        <tr class="order-total">
                            <td>Phí vận chuyển:</td>
                            <td>{{number_format($feeship,0,',','.')}}đ</td>
                        </tr>
                        @endif

                        <tr class="order-total text-danger">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price">{{number_format($total_after+$feeship,0,',','.')}}đ</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="payment">Phương thức thanh toán</label>
                                    <select name="payment" id="payment" class="form-control">
                                        <option value="">--Chọn--</option>
                                        <option value="onl">Thẻ ngân hàng</option>
                                        <option value="cod">Khi nhận hàng (COD)</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @php $total_to_usd = round(($total_after+$feeship)/22520,2) @endphp
                                <!-- Set up a container element for the button -->
                                <div id="paypal-button"></div>
                                <input type="hidden" id="total_to_usd" value="{{$total_to_usd}}">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection