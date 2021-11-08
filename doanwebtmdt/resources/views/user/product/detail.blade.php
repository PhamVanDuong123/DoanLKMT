@extends('layout.home')
@section('content')
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            @if(!empty($product))
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" src="{{$product->thumb}}" data-zoom-image="{{$product->thumb}}" />
                        </a>
                        <!-- <a href="" id="main-thumb">
                            <img src="{{$product->thumb}}" alt="">
                        </a> -->
                        @if(!empty($list_pro_image))
                            <div id="list-thumb">
                                @foreach($list_pro_image as $image)
                                    <!-- <a href="" data-image="{{$image->url}}" data-zoom-image="{{$image->url}}">
                                        <img id="zoom" src="{{$image->url}}" />
                                    </a> -->
                                    <a href="" data-image="{{$image->url}}">
                                        <img src="{{$image->url}}" alt="">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="{{$product->thumb}}" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">{{$product->name}}</h3>
                        <div class="desc">
                            <p>{{$product->short_desc}}</p>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">Còn hàng</span>
                        </div>
                        <p class="price">{{number_format($product->price)}}đ</p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <a href="javacript:" title="Thêm giỏ hàng" data-id="{{$product->id}}" class="add-cart">Thêm giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    {!!$product->detail_desc!!}
                </div>
            </div>
            <div class="section" id="comment-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bình luận sản phẩm</h3>
                  
                    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=1073274126775855&autoLogAppEvents=1" nonce="aDWrCZuZ"></script>
                </div>

                <div class="section-detail">
                <div class="fb-comments" data-href="https://laravel-news.com/" data-width="" data-numposts="5"></div>
                </div>
            </div>
           
            <div class="section" id="same-category-wp">
                @if(!empty($list_pro_same_cate))
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($list_pro_same_cate as $product)
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
                </div>
                @endif
            </div>
            @endif
        </div>
        <div class="sidebar fl-left">
            @include('layout.sb-cate-pro')
            @include('layout.sb-banner')
        </div>
    </div>
</div>
@endsection