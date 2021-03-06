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
            @if(!empty($list_pro))
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị {{count($list_pro)}} trên {{count($list_pro)}} sản phẩm</p>
                        <div class="form-filter">
                        <form method="POST" action="">
                            @csrf
                            <select name="sort_by" id="sort_by" wire:model="sorting" >
                                    <option value="{{Request::url()}}?sort_by=none">Sắp xếp</option>
                                    <option value="{{Request::url()}}?sort_by=sp_hot">Sản phẩm hot</option>
                                    <option value="{{Request::url()}}?sort_by=sp_moi">Sản phẩm mới</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_az">Từ A-Z</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_za">Từ Z-A</option>
                                    <option value="{{Request::url()}}?sort_by=giam_dan">Giá cao xuống thấp</option>
                                    <option value="{{Request::url()}}?sort_by=tang_dan">Giá thấp lên cao</option>
                                </select>
                          
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    
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
                                    <a href="javacript:" title="Thêm giỏ hàng" data-id="{{$product->id}}" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{$product->url_checkout}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    
                </div>
            </div>
            <div class="section" id="paging-wp">
                {!! $list_pro->links() !!}
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