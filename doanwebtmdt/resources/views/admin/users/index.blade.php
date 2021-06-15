@extends('layoutadmin.master')

@php
function show_permission($permission){
$list_per=array(
'1'=>'Boss',
'2'=>'Admin',
'3'=>'Sale'
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

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="">
                    @csrf
                    <input type="text" name="key" value="{{request()->key}}" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active','page'=>1])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count['active']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trash','page'=>1])}}" class="text-primary">Vô hiệu hóa<span class="text-muted">({{$count['trash']}})</span></a>
            </div>
            <form action="{{route('admin.user.action')}}" method="get">
            @csrf
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="action">
                    <option value="">Chọn</option>
                    @if(!empty($list_action))
                    @foreach($list_action as $k=>$v)
                    <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                    @endif
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
            @endif

            @if($list_user->total()>0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">STT</th>
                        <th scope="col">Ảnh đại diện</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php $t=0; @endphp
                    @foreach($list_user as $item)
                    @php $t++; @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="list_user_id[]" value="{{$item->id}}">
                        </td>
                        <th scope="row">{{$t}}</th>
                        <td><img class="avatar" src="{{asset($item->avatar)}}" alt=""></td>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->gender?show_gender($item->gender):''}}</td>
                        <td>{{$item->dob}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->permission?show_permission($item->permission):''}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <!-- Nếu quyền user đang đn không phải boss hoặc admin, user trùng với user đang đn, quyền của user là boss thì không đc cập nhật quyền -->
                            @if((Auth::user()->permission==1 || Auth::user()->permission==2) && $item->id!=Auth::id() && $item->permission!=1)
                            <a href="{{route('admin.user.editPermission',['id'=>$item->id,'status'=>request()->status])}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Cập nhật quyền"><i class="fa fa-edit"></i></a>
                            @endif  
                            <!-- Nếu quyền user đang đn không phải boss hoặc admin, user trùng với user đang đn, quyền của user là boss thì không đc xóa -->
                            @if((Auth::user()->permission==1 || Auth::user()->permission==2) && $item->id!=Auth::id() && $item->permission!=1)
                            <a href="{{route('admin.user.delete',['id'=>$item->id,'status'=>request()->status])}}" onclick="return confirm('Bạn có chắc muốn xóa thành viên này không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="{{request()->status=='trash'?'Xóa vĩnh viễn':'Xóa'}}"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$list_user->appends(request()->all())->links()}}
            @else
            <p class="text-center">Không có thành viên nào trong hệ thống</p>
            @endif
            </form>
        </div>
    </div>
</div>
@endsection