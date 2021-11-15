<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Promotion;
use App\Models\Province;
use App\Models\Statistical;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hamcrest\Arrays\IsArray;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Mail;

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
        <p>Địa chỉ nhận hàng: <span> ' .$order->address. ', </span><span> ' .$ward_name. ', </span><span> ' .$district_name. ', </span><span> ' .$province_name. ' </span></p>
        <p>Số điện thoại người nhận: ' . $order->phone . '</p>
        <p>Thời gian đặt: ' . $order->created_at->format('d-m-Y H:m:s') . '</p>        
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

            $statistic = Statistical::where('order_date', $order_date)->first();
            // dd($statistic);
            $sales = $this->get_sales($order->id);
            $quantity = $this->get_quantity($order->id);
            $profit = $this->get_profit($order->id);
            //dd($profit);
            if (!empty($statistic)) {
                Statistical::where('order_date', $order_date)->update([
                    'sales' => $statistic['sales'] + $sales,
                    'profit' => $statistic['profit'] + $profit,
                    'quantity' => $statistic['quantity'] + $quantity,
                    'total_order' => $statistic['total_order'] + 1
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

            //gửi mail thông báo đến email đặt khách hàng
            $to_email=$this->get_email_customer($order->user_id);
            $name = "Đơn hàng đã được xử lý";

            $body['order'] = $order;
            $body['order']['total'] = $this->get_sales($order->id);
            $body['order']['province_name'] = $this->get_province_name($order->province_id);
            $body['order']['district_name'] = $this->get_district_name($order->district_id);
            $body['order']['ward_name'] = $this->get_ward_name($order->ward_id);
            $body['promotion'] = $this->get_promotion($order->promotion_code);
            $body['list_order_detail'] = OrderDetail::where('order_id',$order->id)->get();

            $layout = 'mail.send_mail';

            $this->send_mail($to_email,$name,$body,$layout);

            return redirect(route('admin.order.index'))->with('success','Xử lý đơn hàng thành công.');
        }

        $action = $order->status == 1 ? "process" : "view_detail";

        return view('admin.orders.detail', compact('order', 'action'));
    }

    function send_mail($to_email,$name,$body,$layout){
        //send mail
        $from_name = "Công ty TNHH HD Computer";
            
        $data = array("name"=>$name,"body"=>$body);
        
        Mail::send($layout,$data,function($message) use ($from_name,$to_email){

            $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
            $message->from($to_email,$from_name);//send from this mail

        });
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
        $promotion = Promotion::where('status', 'approved')->where('code', $code)->first();
        if($promotion)
            return $promotion;
        return null;
    }

    function get_email_customer($id){
        $customer = User::find($id);
        return $customer->email;
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
}
