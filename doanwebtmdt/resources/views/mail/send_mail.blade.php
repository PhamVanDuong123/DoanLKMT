<?php
$order = $body['order'];
$total = $order['total'];
$province_name = $order['province_name'];
$district_name = $order['district_name'];
$ward_name = $order['ward_name'];
$promotion = $body['promotion'];
$list_order_detail = $body['list_order_detail'];
$promotion_money = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo xử lý đơn hàng</title>
    <style>
            table, th, td {
                border: 1px solid black;
              }
            th, td {
                padding: 5px;
              }
            .text-center{
                text-align: center;
            }
            .font-weight-bold{
                font-weight: bold;
            }
            .d-inline-block{
                display: inline-block;
            }
            .fl-left{
                float:left;
            }
            .fl-right{
                float:right;
            }
        </style>
</head>

<body>
    <h3>Công ty TNHH HD Computer</h3>
    <h4>Địa chỉ: 65 Huỳnh Thúc Kháng, p.Bến Nghé, q1, TPHCM</h4>
    <h4>SĐT: 19001009</h4>
    <h1 class="text-center">{{$name}}</h1>
    <hr>
    <p class="font-weight-bold">-Mã hóa đơn: {{$order->code}}</p>
    <p>-Người đặt hàng: {{$order->user->fullname}}</p>
    <p>-Người nhận hàng: {{$order->name}}</p>
    <p>-Địa chỉ nhận hàng: <span> {{$order->address}}, </span><span> {{$ward_name}}, </span><span> {{$district_name}}, </span><span> {{$province_name}} </span></p>
    <p>-Số điện thoại người nhận: {{$order->phone }}</p>
    <p>-Thời gian đặt: {{$order->created_at->format('d-m-Y h:m:s') }}</p>
    <p>-Giá trị đơn hàng: {{number_format($total, 0, ',', '.') }}đ</p>
    @if ($order->promotion_code)
        <p>-Mã khuyến mãi: {{$order->promotion_code }}</p>
        @if ($promotion)
            @if ($promotion['condition'] == 1)
                @php $promotion_money = $total * $promotion['number'] / 100; @endphp
                <p>-Giảm giá: {{$promotion['number'] }}%</p>
                <p>-Tổng tiền giảm: {{number_format($promotion_money, 0, ',', '.') }}đ</p>
            @else
                @php $promotion_money = $promotion['number']; @endphp
                <p>-Giảm giá: {{number_format($promotion_money, 0, ',', '.') }}đ</p>
            @endif
        @endif
    @endif
    <p>-Phí vận chuyển: {{number_format($order->shipping_fee, 0, ',', '.') }}đ</p>
    <p>-Phương thức thanh toán: {{$order['payment'] == 'onl' ? 'Thanh toán online' : 'Thanh toán khi nhận hàng'}}</p>
    <p class="font-weight-bold">-Tổng giá đơn hàng: {{number_format($total - $promotion_money + $order->shipping_fee, 0, ',', '.') }}đ</p>
    <hr>
    <p>-Chi tiết đơn hàng</p>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @php $t = 0; @endphp
            @foreach ($list_order_detail as $item)
            @php $t++ @endphp
            <tr>
                <td>{{$t }}</td>
                <td>{{$item->product->name }}</td>
                <td>{{$item->number }}</td>
                <td>{{number_format($item->price, 0, ',', '.') }}đ</td>
                <td>{{number_format($item->price * $item->number, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>