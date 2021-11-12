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
                    <input type="text" name="key" value="{{request()->key}}" class="form-control form-search" placeholder="Nhập mã khuyến mãi">
                    <button type="submit" id="btn-search-post" name="btn-search-post" class="btn btn-primary">Tìm kiếm <i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{!!session('success')!!}</div>
            @elseif(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            @if($list_promo_not_approve->total()>0)
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
                    </tr>
                </thead>
                <tbody>
                    @php $t=0; @endphp
                    @foreach($list_promo_not_approve as $item)
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$list_promo_not_approve->appends(request()->all())->links()}}
            @else
            <p class="text-center">Không có khuyến mãi nào!</p>
            @endif
        </div>
    </div>
</div>
@endsection