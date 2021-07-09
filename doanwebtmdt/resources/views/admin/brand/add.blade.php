@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm thương Hiệu
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.brand.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Tên thương hiệu</label>
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
                            <label for="address">Địa chỉ</label>
                                <textarea class="form-control" name="address" id="address" rows="3"></textarea>
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
                            <input class="form-control" type="text" name="email" id="email">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="phone">Số Điện Thoại</label>
                                <input class="form-control" type="text" name="phone" id="phone">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="country">Quốc Gia</label>
                            <input class="form-control" type="text" name="country" id="country">
                                @error('country')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="website">Website</label>
                                <input class="form-control" type="text" name="website" id="website">
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
                   
                    <button type="submit" class="btn btn-primary">Thêm mới <i class="fas fa-plus-circle"></i></button>
                             <a class="btn btn-secondary" href="{{route('admin.promotion.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection