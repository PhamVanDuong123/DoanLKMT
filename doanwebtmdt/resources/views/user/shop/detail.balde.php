@extends('layout.home')
@section('content')
<div id="wp-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Giỏ hàng</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>
                                        <img src="images/product-1.jpg" width="100px" alt="">
                                    </td>
                                    <td scope="col"><a href="">Sản phẩm 1</a></td>
                                    <td scope="col">250.000đ</td>
                                    <td scope="col">
                                        <input type="number" style="width:50px; text-align: center" value="2">
                                    </td>
                                    <td scope="col">500.000đ</td>
                                    <td><a href="" class="text-danger">Xóa</a></td>
                                </tr>
                                <tr>
                                    <td scope="row">2</td>
                                    <td>
                                        <img src="images/product-1.jpg" width="100px" alt="">
                                    </td>
                                    <td scope="col"><a href="">Sản phẩm 2</a></td>
                                    <td scope="col">500.000đ</td>
                                    <td scope="col">
                                        <input type="number" style="width:50px; text-align: center" value="1">
                                    </td>
                                    <td scope="col">500.000đ</td>
                                    <td><a href="" class="text-danger">Xóa</a></td>
                                </tr>
                                <tr>
                                    <td scope="row">3</td>
                                    <td>
                                        <img src="images/product-1.jpg" width="100px" alt="">
                                    </td>
                                    <td scope="col"><a href="">Sản phẩm 3</a></td>
                                    <td scope="col">1.000.000đ</td>
                                    <td scope="col">
                                        <input type="number" style="width:50px; text-align: center" value="2">
                                    </td>
                                    <td scope="col">2.000.000đ</td>
                                    <td><a href="" class="text-danger">Xóa</a></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan='6' class="text-right">Tổng:</td>
                                    <td><strong>3.000.000đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection