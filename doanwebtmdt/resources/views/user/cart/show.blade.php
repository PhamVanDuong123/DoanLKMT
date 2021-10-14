@extends('layout.home')

@section('content')
<div id="main-content-wp" class="cart-page">
    <!-- <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div> -->
    <div id="wrapper" class="wp-inner clearfix">
        <h1>Giỏ hàng</h1>
        <p>Có {{Cart::count()}} sản phẩm trong giỏ hàng</p>
        <form action="{{route('cart.update')}}" method="post">
            @csrf
        @if(Cart::count()>0)
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td scope="col">STT</td>
                            <td scope="col">Ảnh sản phẩm</td>
                            <td scope="col">Tên sản phẩm</td>
                            <td scope="col">Giá sản phẩm</td>
                            <td scope="col">Số lượng</td>
                            <td scope="col" colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>

                        @php $t=0; @endphp
                        @foreach($list_pro as $product)
                        @php $t++; @endphp
                        <tr>
                            <td scope="row">{{$t}}</td>
                            <td scope="col">
                                <a href="" title="" class="thumb">
                                    <img src="{{$product->options->thumb}}" alt="">
                                </a>
                            </td>
                            <td scope="col">
                                <a href="" title="" class="name-product">{{$product->name}}</a>
                            </td>
                            <td scope="col">{{number_format($product->price,0,',','.')}}đ</td>
                            <td scope="col">
                                <input type="number" name="qty[{{$product->rowId}}]" min='1' value="{{$product->qty}}" class="num-order">
                            </td>
                            <td scope="col">{{number_format($product->subtotal,0,',','.')}}đ</td>
                            <td scope="col">
                                <a href="{{route('cart.remove',$product->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?php echo Cart::total(); ?>đ</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-left">
                                        <a href="{{route('home')}}" title="" id="buy-more">Mua tiếp</a>
                                        <a href="{{route('cart.destroy')}}" id="destroy-cart" title="" id="delete-cart">Xóa tất cả giỏ hàng</a>
                                    </div>
                                    <div class="fl-right">
                                        <input type="submit" id="update-cart" name="update-cart" value="Cập nhật giỏ hàng">
                                        <a href="{{route('cart.checkout')}}" title="" id="checkout-cart">Thanh toán</a>                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <!-- <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p> -->

            </div>
        </div>
        @endif
        </form>
    </div>
</div>
@endsection