@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật quyền thành viên
        </div>
        <div class="card-body">
            @if(!empty($user))
            <form action="{{route('admin.user.updatePermission',['id'=>$user->id,'status'=>request()->status])}}" method="post">
                @csrf
                <div class="container-fluild">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Họ và tên</label>
                                <input class="form-control" type="text" name="fullname" id="fullname" value="{{$user->fullname}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input class="form-control" type="phone" name="phone" id="phone" value="{{$user->phone}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input class="form-control" type="password" name="password" id="password" value="{{$user->password}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Quyền</label>
                                <select class="form-control" id="" name="permission">
                                    <option value="">Chọn quyền</option>
                                    <option value="2" {{$user->permission==2?"selected='selected'":''}}>Nhân viên quản trị</option>
                                    <option value="3" {{$user->permission==3?"selected='selected'":''}}>Nhân viên bán hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">Ngày sinh</label>
                                <input class="form-control" type="date" name="dob" id="dob" value="{{$user->dob}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <textarea name="address" id="address" class="form-control" rows="3" disabled>{{$user->address}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="avatar">Ảnh đại diện</label>
                                <div class="container-fluild">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <img class="avatar-edit" src="{{asset($user->avatar)}}" alt="">
                                    </div>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender">Giới tính</label>
                                <div class="form-check">
                                    <input type="radio" name="gender" value="male" id="male" class="form-check-input" disabled {{$user->gender=='male'?"checked='checked'":''}}>
                                    <label for="male" class="form-check-label">Nam</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="gender" value="female" id="female" class="form-check-input" disabled {{$user->gender=='female'?"checked='checked'":''}}>
                                    <label for="male" class="form-check-label">Nữ</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection