@php
function currency_format($currency,$innit='đ'){
return number_format($currency,0,',','.').$innit;
}

function get_sub_total($order){
$total=0;
foreach($order->products as $item){
$total+=$item->pivot->number*$item->pivot->price;
}
return $total;
}

function get_total($order){
return get_sub_total($order)+$order->shipping_fee;
}

function show_status($status){
$list_status=array(
2=>'<span class="badge badge-success">Đã xử lý</span>',
1=>'<span class="badge badge-warning">Chờ xử lý</span>',
);
return $list_status[$status];
}
@endphp

@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    @if(!empty($order))
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                @if($action=='process') 
                    Xử lý đơn hàng
                @else
                    Chi tiết đơn hàng
                @endif
                </div>
                <div class="card-body">
                    <form action="{{route('admin.order.process',$order->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold">Mã đơn hàng</label>
                                    <p>{{$order->code}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold">Thời gian đặt</label>
                                    <p>{{$order->created_at}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold">Giá trị</label>
                                    <p>{{currency_format(get_sub_total($order))}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold">Mã khuyến mãi</label>
                                    <p>{{$order->promotion_code}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold">Phí vận chuyển</label>
                                    <p>{{currency_format($order->shipping_fee)}}</p>
                                </div>
                            </div>                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tổng số tiền</label>
                                    <p>{{currency_format(get_total($order))}}</p>
                                </div>
                            </div>                            
                            <div class="col-md-2">
                                @if($action=='process')
                                <div class="form-group">
                                    <label for="">Trạng thái đơn hàng</label>
                                    <select class="form-control" id="" name="status">
                                        <option value="">-- Chọn --</option>
                                        <option value="1" {{$order->status==1?'selected':''}} {{$order->status==2?'disabled':''}}>Đang xử lý</option>
                                        <option value="2" {{$order->status=='2'?'selected':''}}>Đã xử lý</option>
                                    </select>
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Trạng thái: </label>
                                    <p>{!!show_status($order->status)!!}</p>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tên khách hàng</label>
                                    <p>{{$order->name}}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="font-weight-bold">Số điện thoại</label>
                                    <p>{{$order->phone}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Địa chỉ</label>
                                    <p>{{$order->address}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Ghi chú</label>
                                    <p>{{$order->note}}</p>
                                </div>
                            </div>
                        </div>
                        @if($action=='process')
                        <button type="submit" class="btn btn-primary">Cập nhật <i class="fa fa-edit"></i></button>
                        @endif
                        <a target="_blank" class="btn btn-warning" href="{{route('admin.order.print_order',$order->code)}}">In đơn hàng <i class="fas fa-print"></i></a>
                        <a class="btn btn-secondary" href="{{route('admin.order.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách sản phẩm
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tồn kho</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $t=0; @endphp
                            @foreach($order->products as $item)
                            @php $t++; @endphp
                            <tr>
                                <th scope="row">{{$t}}</th>
                                <td><a href="{{route('admin.product.detail',$item->pivot->product_id)}}">{{$item->name}}</a></td>
                                <td>{{currency_format($item->pivot->price)}}</td>
                                <td>{{$item->pivot->number}}</td>
                                <td>{{$item->inventory_num}}</td>
                                <td>{{currency_format($item->pivot->price*$item->pivot->number)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection