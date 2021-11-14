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
    <div class="jumbotron py-4">
        @if(!empty($post))
        @if(session('success'))
        <div class="alert alert-success">{!!session('success')!!}</div>
        @elseif(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <div class="container">
            <form action="{{route('admin.post.approve_post',$post->id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h5>Tác giả: {{$post->user->fullname}}</h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Danh mục: {{$post->post_category->name}}</h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Thời gian đăng: {{date('d-m-Y h:m:s',strtotime($post->created_at))}}</h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Thời gian cập nhật: {{date('d-m-Y h:m:s',strtotime($post->updated_at))}}</h5>
                    </div>
                    <hr class="my-4">
                    <!-- chỉ có chủ hệ thống mới được duyệt bài viết  -->
                    @if(Auth::user()->permission==1&&$post->status=='not approved yet')
                    <div class="col-md-3">
                        <label for="" class="font-weight-bold">Trạng thái: </label>
                        <select name="status" id="" class="form-control">
                            <option value="not approved yet" <?php echo $post->status == 'not approved yet' ? 'selected' : '' ?>>Chưa được duyệt</option>
                            <option value="approved" <?php echo $post->status == 'approved' ? 'selected' : '' ?>>Duyệt</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" style="margin-top: 30px;">Xác nhận</button>
                    </div>
                    @else
                    <div class="col-md-6">
                        <h5>Trạng thái: {!!show_status($post->status)!!}</h5>
                    </div>
                    @endif
                </div>
            </form>
        </div>
        <hr class="my-4">
        <h1>{{$post->name}}</h1>
        {!!$post->content!!}
        <hr class="my-4">
        <a class="btn btn-secondary" href="{{route('admin.post.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
        @endif
    </div>
</div>
@endsection