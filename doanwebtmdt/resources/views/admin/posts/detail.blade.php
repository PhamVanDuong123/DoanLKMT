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
        
        <div class="container">
            <div class="row">
                <div class="col-md-4"><h5>Tác giả: {{$post->user->fullname}}</h5></div>
                <div class="col-md-4"><h5>Danh mục: {{$post->post_category->name}}</h5></div>
                <div class="col-md-4"><h5>Trạng thái: {!!show_status($post->status)!!}</h5></div>
                <div class="col-md-6"><h5>Thời gian đăng: {{date('d-m-Y h:m:s',strtotime($post->created_at))}}</h5></div>
                <div class="col-md-6"><h5>Thời gian cập nhật: {{date('d-m-Y h:m:s',strtotime($post->updated_at))}}</h5></div>
            </div>
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