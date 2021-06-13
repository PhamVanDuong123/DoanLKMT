@extends('layout.home')
@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-01.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{url('public/user')}}/images/slider-03.png" alt="">
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
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb thumb-icon-intro">
                                <img src="{{url('public/user')}}/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
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
                                <a href="{{$product->url_add_cart}}" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="{{$product->url_checkout}}" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @if(!empty($list_cate))
            @for($i=0; $i<2; $i++) 
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">{{$list_cate[$i]->name}}</h3>
                </div>
                <div class="section-detail">
                    @php
                    $list_pro_in_cate=$list_cate[$i]->products;
                    foreach($list_pro_in_cate as &$product){
                        $product['url']=route('product.detail',$product->id);
                        $product['url_add_cart']=route('cart.add',$product->id);
                        $product['url_checkout']=route('cart.checkout');
                    }
                    @endphp
                    @if(!empty($list_pro_in_cate))
                    <ul class="list-item clearfix">
                        @foreach($list_pro_in_cate as $product)
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
                                <a href="{{$product->url_add_cart}}" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="{{$product->url_checkout}}" title="" class="buy-now fl-right">Mua ngay</a>
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