@php
function show_status($status){
$list_status=array(
'approved'=>'<span class="badge badge-success">Được duyệt</span>',
'not approved yet'=>'<span class="badge badge-danger">Chưa được duyệt</span>',
);
return $list_status[$status];
}
@endphp
@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chi tiết khuyến mãi
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    @if(!empty($promotion))
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Tên: </label>
                        <p>{{$promotion->name}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Mã: </label>
                        <p>{{$promotion->code}}</p>
                    </div>                    
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Giảm giá: </label>
                        @if($promotion->condition==1)
                        <p>{{$promotion->number}}%</p>
                        @elseif($promotion->condition==2)
                        <p>{{number_format($promotion->number,0,',','.')}}đ</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Số lượng: </label>
                        <p>{{$promotion->qty}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Bắt đầu: </label>
                        <p>{{date('d-m-Y h:m:s',strtotime($promotion->start_day))}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Kết thúc: </label>
                        <p>{{date('d-m-Y h:m:s',strtotime($promotion->end_day))}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Trạng thái: </label>
                        <p>{!!show_status($promotion->status)!!}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Thời gian tạo: </label>
                        <p>{{date('d-m-Y h:m:s',strtotime($promotion->created_at))}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Thời gian cập nhật: </label>
                        <p>{{date('d-m-Y h:m:s',strtotime($promotion->updated_at))}}</p>
                    </div>
                    @endif
                    <div class="col-md-12">
                        <a class="btn btn-secondary" href="{{route('admin.promotion.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection