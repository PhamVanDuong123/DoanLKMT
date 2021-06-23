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
@endphp
@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    @if(!empty($order))
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Xử lý đơn hàng
                </div>
                <div class="card-body">
                    <form action="{{route('admin.order.process',$order->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="code">Mã đơn hàng</label>
                                    <input type="text" id="code" class="form-control" value="{{$order->code}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="created_at">Thời gian đặt</label>
                                    <input type="text" id="created_at" class="form-control" value="{{$order->created_at}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="shipping_fee">Phí vận chuyển</label>
                                    <input type="text" id="shipping_fee" class="form-control" value="{{currency_format($order->shipping_fee)}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sub_total">Giá trị</label>
                                    <input type="text" id="sub_total" class="form-control" value="{{currency_format(get_sub_total($order))}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="total">Tổng số tiền</label>
                                    <input type="text" id="total" class="form-control" value="{{currency_format(get_total($order))}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promotion_code">Mã khuyến mãi</label>
                                    <input type="text" id="promotion_code" class="form-control" value="{{$order->promotion_code}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Trạng thái đơn hàng</label>
                                    <select class="form-control" id="" name="status">
                                        <option value="">Chọn</option>
                                        <option value="processing" {{$order->status=='processing'?'selected':''}}>Đang xử lý</option>
                                        <option value="being transported" {{$order->status=='being transported'?'selected':''}}>Đã xử lý</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Tên khách hàng</label>
                                    <input type="text" id="name" class="form-control" value="{{$order->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="number" id="phone" class="form-control" value="{{$order->phone}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="note">Ghi chú</label>
                                    <textarea name="note" id="note" class="form-control" cols="30" rows="3" disabled>{{$order->note}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <textarea name="phone" id="address" class="form-control" cols="30" rows="3" disabled>{{$order->address}}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{route('admin.order.exit',$order->id)}}" type="submit" class="btn btn-danger">Thoát</a>
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
                                <td>{{$item->name}}</td>
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