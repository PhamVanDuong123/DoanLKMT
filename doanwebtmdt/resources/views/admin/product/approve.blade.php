@php

function show_status($status){
$list_status=array(
'approved'=>'<span class="badge badge-success">Được duyệt</span>',
'not approved yet'=>'<span class="badge badge-danger">Chưa được duyệt</span>',
);
return $list_status[$status];
}

function currency_format($currency,$innit='đ'){
return number_format($currency,0,',','.').$innit;
}
@endphp
@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm chờ xét duyệt</h5>
            <div class="form-search-sale form-inline">
                <form action="" method="get" class="form-action">
                    <input type="text" id="key" name="key" class="form-control form-search" placeholder="Nhập tên sản phẩm" value="{{request()->key}}">
                    <button type="submit" id="btn-search-post" name="btn-search-post" class="btn btn-primary">Tìm kiếm <i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{!!session('success')!!}</div>
            @elseif(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            @if($list_pro_not_approve->total()>0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th><span class="thead-text">STT</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Thương hiệu</th>
                        <th scope="col">Loại sản phẩm</th>
                        <th scope="col">Giá bán</th>
                        <th scope="col">Giá gốc</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @php $t=0; @endphp
                    @foreach($list_pro_not_approve as $item)
                    @php $t++; @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="list_Product_id[]" value="{{$item->id}}">
                        </td>
                        <td scope="row">{{$t}}</td>
                        <td><img class="thumb-post" src="{{$item->thumb}}" alt=""></td>
                        <td><a href="{{route('admin.product.detail',$item->id)}}">{{$item->name}}</a></td>
                        <td>{{$item->brand->name}}</td>
                        <td>{{$item->product_category->name}}</td>
                        <td>{{currency_format($item->price)}}<br><del>{{currency_format($item->old_price)}}</del></td>
                        <td>{{currency_format($item->price_cost)}}</td>
                        <td>{{$item->inventory_num}}</td>
                        <td>{{$item->user->fullname}}</td>
                        <td>{!!show_status($item->status)!!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$list_pro_not_approve->appends(request()->all())->links()}}
            @else
            <p class="text-center">Không có sản phẩm nào</p>
            @endif
        </div>
    </div>
</div>
@endsection