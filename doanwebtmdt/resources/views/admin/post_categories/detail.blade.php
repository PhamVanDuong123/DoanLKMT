@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chi tiết danh mục bài viết
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    @if(!empty($post_cate))
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Tên: </label>
                        <p>{{$post_cate->name}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Mã: </label>
                        <p>{{$post_cate->code}}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="font-weight-bold">Người tạo: </label>
                        <p>{{$post_cate->user->fullname}}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="font-weight-bold">Ngày tạo: </label>
                        <p>{{$post_cate->created_at}}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="font-weight-bold">Ngày cập nhật: </label>
                        <p>{{$post_cate->updated_at}}</p>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="font-weight-bold">Mô tả: </label>
                        <p>{{$post_cate->description}}</p>
                    </div>
                    @endif
                    <a class="btn btn-secondary" href="{{route('admin.post.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection