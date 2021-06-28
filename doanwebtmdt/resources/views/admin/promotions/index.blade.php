@php
function show_status($status){
$list_status=array(
'approved'=>'Được duyệt',
'not approved yet'=>'Chưa được duyệt'
);
return $list_status[$status];
}
@endphp

@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách khuyến mãi</h5>
            <div class="form-search form-inline">
                <form action="">
                    @csrf
                    <input type="text" name="key" value="{{request()->key}}" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.promotion.action')}}" method="post">
                @csrf
                <div class="analytic">
                    <a href="{{request()->fullUrlWithQuery(['status'=>'all','page'=>1])}}" class="text-primary">Tất cả<span class="text-muted">({{$count['all']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'not approved yet','page'=>1])}}" class="text-primary">Chưa được duyệt<span class="text-muted">({{$count['not approved yet']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'approved','page'=>1])}}" class="text-primary">Được duyệt<span class="text-muted">({{$count['approved']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'trash','page'=>1])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count['trash']}})</span></a>
                </div>
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
                <div class="alert alert-success">{{session('success')}}</div>
                @elseif(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                @if($list_promotion->total()>0)
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Tên khuyến mãi</th>
                            <th scope="col">Mã khuyến mãi</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Phần trăm giảm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày bắt đầu</th>
                            <th scope="col">Ngày kết thúc</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col">Ngày xóa</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $t=0; @endphp
                        @foreach($list_promotion as $item)
                        @php $t++; @endphp
                        <tr>
                            <td>
                                <input type="checkbox" name="list_promotion_id[]" value="{{$item->id}}">
                            </td>
                            <th scope="row">{{$t}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->code}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->percents}}%</td>
                            <td>{{$item->number}}</td>
                            <td>{{show_status($item->status)}}</td>
                            <td>{{$item->start_day}}</td>
                            <td>{{$item->end_day}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>{{$item->deleted_at}}</td>
                            <td>
                                <a href="{{route('admin.promotion.edit',['id'=>$item->id,'status'=>request()->status])}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                <a href="{{route('admin.promotion.delete',['id'=>$item->id,'status'=>request()->status])}}" onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi này?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="{{request()->status=='trash'?'Xóa vĩnh viễn':'Xóa'}}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$list_promotion->appends(request()->all())->links()}}
                @else
                <p class="text-center">Không có khuyến mãi nào!</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection