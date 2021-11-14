@extends('layoutadmin.master')

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


@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chi tiết sản phẩm
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{!!session('success')!!}</div>
            @elseif(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="container">
                <div class="row">
                    @if(!empty($product))
                    <div class="col-md-3">
                        <label for="" class="font-weight-bold">Hình ảnh: </label>
                        <img class="avatar_detial" src="{{empty($product->thumb)?url('/public/uploads/no_avatar.jpg'):$product->thumb}}" alt="">
                    </div>
                    <div class="col-md-9">
                        <form action="{{route('admin.product.approve_pro',$product->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Tên sản phẩm: </label>
                                    <p>{{$product->name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Mã sản phẩm: </label>
                                    <p>{{$product->code}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Loại sản phẩm: </label>
                                    <p>{{$product->product_category->name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Thương hiệu: </label>
                                    <p>{{$product->brand->name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Số lượng: </label>
                                    <p>{{$product->inventory_num}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Giá bán: </label>
                                    <p>{{currency_format($product->price)}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Giá cũ: </label>
                                    <p>{{currency_format($product->old_price)}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Giá gốc: </label>
                                    <p>{{currency_format($product->price_cost)}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Thời gian tạo: </label>
                                    <p>{{date('d-m-Y h:m:s',strtotime($product->created_at))}}</p>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Thời gian cập nhật: </label>
                                    <p>{{date('d-m-Y h:m:s',strtotime($product->updated_at))}}</p>
                                </div>
                                <!-- chỉ có chủ hệ thống mới được duyệt -->
                                @if(Auth::user()->permission==1&&$product->status=='not approved yet')
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Trạng thái: </label>
                                    <select name="status" id="" class="form-control">
                                        <option value="not approved yet" <?php echo $product->status == 'not approved yet' ? 'selected' : '' ?>>Chưa được duyệt</option>
                                        <option value="approved" <?php echo $product->status == 'approved' ? 'selected' : '' ?>>Duyệt</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary" style="margin-top: 30px;">Xác nhận</button>
                                </div>
                                @else
                                <div class="col-md-4">
                                    <label for="" class="font-weight-bold">Trạng thái: </label>
                                    <p>{!!show_status($product->status)!!}</p>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
                <h1>{{$product->name}}</h1>
                <hr class="my-4">
                <h6>{!!$product->short_desc!!}</h6>
                <hr class="my-4">
                {!!$product->detail_desc!!}
                <a class="btn btn-secondary" href="{{route('admin.product.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                @endif

            </div>
        </div>

    </div>
    @endsection