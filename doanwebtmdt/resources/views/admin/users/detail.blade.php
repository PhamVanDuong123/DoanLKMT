@php
function show_permission($permission){
if(!empty($permission)){
$list_per=array(
'1'=>'<span class="badge badge-danger">Chủ hệ thống</span>',
'2'=>'<span class="badge badge-info">Quản trị</span>',
'3'=>'<span class="badge badge-success">Nhân viên bán hàng</span>',
);
return $list_per[$permission];
}
}

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
@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            @if($action=='detail')
            Chi tiết thành viên
            @elseif($action=='update')
            Cập nhật thành viên
            @endif
        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{route('admin.user.update',$user->id)}}" method="post">
                    @csrf
                    <div class="row">
                        @if(!empty($user))
                        <div class="col-md-3">
                            <img class="avatar_detial" src="{{isset($user->avatar)?asset($user->avatar): url('public/uploads/no-avatar.png')}}" alt="">
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
                                @if($action=='detail')
                                <div class="col-md-3">
                                    <label for="" class="font-weight-bold">Quyền: </label>
                                    <p>{!!show_permission($user->permission)!!}</p>
                                </div>
                                @elseif($action=='update')
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">Quyền</label>
                                        <select class="form-control" id="" name="permission">
                                            <option value="">Chọn quyền</option>
                                            <option value="2" {{$user->permission==2?"selected='selected'":''}}>Nhân viên quản trị</option>
                                            <option value="3" {{$user->permission==3?"selected='selected'":''}}>Nhân viên bán hàng</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
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
                        <div class="col-md-12 mt-3">
                            @if($action=='update')
                            <button type="submit" class="btn btn-primary">Cập nhật <i class="fa fa-edit"></i></button>
                            @endif
                            <a class="btn btn-secondary" href="{{route('admin.user.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection