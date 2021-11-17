@php
use App\Models\Promotion;

function count_num_pro_in_order($order){
$count=0;
foreach($order->products as $item){
$count+=$item->pivot->number;
}
return $count;
}

function get_total_order($order){

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

return number_format($total-$money_promotion+$feeship,0,',','.');
}

function show_status($status){
if(!empty($status)){
$list_status=array(
3=>'<span class="badge badge-secondary">Bị hủy</span>',
1=>'<span class="badge badge-warning">Chờ xử lý</span>',
2=>'<span class="badge badge-success">Đã xử lý</span>',
);
return $list_status[$status];
}
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
            <h2>Lịch sử mua hàng</h2>
            @if($list_order->total()>0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">STT</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Số sản phẩm</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Thời gian đặt</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php $t=0; @endphp
                    @foreach($list_order as $item)
                    @php $t++; @endphp
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>{{$t}}</td>
                        <td><a href="{{route('history.detail',['id'=>$item->id])}}">{{$item->code}}</a></td>
                        <td>{{count_num_pro_in_order($item)}}</td>
                        <td>{{get_total_order($item)}}đ</td>
                        <td>{{date('d-m-Y h:m:s',strtotime($item->created_at))}}</td>
                        <td>{!!show_status($item->status)!!}</td>
                        <td>
                            <a href="{{route('history.detail',['id'=>$item->id])}}" class="btn btn-success btn-sm rounded-0 text-white action-icon" type="button" data-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="fa fa-info"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$list_order->appends(request()->all())->links()}}
            @else
            <p class="text-center">Không có đơn hàng nào</p>
            @endif
        </div>
        <div class="sidebar fl-left">
            @include('layout.sb-cate-pro')
            @include('layout.sb-filter-pro')
        </div>
    </div>
</div>
@endsection