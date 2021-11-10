@php
$total = filter_var(Cart::total(),FILTER_SANITIZE_NUMBER_INT);
$promotion = Session::get('promotion');
$feeship = Session::get('feeship');
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
        <form method="POST" action="{{route('cart.pay')}}" name="form-checkout">
            @csrf
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone">
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- <div class="form-col fl-right">
                            <label for="promotion_code">Mã khuyến mãi</label>
                            <input type="text" name="promotion_code" id="promotion_code">
                        </div> -->
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note"></textarea>
                        </div>
                    </div>

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
                            <tr class="order-total">
                                <td>Tổng giá tiền:</td>
                                <td><strong class="total-price">{{number_format($total,0,',','.')}}đ</strong></td>
                            </tr>                        
                            @if($promotion)
                                @if($promotion[0]['condition']==1)
                                    <tr class="order-total">
                                        <td>Giảm giá:</td>
                                        <td><strong class="total-price">{{$promotion[0]['number']}}%</strong></td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Số tiền giảm:</td>
                                        <td><strong class="total-price">{{number_format($total*$promotion[0]['number']/100,0,',','.')}}đ</strong></td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Phí vận chuyển:</td>
                                        <td><strong class="total-price">{{number_format($feeship,0,',','.')}}đ</strong></td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Tổng đơn hàng:</td>
                                        <td><strong class="total-price">{{number_format($total-($total*$promotion[0]['number']/100)+$feeship,0,',','.')}}đ</strong></td>
                                    </tr>
                                @elseif($promotion[0]['condition']==2)
                                    <tr class="order-total">
                                        <td>Giảm giá:</td>
                                        <td><strong class="total-price">{{number_format($promotion[0]['number'],0,',','.')}}đ</strong></td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Phí vận chuyển:</td>
                                        <td><strong class="total-price">{{number_format($feeship,0,',','.')}}đ</strong></td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Tổng đơn hàng:</td>
                                        <td><strong class="total-price">{{number_format($total-$promotion[0]['number']+$feeship,0,',','.')}}đ</strong></td>
                                    </tr>
                                @endif
                            @else
                                <tr class="order-total">
                                    <td>Phí vận chuyển:</td>
                                    <td><strong class="total-price">{{number_format($feeship,0,',','.')}}đ</strong></td>
                                </tr>  
                                <tr class="order-total">
                                        <td>Tổng đơn hàng:</td>
                                        <td><strong class="total-price">{{number_format($total+$feeship,0,',','.')}}đ</strong></td>
                                    </tr>  
                            @endif                            
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="onl" name="payment" value="onl">
                                <label for="onl">Thanh toán bằng thẻ ngân hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="cod" name="payment" value="cod">
                                <label for="cod">Thanh toán khi nhận hàng (COD)</label>
                            </li>
                        </ul>
                        @error('payment')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection