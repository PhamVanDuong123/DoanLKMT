@extends('layoutadmin.master')

@section('content')
<style>
    .statistical_title {
        font-size: 20px;
    }
</style>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0">Thống kê sản phẩm - bài viết</h5>
        </div>
        <div class="card-body">
        <div class="row">
                <div class="col-md-6">
                    <p class="text-center font-weight-bold statistical_title">Sản phẩm sắp hết hàng</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($pro_out_stock))
                            @php $i=0; @endphp
                            @foreach($pro_out_stock as $item)
                            @php $i++; @endphp
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td><img class="thumb-post-mini" src="{{$item->thumb}}" alt=""></td>
                                <td><a href="{{route('admin.product.detail',$item->id)}}">{{$item->name}}</a></td>
                                <td>{{$item->inventory_num}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{$pro_out_stock->appends(request()->all())->links()}}
                </div>
                <div class="col-md-6">
                    <p class="text-center font-weight-bold statistical_title">Bài viết xem nhiều nhất</p>
                    <ol>
                        @foreach($posts_best_view as $item)
                        <li><a href="{{route('admin.post.detail',$item->id)}}">{{$item->name}} | {{$item->views}} lượt xem</a></li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mt-5">
                
            </div>
        </div>
    </div>
</div>
@endsection