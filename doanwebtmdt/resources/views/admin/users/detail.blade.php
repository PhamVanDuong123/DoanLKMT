@php
function show_permission($permission){
$list_per=array(
'1'=>'Chủ hệ thống',
'2'=>'Quản trị',
'3'=>'Nhân viên bán hàng'
);
return $list_per[$permission];
}

function show_gender($gender){
$list_gender=array(
'male'=>'Nam',
'female'=>'Nữ'
);
return $list_gender[$gender];
}

@endphp
@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chi tiết thành viên
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    @if(!empty($user))
                    <div class="col-md-3">
                        <img class="avatar_detial" src="{{asset($user->avatar)}}" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Họ tên: </label>
                                <p>{{$user->fullname}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Email: </label>
                                <p>{{$user->email}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Số điện thoại: </label>
                                <p>{{$user->phone}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Giới tính: </label>
                                <p>{{show_gender($user->gender)}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Ngày sinh: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($user->dob))}}</p>
                            </div>                            
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Quyền: </label>
                                <p>{{show_permission($user->permission)}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Thời gian đăng ký: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($user->created_at))}}</p>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="font-weight-bold">Thời gian cập nhật: </label>
                                <p>{{date('d-m-Y h:m:s',strtotime($user->updated_at))}}</p>
                            </div>
                            <div class="col-md-12">
                                <label for="" class="font-weight-bold">Địa chỉ: </label>
                                <p>{{$user->address}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <a class="btn btn-secondary my-3" href="{{route('admin.post.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection