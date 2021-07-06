@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật khuyến mãi
        </div>
        <div class="card-body">
            @if(!empty($promotion))
            <form method="post" action="{{route('admin.promotion.update',['id'=>$promotion->id, 'status'=>request()->status])}}" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên khuyến mãi</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{$promotion->name}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Mã khuyến mãi</label>
                                <input class="form-control" type="text" name="code" id="code" value="{{$promotion->code}}">
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
                                <input class="form-control" type="number" min="1" max="100" name="percents" id="percents" value="{{$promotion->percents}}">
                                @error('percents')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="number">Số lượng</label>
                                <input class="form-control" type="number" min="1" name="number" id="number" value="{{$promotion->number}}">
                                @error('number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_day">Từ ngày (Ngày bắt đầu)</label>
                                <input class="form-control" type="date" name="start_day" id="start_day" value="{{$promotion->start_day}}">
                                @error('start_day')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_day">Đến ngày (Ngày kết thúc)</label>
                                <input class="form-control" type="date" name="end_day" id="end_day" value="{{$promotion->end_day}}">
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
                                    <div class="col-md-2"><img class="image-preview avatar-edit" src="{{$promotion->thumb}}" alt=""></div>
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
                                <textarea class="form-control form-editor" name="description" id="description" cols="30" rows="5">{{$promotion->description}}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật <i class="fa fa-edit"></i></button>
                <a class="btn btn-secondary" href="{{route('admin.promotion.index')}}">Quay lại <i class="fas fa-backspace"></i></a> 
            </form>
            @endif
        </div>
    </div>
</div>
@endsection