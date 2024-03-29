@extends('layout.home')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-01.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-02.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-03.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-04.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-05.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-06.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-07.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-08.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-1.png">
                            </div>
                            <h3 class="title">@lang('lang.mienphivanchuyen')</h3>
                            <p class="desc">@lang('lang.toitaykhachhang')</p>
                        </li>
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-2.png">
                            </div>
                            <h3 class="title">@lang('lang.tuvan24/7')</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-3.png">
                            </div>
                            <h3 class="title">@lang('lang.tietkiemhon')</h3>
                            <p class="desc">@lang('lang.uudai')</p>
                        </li>
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-4.png">
                            </div>
                            <h3 class="title">@lang('lang.thanhtoannhanh')</h3>
                            <p class="desc">@lang('lang.hotro')</p>
                        </li>
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-5.png">
                            </div>
                            <h3 class="title">@lang('lang.dathangonline')</h3>
                            <p class="desc">@lang('lang.thaotac')</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">@lang('lang.sanphamnoibat')</h3>
                </div>
                <div class="section-detail">
                    @if(!empty($list_highlight_pro))
                    <ul class="list-item">
                        @foreach($list_highlight_pro as $product)
                        <li>
                            <a href="{{$product->url}}" title="" class="thumb">
                                <img src="{{$product->thumb}}">
                            </a>
                            <a href="{{$product->url}}" title="" class="product-name">{{$product->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($product->price)}}đ</span>
                                <span class="old">{{number_format($product->old_price)}}đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="javacript:" title="" data-id="{{$product->id}}" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="{{$product->url_checkout}}" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @if(!empty($list_cate))
            @for($i=0; $i<2; $i++) <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">{{$list_cate[$i]->name}}</h3>
                </div>
                <div class="section-detail">
                    @if(!empty($list_pro_in_cate))
                    <ul class="list-item clearfix">
                        @foreach($list_pro_in_cate[$i] as $product)
                        <li>
                            <a href="{{$product['url']}}" title="" class="thumb">
                                <img src="{{$product['thumb']}}">
                            </a>
                            <a href="{{$product['url']}}" title="" class="product-name">{{$product['name']}}</a>
                            <div class="price">
                                <span class="new">{{number_format($product['price'])}}đ</span>
                                <span class="old">{{number_format($product['old_price'])}}đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="javacript:" title="" data-id="{{$product['id']}}" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="{{$product['url_checkout']}}" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
        </div>
        @endfor
        @endif
    </div>
    <div class="sidebar fl-left">
        @include('layout.sb-cate-pro')
        @include('layout.sb-selling-pro')
        @include('layout.sb-banner')
    </div>
</div>
</div>
@endsection