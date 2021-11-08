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
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search-sale form-inline">
                <form action="">
                    @csrf
                    <select name="search_option_post" class="form-control" id="search_option_post">
                        <option value="title" {{request()->search_option_post=='title'?'selected':''}}>Tên sản phẩm</option>
                        <option value="brand" {{request()->search_option_post=='brand'?'selected':''}}>Thương hiệu</option>
                        <option value="category" {{request()->search_option_post=='category'?'selected':''}}>Loại sản phẩm</option>
                    </select>
                    <input type="text" id="key" name="key" class="form-control form-search" placeholder="Nhập tên sản phẩm" value="{{request()->key}}">
                    <button type="submit" id="btn-search-post" name="btn-search-post" class="btn btn-primary">Tìm kiếm <i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
        <div class="analytic">
                    <a href="{{request()->fullUrlWithQuery(['status'=>'all','page'=>1])}}" class="text-primary">Tất cả<span class="text-muted">({{$count['all']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'approved','page'=>1])}}" class="text-primary">Được duyệt<span class="text-muted">({{$count['approved']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'not approved yet','page'=>1])}}" class="text-primary">Chưa được duyệt<span class="text-muted">({{$count['not approved yet']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'trash','page'=>1])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count['trash']}})</span></a>
                </div>
            <form action="{{route('admin.product.action')}}" method="post">
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name="action">
                        <option value="">Chọn</option>
                        @if(!empty($list_action))
                        @foreach($list_action as $k=>$v)
                        <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                        @endif
                    </select>
                    <button type="submit" name="btn-search" class="btn btn-primary">Áp dụng <i class="far fa-check-circle"></i></button>
                </div>
                @if(session('success'))
                <div class="alert alert-success">{!!session('success')!!}</div>
                @elseif(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                @if($list_Product->total()>0)
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th><span class="thead-text">STT</th>
                                    <th scope="col" >Ảnh</th>
                                    <th scope="col">Tên</th>                                    
                                    <th scope="col">Thương hiệu</th> 
                                    <th scope="col">Loại sản phẩm</th> 
                                    <th scope="col">Giá bán</th>
                                    <th scope="col">Giá gốc</th>  
                                    <th scope="col">Số lượng</th>                               
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $t=0; @endphp
                        @foreach($list_Product as $item)
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
                            <td>
                            <a href="{{route('admin.product.edit',['id'=>$item->id,'status'=>request()->status])}}" class="btn btn-success btn-sm rounded-0 text-white action-icon" type="button" data-toggle="tooltip" data-placement="top" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                <a href="{{route('admin.product.delete',['id'=>$item->id,'status'=>request()->status])}}" onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi này?')" class="btn btn-danger btn-sm rounded-0 text-white action-icon" type="button" data-toggle="tooltip" data-placement="top" title="{{request()->status=='trash'?'Xóa vĩnh viễn':'Xóa'}}"><i class="fa fa-trash"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$list_Product->appends(request()->all())->links()}}
                @else
                <p class="text-center">Không có sản phẩm nào</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection