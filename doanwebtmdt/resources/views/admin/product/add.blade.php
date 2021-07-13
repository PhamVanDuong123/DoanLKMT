@extends('layoutadmin.master')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">

         
                    <form method="post" action="{{route('admin.product.add')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" name="name" id="name" class="form-control" >
                                    @error('name')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
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
                                    <label for="old_price">Giá cũ</label>
                                    <input type="text" name="old_price" id="old_price" class="form-control">
                                    @error('old_price')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Loại sản phẩm</label>
                                    @if(!empty($list_product_cate))
                                    <select name="product_category_id" class="form-control">
                                        <option value="">-- Chọn loại sản phẩm --</option>
                                        @foreach($list_product_cate as $cate)
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
                                    <label for="price">Giá bán</label>
                                    <input type="text" name="price" id="price" class="form-control">
                                    @error('price')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                <label>Thương hiệu</label>
                                  
                                  <select name="brand_id" class="form-control" id ="">
                                      <option value="">-- Chọn thương hiệu --</option>
                                      @if(!empty($list_brand_cate))
                                      @foreach($list_brand_cate as $brand)
                                      <option value="{{$brand->id}}">{{$brand->name}}</option>
                                      @endforeach
                                      @endif
                                  </select>
                                 
                                  @error('brand_id')
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
                                <div class="col-md-6 form-group">
                                    <label>Ảnh đại diện</label>
                                    <div class="row">
                                    <div class="col-md-2"><img class="image-preview avatar-edit" src="" alt=""></div>
                                    <div class="col-md-10"> <input class="form-control-file file-image" type="file" name="thumb" id="thumb"></div>
                                </div>
                                @error('thumb')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                           
                            

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="short_desc">Mô tả ngắn</label>
                                    <textarea name="short_desc" id="short_desc" class="form-control"></textarea>
                                    @error('short_desc')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                               
                               
                             
                               
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="detail_desc">Mô tả chi tiết</label>
                                    <textarea name="content" class="form-control form-editor" id="content" cols="30" rows="20"></textarea>
                                    @error('detail_desc')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới <i class="fas fa-plus-circle"></i></button>
                             <a class="btn btn-secondary" href="{{route('admin.promotion.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection