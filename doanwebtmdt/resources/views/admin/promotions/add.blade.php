@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm khuyến mãi
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.promotion.store')}}">
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
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                                @error('description')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection