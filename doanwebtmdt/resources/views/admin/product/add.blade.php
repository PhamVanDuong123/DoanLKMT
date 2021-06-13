@extends('layoutadmin.master')
@section('content')
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        @include('layoutadmin.sidebar')
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h1 id="index" class="fl-left">Thêm sản phẩm</h1>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!empty($success))
                                    <div class="alert alert-success">
                                        {{$success}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    @error('name')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Thương hiệu</label>
                                    @if(!empty($list_brand))
                                    <select name="brand_id" class="form-control">
                                        <option value="">-- Chọn thương hiệu --</option>
                                        @foreach($list_brand as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    @error('brand_id')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="old_price">Giá cũ</label>
                                    <input type="text" name="old_price" id="old_price" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="inventory_num">Số lượng</label>
                                    <input type="number" min="1" name="inventory_num" id="inventory_num" class="form-control">
                                    @error('inventory_num')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="price">Giá bán</label>
                                    <input type="text" name="price" id="price" class="form-control">
                                    @error('price')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Loại sản phẩm</label>
                                    @if(!empty($list_cate))
                                    <select name="product_category_id" class="form-control">
                                        <option value="">-- Chọn loại sản phẩm --</option>
                                        @foreach($list_cate as $cate)
                                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    @error('product_category_id')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="warranty">Thời gian bảo hành (tháng)</label>
                                    <input type="number" name="warranty" id="warranty" class="form-control">
                                    @error('warranty')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="short_desc">Mô tả ngắn</label>
                                    <textarea name="short_desc" id="short_desc" class="form-control"></textarea>
                                    @error('short_desc')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Ảnh đại diện</label>
                                    <div id="uploadFile">
                                        <input type="file" name="thumb" id="thumb">
                                        <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                                        <img src="public/admin/public/images/img-thumb.png">
                                    </div>
                                    <!-- <div id="uploadFile" class="custom-file">
                                        <input type="file" class="custom-file-input" id="thumb" name="thumb">
                                        <label class="custom-file-label" for="thumb">Chọn ảnh</label>
                                    </div> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="detail_desc">Mô tả chi tiết</label>
                                    <textarea name="detail_desc" id="detail_desc" class="ckeditor form-control"></textarea>
                                    @error('detail_desc')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" value="Thêm mới" name="btn-submit" id="btn-submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection