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
            Chi tiết thương hiệu
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    @if(!empty($brand))
                    <div class="col-md-3">
                        <label for="" class="font-weight-bold">Logo: </label>
                        <img class="avatar_detial" src="{{asset($brand->logo)}}" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Tên: </label>
                                <p>{{$brand->name}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Phone: </label>
                                <p>{{$brand->phone}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Email: </label>
                                <p>{{$brand->email}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Địa chỉ: </label>
                                <p>{{$brand->address}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Quốc gia: </label>
                                <p>{{$brand->country}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Website: </label>
                                <p>{{$brand->website}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Trạng thái: </label>
                                <p>{!!show_status($brand->status)!!}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Thời gian tạo: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($brand->created_at))}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Thời gian cập nhật: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($brand->updated_at))}}</p>
                            </div>
                        </div>
                    </div>            
                    @endif
                    <a class="btn btn-secondary" href="{{route('admin.brand.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection