<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Promotion;
use App\Models\Statistical;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hamcrest\Arrays\IsArray;
use PDF;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'order']);
            return $next($request);
        });
    }

    function index(Request $request)
    {
        $option = $request->input('search_option');
        $key = $request->input('key');
        $status = $request->input('status');
        $fillter = $request->input('fillter');

        $list_order = Order::orderByDesc('id')->paginate(8);

        if ($fillter == 'today') {
            $list_order = Order::whereRaw('year(created_at) = ?', date('Y'))->whereRaw('month(created_at) = ?', date('m'))->whereRaw('day(created_at) = ?', date('d'))->orderByDesc('id')->paginate(8);
        }

        if ($fillter == 'in_month') {
            $list_order = Order::whereRaw('year(created_at) = ?', date('Y'))->whereRaw('month(created_at) = ?', date('m'))->orderByDesc('id')->paginate(8);
        }

        if ($option == 'name' || $option == 'code') {
            if ($status == '' || $status == 'all') {
                $list_order = Order::where($option, 'like', "%{$key}%")->orderByDesc('id')->paginate(8);
            } else {
                $list_order = Order::where('status', $status)->where($option, 'like', "%{$key}%")->orderByDesc('id')->paginate(8);
            }
        }

        if ($option == 'date') {
            $date = explode('-', $key);
            if ($status == '' || $status == 'all') {
                $list_order = Order::whereRaw('year(created_at) = ?', $date[0])->whereRaw('month(created_at) = ?', $date[1])->whereRaw('day(created_at) = ?', $date[2])->orderByDesc('id')->paginate(8);
            } else {
                $list_order = Order::where('status', $status)->whereRaw('year(created_at) = ?', $date[0])->whereRaw('month(created_at) = ?', $date[1])->whereRaw('day(created_at) = ?', $date[2])->orderByDesc('id')->paginate(8);
            }
        }

        $count = array(
            'all' => Order::count(),
            'processing' => Order::where('status', 1)->count(),
            'processed' => Order::where('status', 2)->count(),
            'cancelled' => Order::where('status', 0)->count(),
        );

        return view('admin.orders.index', compact('list_order', 'count'));
    }

    function detail($id)
    {
        $order = Order::find($id);
        $list_order_detail = OrderDetail::where('order_id', $id)->get();

        $action = $order->status == 1 ? "process" : "view_detail";

        return view('admin.orders.detail', compact('order', 'list_order_detail', 'action'));
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
        <p>Địa chỉ người nhận: ' . $order->address . '</p>
        <p>Số điện thoại người nhận: ' . $order->phone . '</p>
        <p>Thời gian đặt: ' . $order->created_at . '</p>        
        <p>Giá trị đơn hàng: ' . number_format($total, 0, ',', '.') . 'đ</p>';
        if ($order->promotion_code) {
            $output .= '<p>Mã khuyến mãi: ' . $order->promotion_code . '</p>';
            $promotion = $this->get_promotion($order->promotion_code);
            if ($promotion) {
                if ($promotion['condition'] == 1) {
                    $promotion_money = $total - ($total * $promotion['number']);
                    $output .= '
                    <p>Giảm giá: ' . $promotion['number'] . '%</p>
                    <p>Tổng tiền giảm: ' . number_format($total - ($total * $promotion['number']), 0, ',', '.') . 'đ</p>
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
    
    function process(Request $request, $id)
    {
        $order = Order::find($id);

        $status = $request->input('status');
        if ($status == 2) {
            $order->status = $status;
            $order->order_date = $order->created_at->format('Y-m-d');
            $order->save();

            //cập nhật thống kê doanh thu
            $order_date = $order->order_date;

            $statistic = Statistical::where('order_date', $order_date)->get();
            //dd($statistic);
            $sales = $this->get_sales($order->id);
            $quantity = $this->get_quantity($order->id);
            $profit = $this->get_profit($order->id);
            //dd($profit);
            if (empty($statistic)) {
                Statistical::where('order_date', $order_date)->update([
                    'sales' => $statistic[0]['sales'] + $sales,
                    'profit' => $statistic[0]['profit'] + $profit,
                    'quantity' => $statistic[0]['quantity'] + $quantity,
                    'total_order' => $statistic[0]['total_order'] + 1
                ]);
            } else {
                Statistical::insert([
                    'order_date' => $order_date,
                    'sales' => $sales,
                    'profit' => $profit,
                    'quantity' => $quantity,
                    'total_order' => 1
                ]);
            }

            return redirect(route('admin.order.index'));
        }

        $action = $order->status == 1 ? "process" : "view_detail";

        return view('admin.orders.detail', compact('order', 'action'));
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

    function get_quantity($id)
    {
        $quantity = 0;
        $list_order_detail = OrderDetail::where('order_id', $id)->get();
        foreach ($list_order_detail as $item) {
            $quantity += $item->number;
        }
        return $quantity;
    }

    function get_profit($id)
    {
        $total_cost = 0;
        $list_order_detail = OrderDetail::where('order_id', $id)->get();
        foreach ($list_order_detail as $item) {
            $total_cost += $item->number * $item->price_cost;
        }

        return $this->get_sales($id) - $total_cost;
    }

    function get_promotion($code)
    {
        return Promotion::where('status', 'approved')->where('code', $code)->first();
    }
}
