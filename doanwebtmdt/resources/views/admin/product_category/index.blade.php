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
            <h5 class="m-0 ">Danh sách loại sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="">
                    @csrf                    
                    <input type="text" name="key" value="{{request()->key}}" class="form-control form-search" placeholder="Nhập tên loại sản phẩm">
                    <button type="submit" id="btn-search-post" name="btn-search-post" class="btn btn-primary">Tìm kiếm <i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
           
            <form action="{{route('admin.product_category.action')}}" method="post">
            {{ csrf_field() }}
                <div class="analytic">
                    <a href="{{request()->fullUrlWithQuery(['status'=>'active','page'=>1])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count['active']}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'trash','page'=>1])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count['trash']}})</span></a>
                </div>
           
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="action">
                    <option value="">Chọn</option>
                    @foreach($list_action as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
                <button type="submit" name="btn-search" class="btn btn-primary">Áp dụng <i class="far fa-check-circle"></i></button>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{!!session('success')!!}</div>
                @elseif(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
            @if($list_product_category->total()>0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Người tạo</th> 
                        <th scope="col">Ngày tạo</th> 
                        <th scope="col">Tác vụ</th> 
                    </tr>
                </thead>
                <tbody>
                    @php $t=0; @endphp
                    @foreach($list_product_category as $item)
                    @php $t++; @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="list_product_category_id[]" value="{{$item->id}}">
                        </td>
                        <th scope="row">{{$t}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->user->fullname}}</td>
                        <td>{{date('d-m-Y h:m:s',strtotime($item->created_at))}}</td>
                        <td>
                            <a href="{{route('admin.product_category.edit',['id'=>$item->id,'status'=>request()->status])}}"class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                        
                            <a href="{{route('admin.product_category.deletecategory',['id'=>$item->id,'status'=>request()->status])}}" onclick="return confirm('Bạn có chắc muốn xóa danh mục sản phẩm này không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="{{request()->status=='trash'?'Xóa vĩnh viễn':'Xóa'}}"><i class="fa fa-trash"></i></a>
                        </td>
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$list_product_category->appends(request()->all())->links()}}
                @else
                <p class="text-center">Không có loại sản phẩm nào</p>    
            @endif
            </form>
        </div>
    </div>
</div>
@endsection
