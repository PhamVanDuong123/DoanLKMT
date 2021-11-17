@php
use App\Models\Promotion;

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
$total=0;
$money_promotion=0;
$feeship=$order->shipping_fee?$order->shipping_fee:0;

foreach($order->products as $item){
$total+=$item->pivot->number*$item->pivot->price;
}

$promotion = Promotion::where('code',$order->promotion_code)->first();
if($promotion){
if($promotion['condition']==1){
$money_promotion=$total*$promotion['number']/100;
}else{
$money_promotion=$promotion['number'];
}
}

return $total-$money_promotion+$feeship;
}

function show_status($status){
$list_status=array(
3=>'<span class="badge badge-success">Đã xử lý</span>',
1=>'<span class="badge badge-warning">Chờ xử lý</span>',
0=>'<span class="badge badge-secondary">Bị hủy</span>',
);
return $list_status[$status];
}
@endphp

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
            <h2>Chi tiết đơn hàng</h2>
            <hr>
            @if(!empty($order))
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Mã đơn hàng</label>
                        <p>{{$order->code}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Thời gian đặt</label>
                        <p>{{$order->created_at->format('d-m-Y H:m:s')}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Trạng thái: </label>
                        <p>{!!show_status($order->status)!!}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Giá trị</label>
                        <p>{{currency_format(get_sub_total($order))}}</p>
                    </div>
                </div>
                @if($order->promotion_code)
                @php
                $promotion = Promotion::where('code',$order->promotion_code)->first();
                @endphp
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Mã khuyến mãi</label>
                        <p>{{$order->promotion_code}}</p>
                    </div>
                </div>
                @if($promotion['condition']==1)
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Giá trị giảm:</label>
                        <p>{{$promotion['number']}}%</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Số tiền giảm:</label>
                        <p>{{currency_format(get_sub_total($order)*$promotion['number']/100)}}</p>
                    </div>
                </div>
                @else
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Giá trị giảm:</label>
                        <p>{{currency_format($promotion['number'])}}</p>
                    </div>
                </div>
                @endif
                @endif
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Phí vận chuyển</label>
                        <p>{{currency_format($order->shipping_fee)}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Tổng số tiền</label>
                        <p>{{currency_format(get_total($order))}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Tên người nhận hàng</label>
                        <p>{{$order->name}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Số điện thoại</label>
                        <p>{{$order->phone}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Địa chỉ</label>
                        <p>{{$order->address}}</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Ghi chú</label>
                        <p>{{$order->note}}</p>
                    </div>
                </div>
            </div>
            <a target="_blank" class="btn btn-warning" href="{{route('history.print_order',$order->code)}}">In đơn hàng <i class="fas fa-print"></i></a>
            <a class="btn btn-secondary" href="{{route('history.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
            <hr>
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
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $t=0; @endphp
                                    @foreach($order->products as $item)
                                    @php $t++; @endphp
                                    <tr>
                                        <th scope="row">{{$t}}</th>
                                        <td><a href="{{route('product.detail',$item->pivot->product_id)}}">{{$item->name}}</a></td>
                                        <td>{{currency_format($item->pivot->price)}}</td>
                                        <td>{{$item->pivot->number}}</td>
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
        <div class="sidebar fl-left">
            @include('layout.sb-cate-pro')
            @include('layout.sb-filter-pro')
        </div>
    </div>
</div>
@endsection