<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Statistical;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hamcrest\Arrays\IsArray;

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

        return view('admin.orders.process', compact('order'));
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
}
