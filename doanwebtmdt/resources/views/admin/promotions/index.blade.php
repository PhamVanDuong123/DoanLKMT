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
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách khuyến mãi</h5>
            <div class="form-search form-inline">
                <form action="">
                    @csrf
                    <input type="text" name="key" value="{{request()->key}}" class="form-control form-search" placeholder="Nhập mã khuyến mãi">
                    <button type="submit" id="btn-search-post" name="btn-search-post" class="btn btn-primary">Tìm kiếm <i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.promotion.action')}}" method="post">
                @csrf
                <div class="analytic">
                    <a href="{{request()->fullUrlWithQuery(['status'=>'all','page'=>1])}}" class="text-primary">Tất cả<span class="text-muted">({{$count['all']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'approved','page'=>1])}}" class="text-primary">Được duyệt<span class="text-muted">({{$count['approved']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'not approved yet','page'=>1])}}" class="text-primary">Chưa được duyệt<span class="text-muted">({{$count['not approved yet']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'trash','page'=>1])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count['trash']}})</span></a>
                </div>
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name="action">
                        <option value="">Chức năng</option>
                        @if(!empty($list_action))
                        @foreach($list_action as $k=>$v)
                        <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                        @endif
                    </select>
                    <button type="submit" name="btn-search" class="btn btn-primary">Áp dụng <i class="far fa-check-circle"></i></button>
                </div>
                @if(session('success'))
                <div class="alert alert-success">{!!session('success')!!}</div>
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
                            <th scope="col">Tên</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Giảm giá</th>
                            <th scope="col">Số lượng</th>                            
                            <th scope="col">Bắt đầu</th>
                            <th scope="col">Kết thúc</th>
                            <th scope="col">Trạng thái</th>
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
                            <td><a href="{{route('admin.promotion.detail',$item->id)}}">{{$item->name}}</a></td>
                            <td>{{$item->code}}</td>
                            @if($item->condition==1)
                            <td>{{$item->number}}%</td>
                            @elseif($item->condition==2)
                            <td>{{number_format($item->number,0,',','.')}}đ</td>
                            @endif
                            <td>{{$item->qty}}</td>                            
                            <td>{{date('d-m-Y h:m:s',strtotime($item->start_day))}}</td>
                            <td>{{date('d-m-Y h:m:s',strtotime($item->end_day))}}</td>
                            <td>{!!show_status($item->status)!!}</td>
                            <td>
                                <!-- Chỉ được sửa hoặc xóa các khuyến mãi chưa được duyệt  -->
                                @if($item->status=='not approved yet')
                                <a href="{{route('admin.promotion.edit',['id'=>$item->id,'status'=>request()->status])}}" class="btn btn-success btn-sm rounded-0 text-white action-icon" type="button" data-toggle="tooltip" data-placement="top" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                <a href="{{route('admin.promotion.delete',['id'=>$item->id,'status'=>request()->status])}}" onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi này?')" class="btn btn-danger btn-sm rounded-0 text-white action-icon" type="button" data-toggle="tooltip" data-placement="top" title="{{request()->status=='trash'?'Xóa vĩnh viễn':'Xóa'}}"><i class="fa fa-trash"></i></a>
                                @endif
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