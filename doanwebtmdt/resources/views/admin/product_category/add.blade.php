@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm danh mục sản phẩm
        </div>
        <div class="card-body">
              
          
            <form action="{{route('admin.product_category.add')}}" method="post">
                @csrf
                <div class="container-fluild">
                <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="name">Tên loại sản phẩm</label>
                                    <input type="text" name="name" class="form-control" placeholder=" Điền vào thể loại" >
                                   
                                </div>
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" id="old_price" class="form-control"placeholder=" Điền vào code loại mô tả sản phẩm">
                                </div>
                                @error('code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                           
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="detail_desc">Mô tả </label>
                                    <textarea name="detail_desc" id="detail_desc" class="ckeditor form-control"placeholder=" Điền vào mô tả sản phẩm" ></textarea>
                                  
                                </div>
                            </div>
                    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </div>
                </div>

              
            </form>
       
        </div>
     </div>
    </div>
</div>
@endsection