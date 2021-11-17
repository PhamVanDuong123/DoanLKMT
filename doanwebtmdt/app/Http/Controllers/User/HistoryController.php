<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductCategory;
use App\Models\Promotion;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class HistoryController extends Controller
{
    function index()
    {
        $list_order = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        $list_cate = ProductCategory::all();
        foreach ($list_cate as &$cate) {
            $cate['url_list_pro_by_cate'] = route('product.showByCate', $cate->id);
        }
        
        return view('user.history.index', compact('list_order','list_cate'));
    }

    function detail($id)
    {
        $order = Order::find($id);
        $list_cate = ProductCategory::all();
        foreach ($list_cate as &$cate) {
            $cate['url_list_pro_by_cate'] = route('product.showByCate', $cate->id);
        }

        return view('user.history.detail', compact('order','list_cate'));
    }

    function print_order($order_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($order_code));
        return $pdf->stream();
    }

    function print_order_convert($order_code)
    {
        $order = Order::where('code', $order_code)->first();
        $total = $this->get_sales($order->id);
        $province_name = $this->get_province_name($order->province_id);
        $district_name = $this->get_district_name($order->district_id);
        $ward_name = $this->get_ward_name($order->ward_id);
        $promotion_money = 0;
        $payment = $order->payment = 'onl' ? 'Thanh toán online' : 'Thanh toán khi nhận hàng';
        $list_order_detail = OrderDetail::where('order_id', $order->id)->get();
        $output = '
        <style>
            body{
                font-family: Dejavu Sans;
            }
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
        <h3>Công ty TNHH HD Computer</h3>
        <p>Địa chỉ: 65 Huỳnh Thúc Kháng, p.Bến Nghé, q1, TPHCM</p>
        <p>SĐT: 19001009</p>
        <h1 class="text-center">HÓA ĐƠN</p>
        <p class="font-weight-bold">Mã hóa đơn: ' . $order_code . '</p>
        <p>Người đặt hàng: ' . $order->user->fullname . '</p>
        <p>Người nhận hàng: ' . $order->name . '</p>
        <p>Địa chỉ nhận hàng: <span> ' . $order->address . ', </span><span> ' . $ward_name . ', </span><span> ' . $district_name . ', </span><span> ' . $province_name . ' </span></p>
        <p>Số điện thoại người nhận: ' . $order->phone . '</p>
        <p>Thời gian đặt: ' . $order->created_at->format('d-m-Y H:m:s') . '</p>        
        <p>Giá trị đơn hàng: ' . number_format($total, 0, ',', '.') . 'đ</p>';
        if ($order->promotion_code) {
            $output .= '<p>Mã khuyến mãi: ' . $order->promotion_code . '</p>';
            $promotion = $this->get_promotion($order->promotion_code);
            if ($promotion) {
                if ($promotion['condition'] == 1) {
                    $promotion_money = $total * $promotion['number'] / 100;
                    $output .= '
                    <p>Giảm giá: ' . $promotion['number'] . '%</p>
                    <p>Tổng tiền giảm: ' . number_format($total * $promotion['number'] / 100, 0, ',', '.') . 'đ</p>
                    ';
                } else {
                    $promotion_money = $promotion['number'];
                    $output .= '
                    <p>Giảm giá: ' . number_format($promotion['number'], 0, ',', '.') . 'đ</p>
                    ';
                }
            }
        }
        $output .= '
        <p>Phí vận chuyển: ' . number_format($order->shipping_fee, 0, ',', '.') . 'đ</p>
        <p>Phương thức thanh toán: ' . $payment . '</p>
        <p class="font-weight-bold">Tổng giá đơn hàng: ' . number_format($total - $promotion_money + $order->shipping_fee, 0, ',', '.') . 'đ</p>
        ';

        $output .= '
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
        ';
        $t = 0;
        foreach ($list_order_detail as $item) {
            $t++;
            $output .= '
            <tr>
                <td>' . $t . '</td>
                <td>' . $item->product->name . '</td>
                <td>' . $item->number . '</td>
                <td>' . number_format($item->price, 0, ',', '.') . 'đ</td>
                <td>' . number_format($item->price * $item->number, 0, ',', '.') . 'đ</td>
            </tr>
            ';
        }

        $output .= '
           </tbody>
           </table>
           <p><span class="d-inline-block font-weight-bold" style="width: 550px;">Người lập hóa đơn</span><span class="d-inline-block font-weight-bold">Người nhận hàng</span></p>
           ';

        return $output;
    }

    function get_sales($id)
    {
        $total = 0;
        $list_order_detail = OrderDetail::where('order_id', $id)->get();
        foreach ($list_order_detail as $item) {
            $total += $item->number * $item->price;
        }
        return $total;
    }

    function get_province_name($id){
        $province = Province::find($id);
        return $province->name;
    }

    function get_district_name($id){
        $district = District::find($id);
        return $district->name;
    }

    function get_ward_name($id){
        $ward = Ward::find($id);
        return $ward->name;
    }

    function get_promotion($code)
    {
        $promotion = Promotion::where('status', 'approved')->where('code', $code)->first();
        if($promotion)
            return $promotion;
        return null;
    }
}
