@php
function count_num_pro_in_order($order){
$count=0;
foreach($order->products as $item){
$count+=$item->pivot->number;
}
return $count;
}

function get_total_order($order){
$total=0;
foreach($order->products as $item){
$total+=$item->pivot->number*$item->pivot->price;
}
return number_format($total,0,',','.');
}

function show_status($status){
if(!empty($status)){
$list_status=array(
0=>'<span class="badge badge-secondary">Bị hủy</span>',
1=>'<span class="badge badge-warning">Chờ xử lý</span>',
2=>'<span class="badge badge-primary">Đã xử lý</span>',
);
return $list_status[$status];
}
}
@endphp

@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search-sale form-inline">
                <form action="" class="form-action">
                    @csrf
                    <select name="search_option" class="form-control" id="search-option">
                        <option value="code" {{request()->search_option=='code'?'selected':''}}>Mã đơn hàng</option>
                        <option value="name" {{request()->search_option=='name'?'selected':''}}>Tên khách hàng</option>
                        <option value="date" {{request()->search_option=='date'?'selected':''}}>Ngày đặt</option>
                    </select>
                    <input type="text" id="key" name="key" value="{{request()->key}}" class="form-control form-search" placeholder="Nhập mã đơn hàng">
                    <button type="submit" id="btn-search-order" name="btn-search-order" class="btn btn-primary">Tìm kiếm <i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'all','page'=>1])}}" class="text-primary">Tất cả<span class="text-muted">({{$count['all']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'processing','page'=>1])}}" class="text-primary">Chờ xử lý<span class="text-muted">({{$count['processing']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'processed','page'=>1])}}" class="text-primary">Đã xử lý<span class="text-muted">({{$count['processed']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'cancelled','page'=>1])}}" class="text-primary">Bị hủy<span class="text-muted">({{$count['cancelled']}})</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <form action="" method="get">
                    @csrf
                    <select class="form-control mr-1" id="" name="fillter">
                        <option value="">Lọc đơn hàng</option>
                        <option value="today">Đơn hàng trong ngày</option>
                        <option value="in_month">Đơn hàng trong tháng</option>
                    </select>
                    <button type="submit" name="btn-search" class="btn btn-primary">Áp dụng <i class="fas fa-filter"></i></button>
                </form>
            </div>
            @if($list_order->total()>0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">STT</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
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
                        <td><a href="{{route('admin.order.detail',$item->id)}}">{{$item->code}}</a></td>
                        <td>{{$item->name}}</td>
                        <td>{{count_num_pro_in_order($item)}}</td>
                        <td>{{get_total_order($item)}}đ</td>
                        <td>{{date('d-m-Y h:m:s',strtotime($item->created_at))}}</td>
                        <td>{!!show_status($item->status)!!}</td>
                        <td>
                            <!-- Chỉ xử lý đơn hàng trạng thái chờ xử lý -->
                            @if($item->status==1)
                            <a href="{{route('admin.order.process',['id'=>$item->id])}}" class="btn btn-success btn-sm rounded-0 text-white action-icon" type="button" data-toggle="tooltip" data-placement="top" title="Xử lý đơn hàng"><i class="fa fa-edit"></i></a>
                            @endif
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
    </div>
</div>
@endsection