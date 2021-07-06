@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm khuyến mãi
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.promotion.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên khuyến mãi</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Mã khuyến mãi</label>
                                <input class="form-control" type="text" name="code" id="code">
                                @error('code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="percents">Phần trăm giảm (%)</label>
                                <input class="form-control" type="number" min="1" max="100" name="percents" id="percents">
                                @error('percents')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="number">Số lượng</label>
                                <input class="form-control" type="number" min="1" name="number" id="number">
                                @error('number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_day">Từ ngày (Ngày bắt đầu)</label>
                                <input class="form-control" type="date" name="start_day" id="start_day">
                                @error('start_day')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_day">Đến ngày (Ngày kết thúc)</label>
                                <input class="form-control" type="date" name="end_day" id="end_day">
                                @error('end_day')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control form-editor" name="description" id="description" cols="30" rows="20"></textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới <i class="fas fa-plus-circle"></i></button>
                <a class="btn btn-secondary" href="{{route('admin.promotion.index')}}">Quay lại <i class="fas fa-backspace"></i></a>
            </form>
        </div>
    </div>
</div>
@endsection