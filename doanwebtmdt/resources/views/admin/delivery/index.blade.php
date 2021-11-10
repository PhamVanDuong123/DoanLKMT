@extends('layoutadmin.master')

@section('content')
<div class="container-fluid py-5">
    <div class="card">
        <div class="card-header font-weight-bold">
            THÊM PHÍ VẬN CHUYỂN
        </div>
        <div class="card-body">
            <form>
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="province">Chọn tỉnh/thành phố: </label>
                            <select name="province" id="province" class="form-control choose">
                                <option value="">-- Chọn --</option>
                                @foreach($list_province as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="district">Chọn quận/huyện: </label>
                            <select name="district" id="district" class="form-control choose">
                                <option value="">-- Chọn --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ward">Chọn xã/phường/thị trấn: </label>
                            <select name="ward" id="ward" class="form-control">
                                <option value="">-- Chọn --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fee">Nhập phí vận chuyển: </label>
                            <input type="text" class="form-control money" name="fee" id="fee">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="button" id="add-feeship" class="btn btn-primary" style="margin-top: 30px;">Thêm phí vận chuyển</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header font-weight-bold">
            DANH SÁCH PHÍ VẬN CHUYỂN
        </div>
        <div class="card-body" id="list_feeship">
            
        </div>
    </div>
</div>
@endsection