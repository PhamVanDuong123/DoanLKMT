@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách Thương Hiệu</h5>
            <div class="form-search form-inline">
                <form action="">
                    @csrf
                    <input type="text" name="key" class="form-control form-search" placeholder="Tìm kiếm" value="{{request()->key}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active','page'=>1])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count['active']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trash','page'=>1])}}" class="text-primary">Thùng rác<span class="text-muted">({{$count['trash']}})</span></a>
            </div>
            <form action="{{route('admin.brand.action')}}" method="post">
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
                <div class="alert alert-success">{{session('success')}}</div>
                @elseif(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                @if($list_Brand->total()>0)
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Tên thương hiệu</th>
                            <th scope="col" style="width: 14rem;">SDT</th>
                            <th scope="col" style="width: 18rem;">Email</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Quốc gia</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Website</th>
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col">Ngày xóa</th>
                            <th scope="col">Tác vụ</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        @php $t=0; @endphp
                        @foreach($list_Brand as $item)
                        @php $t++; @endphp
                        <tr>
                            <td>
                                <input type="checkbox" name="list_brand_id[]" value="{{$item->id}}">
                            </td>
                            <td scope="row">{{$t}}</td>
                          
                            <td><a href="{{route('admin.brand.detail',$item->id)}}">{{$item->name}}</a></td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->country}}</td>
                            <td><img class="thumb-post" src="{{$item->logo}}" alt=""></td>
                            <td>{{$item->website}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>{{$item->deleted_at}}</td>
                            <td>
                                <a href="{{route('admin.brand.edit',['id'=>$item->id,'status'=>request()->status])}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                <a href="{{route('admin.brand.delete',['id'=>$item->id,'status'=>request()->status])}}" onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="{{request()->status=='trash'?'Xóa vĩnh viễn':'Xóa'}}"><i class="fa fa-trash"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$list_Brand->appends(request()->all())->links()}}
                @else
                <p class="text-center">Không có sản phẩm nào</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection