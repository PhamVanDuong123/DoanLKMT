@extends('layoutadmin.master')
@php
function show_gender($gender){
if(!empty($gender)){
$list_gender=array(
'male'=>'Nam',
'female'=>'Nữ'
);
return $list_gender[$gender];
}
}
@endphp
@section('content')
<style>
    .statistical_title {
        font-size: 20px;
    }

    #btn-dashboard-fillter {
        margin-top: 23px;
    }

    p.fillter {
        margin-bottom: 0;
    }
</style>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0">Thống kê bán hàng</h5>
        </div>
        <div class="card-body">
            <div class="row d-block">
                <p class="text-center font-weight-bold statistical_title">Thống kê doanh số</p>
                <form action="" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <p>Từ ngày: <input type="text" name="" id="datepicker" class="form-control"></p>
                        </div>
                        <div class="col-md-3">
                            <p>Đến ngày: <input type="text" name="" id="datepicker2" class="form-control"></p>
                        </div>
                        <div class="col-md-3">
                            <input type="button" id="btn-dashboard-fillter" class="btn btn-primary" value="Lọc kết quả">
                        </div>
                        <div class="col-md-3">
                            <p class="fillter">Lọc theo: </p>
                            <select name="statistical_fillter" id="statistical_fillter" class="form-control">
                                <option value="">-- Chọn --</option>
                                <option value="7day">7 ngày qua</option>
                                <option value="in_month">Tháng này</option>
                                <option value="last_month">Tháng trước</option>
                                <option value="in_year">Trong năm</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="col-md-12">
                    <div id="chart" style="height: 250px;"></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6 col-xs-12">
                    <p class="text-center font-weight-bold statistical_title">Top 5 sản phẩm bán chạy nhất</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($top5_product_selling))
                            @php $i=0; @endphp
                            @foreach($top5_product_selling as $item)
                            @php $i++; @endphp
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td><img class="thumb-post-mini" src="{{$item->product->thumb}}" alt=""></td>
                                <td><a href="{{route('admin.product.detail',$item->product_id)}}">{{$item->product->name}}</a></td>
                                <td>{{$item->total}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$top5_product_selling->appends(request()->all())->links()}}
                </div>
                <div class="col-md-6 col-xs-12">
                    <p class="text-center font-weight-bold statistical_title">Top 5 sản phẩm bán chậm nhất</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($top5_slow_product_selling))
                            @php $i=0; @endphp
                            @foreach($top5_slow_product_selling as $item)
                            @php $i++; @endphp
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td><img class="thumb-post-mini" src="{{$item->product->thumb}}" alt=""></td>
                                <td><a href="{{route('admin.product.detail',$item->product_id)}}">{{$item->product->name}}</a></td>
                                <td>{{$item->total}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$top5_slow_product_selling->appends(request()->all())->links()}}
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <p class="text-center font-weight-bold statistical_title">Sản phẩm xem nhiều nhất</p>
                    <ol>
                        @foreach($products_best_view as $item)
                        <li><a href="{{route('admin.product.detail',$item->id)}}">{{$item->name}} | {{$item->views}} lượt xem</a></li>
                        @endforeach
                    </ol>
                </div>
                <div class="col-md-6">
                    <p class="text-center font-weight-bold statistical_title">Khách hàng mua nhiều hàng nhất</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Đơn hàng</th>
                                <th scope="col">Sản phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($list_customer))
                            @php $i=0; @endphp
                            @foreach($list_customer as $item)
                            @php $i++; @endphp
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td><img class="thumb-post-mini" src="{{url($item->user->avatar)}}" alt=""></td>
                                <td scope="row"><a href="{{route('admin.user.detail',$item->user->id)}}">{{$item->user->fullname}}</a></td>
                                <td scope="row">{{$item->user->phone}}</td>
                                <td scope="row">{{$item->user->address}}</th>
                                <td scope="row">{{$total_order[$i-1]['total_order']}}</th>
                                <td scope="row">{{$item->total_product}}</th>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$list_customer->appends(request()->all())->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection