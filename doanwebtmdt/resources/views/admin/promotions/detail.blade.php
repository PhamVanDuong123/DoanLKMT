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
            Chi tiết khuyến mãi
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{!!session('success')!!}</div>
            @elseif(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="container">
                <form action="{{route('admin.promotion.approve_promo',$promotion->id)}}" method="post">
                    @csrf
                    <div class="row">
                        @if(!empty($promotion))
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Tên: </label>
                            <p>{{$promotion->name}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Mã: </label>
                            <p>{{$promotion->code}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Giảm giá: </label>
                            @if($promotion->condition==1)
                            <p>{{$promotion->number}}%</p>
                            @elseif($promotion->condition==2)
                            <p>{{number_format($promotion->number,0,',','.')}}đ</p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Số lượng: </label>
                            <p>{{$promotion->qty}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Bắt đầu: </label>
                            <p>{{date('d-m-Y h:m:s',strtotime($promotion->start_day))}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Kết thúc: </label>
                            <p>{{date('d-m-Y h:m:s',strtotime($promotion->end_day))}}</p>
                        </div>
                        <!-- chỉ có chủ hệ thống mới được duyệt -->
                        @if(Auth::user()->permission==1&&$promotion->status=='not approved yet')
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Trạng thái: </label>
                            <select name="status" id="" class="form-control">
                                <option value="not approved yet" <?php echo $promotion->status == 'not approved yet' ? 'selected' : '' ?>>Chưa được duyệt</option>
                                <option value="approved" <?php echo $promotion->status == 'approved' ? 'selected' : '' ?>>Duyệt</option>
                            </select>
                        </div>
                        @else
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Trạng thái: </label>
                            <p>{!!show_status($promotion->status)!!}</p>
                        </div>
                        @endif
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Thời gian tạo: </label>
                            <p>{{date('d-m-Y h:m:s',strtotime($promotion->created_at))}}</p>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold">Thời gian cập nhật: </label>
                            <p>{{date('d-m-Y h:m:s',strtotime($promotion->updated_at))}}</p>
                        </div>
                        @endif
                        @if(Auth::user()->permission==1)
                        <div class="col-md-1">
                            <button class="btn btn-primary" style="margin-top: 30px;">Xác nhận</button>
                        </div>
                        @endif
                        <div class="col-md-1">
                            <a class="btn btn-secondary" style="margin-top: 30px;" href="{{route('admin.promotion.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection