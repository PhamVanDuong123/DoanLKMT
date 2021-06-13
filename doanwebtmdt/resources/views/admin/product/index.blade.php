@extends('layoutadmin.master')

@php 
    function currency_format($currency,$unit='đ'){
        return number_format($currency).$unit;
    }
    
    function show_status($status){
        $list_status=array(
            'approved'=>'Được duyệt',
            'not approved yet'=>'Chưa được duyệt'
        );
        return $list_status[$status];
    }
@endphp

@section('content')
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
    @include('layoutadmin.sidebar')
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="{{route('admin.product.add')}}" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            @if(!empty($list_pro))
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(10)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(5)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(5)</span></a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(0)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Chỉnh sửa</option>
                                <option value="2">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">                        
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Ảnh đại diện</span></td>
                                    <td><span class="thead-text">Thương hiệu</span></td>
                                    <td><span class="thead-text">Loại sản phẩm</span></td>
                                    <td><span class="thead-text">Giá bán</span></td>
                                    <td><span class="thead-text">Giá cũ</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>                                    
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Ngày tạo</span></td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=0; @endphp
                                @foreach($list_pro as $product)
                                @php $count++; @endphp
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">{{$count}}</h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{$product->name}}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><img class="avatar" src="{{asset($product->thumb)}}" alt=""></td>
                                    <td><span class="tbody-text">{{$product->brand->name}}</span></td>
                                    <td><span class="tbody-text">{{$product->product_category->name}}</span></td>
                                    <td><span class="tbody-text">{{currency_format($product->price)}}</span></td>
                                    <td><span class="tbody-text">{{currency_format($product->old_price)}}</span></td>
                                    <td><span class="tbody-text">{{$product->inventory_num}}</span></td>
                                    <td><span class="tbody-text">{{show_status($product->status)}}</span></td>
                                    <td><span class="tbody-text">{{$product->account->fullname}}</span></td>
                                    <td><span class="tbody-text">{{$product->created_at}}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">Xóa</span></td>
                                    <td><span class="tfoot-text">Xóa tất cả</span></td>
                            </tfoot>
                        </table>                        
                    </div>

                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    {!! $list_pro->links() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection