@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm danh mục bài viết
        </div>
        <div class="card-body">
            <form action="{{route('admin.post_category.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Tên danh mục bài viết</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection