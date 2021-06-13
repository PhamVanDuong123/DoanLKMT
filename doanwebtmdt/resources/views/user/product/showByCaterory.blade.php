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
            @if(!empty($cate))
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">{{$cate->name}}</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị {{count($list_pro)}} trên {{count($list_pro)}} sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    @if(!empty($list_pro))
                    <ul class="list-item clearfix">
                        @foreach($list_pro as $product)
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
                                    <a href="{{$product->url_add_cart}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{$product->url_checkout}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            <div class="section" id="paging-wp">
                {!! $list_pro->links() !!}
            </div>
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