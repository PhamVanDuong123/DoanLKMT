@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh Sửa Thương Hiệu
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.brand.update',['id'=>$brand->id,'status'=>request()->status])}}" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Tên thương hiệu</label>
                                <input class="form-control" type="text" name="name" id="name"value="{{$brand->name}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="address">Địa chỉ</label>
                                <textarea class="form-control" name="address" id="address" rows="3">{{$brand->address}}</textarea>
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{$brand->email}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="phone">Số Điện Thoại</label>
                                <input class="form-control" type="text" name="phone" id="phone"value="{{$brand->phone}}">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="country">Quốc Gia</label>
                            <input class="form-control" type="text" name="country" id="country"value="{{$brand->country}}">
                                @error('country')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="website">Website</label>
                                <input class="form-control" type="text" name="website" id="website"value="{{$brand->website}}">
                                @error('website')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <div class="row">
                                    <div class="col-md-2"><img class="image-preview avatar-edit" src="" alt=""></div>
                                    <div class="col-md-10"> <input class="form-control-file file-image" type="file" name="logo" id="logo"></div>
                                </div>
                                @error('logo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection