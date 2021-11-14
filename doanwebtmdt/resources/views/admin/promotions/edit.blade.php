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
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name">Tên khuyến mãi</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{$promotion->name}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="code">Mã khuyến mãi</label>
                                <input class="form-control" type="text" name="code" id="code" value="{{$promotion->code}}">
                                @error('code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="qty">Số lượng</label>
                                <input class="form-control" type="number" min="1" name="qty" id="qty" value="{{$promotion->qty}}">
                                @error('qty')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="condition">Chọn hình thức giảm</label>
                                <select name="condition" id="condition" class="form-control">
                                    <option value="">-- Chọn --</option>
                                    <option value="1" <?php if ($promotion->condition == 1) echo "selected"; ?>>Giảm theo %</option>
                                    <option value="2" <?php if ($promotion->condition == 2) echo "selected"; ?>>Giảm theo giá tiền</option>
                                </select>
                                @error('condition')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="number">Giá trị giảm</label>
                                <input class="form-control" type="text" min="1" name="number" id="number" value="{{$promotion->number}}">
                                @error('number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="min_total_order">Giá hóa đơn tối thiểu</label>
                                <input class="form-control" disabled type="text" min="1" name="min_total_order" id="min_total_order" value="{{$promotion->min_total_order}}">
                                @error('min_total_order')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="start_day">Từ ngày (Ngày bắt đầu)</label>
                                <input class="form-control" type="date" name="start_day" id="start_day" value="{{$promotion->start_day}}">
                                @error('start_day')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="end_day">Đến ngày (Ngày kết thúc)</label>
                                <input class="form-control" type="date" name="end_day" id="end_day" value="{{$promotion->end_day}}">
                                @error('end_day')
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