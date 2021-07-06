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
                    <div class="col-md-3">
                        <label for="" class="font-weight-bold">Hình ảnh: </label>
                        <img class="avatar_detial" src="{{asset($promotion->thumb)}}" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="font-weight-bold">Tên: </label>
                                <p>{{$promotion->name}}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="font-weight-bold">Mã: </label>
                                <p>{{$promotion->code}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Bắt đầu: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($promotion->start_day))}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Kết thúc: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($promotion->end_day))}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Phần trăm giảm: </label>
                                <p>{{$promotion->percents}}%</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Số lượng: </label>
                                <p>{{$promotion->number}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Trạng thái: </label>
                                <p>{!!show_status($promotion->status)!!}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Thời gian tạo: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($promotion->created_at))}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Thời gian cập nhật: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($promotion->updated_at))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="font-weight-bold">Mô tả: </label>
                        <p>{!!$promotion->description!!}</p>
                    </div>                    
                    @endif
                    <a class="btn btn-secondary" href="{{route('admin.post.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection