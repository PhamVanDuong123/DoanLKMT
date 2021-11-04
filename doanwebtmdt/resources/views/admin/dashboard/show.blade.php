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

function currency_format($currency,$innit='đ'){
return number_format($currency,0,',','.').$innit;
}
@endphp

@extends('layoutadmin.master')

@section('content')
<div class="container-fluid py-5">
    <div class="card">
        <div class="card-header font-weight-bold">
            TỔNG QUAN
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">ĐƠN HÀNG ĐÃ XỬ LÝ</div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$num_order_success}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">ĐANG CHỜ XỬ LÝ</div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$num_order_processing}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">TỔNG DOANH THU</div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{currency_format($revenue)}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">ĐƠN HÀNG HỦY</div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$num_order_cancelled}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header font-weight-bold">
            HÔM NAY
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">DOANH THU</div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{currency_format($revenue_today)}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">LỢI NHUẬN</div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{currency_format($profit_today)}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">DOANH SỐ</div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$qty_today}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">ĐƠN HÀNG</div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$order_today}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            @if($list_new_order->total()>0)
            <table class="table table-striped">
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
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian đặt</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php $t=0; @endphp
                    @foreach($list_new_order as $item)
                    @php $t++; @endphp
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>{{$t}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{count_num_pro_in_order($item)}}</td>
                        <td>{{get_total_order($item)}}đ</td>
                        <td>{!!show_status($item->status)!!}</td>
                        <td>{{$item->created_at}}</td>
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
            {{$list_new_order->appends(request()->all())->links()}}
            @else
            <p class="text-center">Không có đơn hàng mới nào</p>
            @endif
        </div>
    </div>

</div>
@endsection