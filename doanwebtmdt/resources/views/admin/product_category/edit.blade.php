@extends('layoutadmin.master')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật Loại Sản Phẩm
        </div>
        <div class="card-body">
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
            @if(!empty($product_category))
            <form action="{{route('admin.product_category.edit',$product_category->id)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
               
                <div class="container-fluild">
                <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="name">Tên loại sản phẩm</label>
                                    <input type="text" name="name" class="form-control" placeholder=" Điền vào thể loại" value={{$product_category->name}}>
                                   
                                  
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" id="old_price" class="form-control"placeholder=" Điền vào code thể loại" value={{$product_category->code}}>
                                </div>
                                
                            </div>
                           
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="detail_desc">Mô tả chi tiết</label>
                                    <textarea name="detail_desc" id="detail_desc" class="ckeditor form-control"placeholder=" Điền vào thể loại" value={{$product_category->detail_desc}}></textarea>
                                  
                                  
                                   
                                </div>
                            </div>
                    
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection