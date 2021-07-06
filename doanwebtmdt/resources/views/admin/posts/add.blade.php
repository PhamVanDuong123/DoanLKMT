@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.post.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Tiêu đề bài viết</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="short_desc">Tóm tắt ngắn</label>
                                <textarea class="form-control" name="short_desc" id="short_desc" rows="3"></textarea>
                                @error('short_desc')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Danh mục</label>
                                <select class="form-control" id="" name="post_category_id">
                                    <option value="">Chọn danh mục</option>
                                    @if(!empty($list_post_cate))
                                    @foreach($list_post_cate as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('post_category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="thumb">Ảnh đại diện</label>
                                <div class="row">
                                    <div class="col-md-2"><img class="image-preview avatar-edit" src="" alt=""></div>
                                    <div class="col-md-10"> <input class="form-control-file file-image" type="file" name="thumb" id="thumb"></div>
                                </div>
                                @error('thumb')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="content">Nội dung bài viết</label>
                                <textarea name="content" class="form-control form-editor" id="content" cols="30" rows="20"></textarea>
                                @error('content')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Thêm mới <i class="fas fa-plus-circle"></i></button>
                            <a class="btn btn-secondary" href="{{route('admin.post.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection