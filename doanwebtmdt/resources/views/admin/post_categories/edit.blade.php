@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật danh mục bài viết
        </div>
        <div class="card-body">
            @if(!empty($post_cate))
            <form action="{{route('admin.post_category.update',['id'=>$post_cate->id,'status'=>request()->status])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Tên danh mục bài viết</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$post_cate->name}}">
                </div>
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{$post_cate->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật <i class="fa fa-edit"></i></button>
                <a class="btn btn-secondary" href="{{route('admin.post_category.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection