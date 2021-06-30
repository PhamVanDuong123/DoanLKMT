@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật danh mục sản phẩm
        </div>
        <div class="card-body">
            @if(!empty($product_category))
            <form action="{{route('admin.product_category.edit',['id'=>$product_category->id,'status'=>request()->status])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Tên loại sản phẩm</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$product_category->name}}">
                </div>
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{$product_category->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection