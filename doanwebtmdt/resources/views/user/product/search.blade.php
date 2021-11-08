@extends('layout.home')
@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
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
            
        <h2>Tìm kiếm với từ khóa: <span>{{$keyword}}</span></h2>
            
            @if(!empty($search_product))
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                <h3 class="section-title fl-left"></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị {{count($search_product)}} trên {{count($search_product)}} sản phẩm</p>
                        <div class="form-filter">
                     
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                 
                    <ul class="list-item clearfix">
                        @foreach($search_product as $product)
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
                                    <a href="javacript:" title="Thêm giỏ hàng" data-id="{{$product->id}}" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{$product->url_checkout}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    
                </div>
            </div>
            <div class="section" id="paging-wp">
              
            </div>
            @else
                <h3>Không tồn tại sản phẩm nào!!!</h3>
            @endif   
               
        </div>
        <div class="sidebar fl-left">
            @include('layout.sb-cate-pro')
            @include('layout.sb-filter-pro')
            @include('layout.sb-banner')            
        </div>
    </div>
</div>
@endsection