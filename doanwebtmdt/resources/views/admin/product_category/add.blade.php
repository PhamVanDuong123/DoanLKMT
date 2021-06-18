@extends('layoutadmin.master')
@section('content')
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
      
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h1 id="index" class="fl-left">Thêm loại sản phẩm</h1>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                @if(count($errors)>0)
                   <div class="alert alert-danger">
                       @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                   </div>
                @endif
                @if(session('thongbao'))
                   <div class="allert alert-success">
                    {{session('thongbao')}}
                    </div>
                @endif
                <form action="{{route('admin.product_category.add')}}" method="post">
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
                                    <label for="name">Tên loại sản phẩm</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                   
                                  
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" id="old_price" class="form-control">
                                </div>
                                
                            </div>
                           
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="detail_desc">Mô tả chi tiết</label>
                                    <textarea name="detail_desc" id="detail_desc" class="ckeditor form-control"></textarea>
                                  
                                  
                                   
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