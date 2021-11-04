<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Post;
use App\Models\Product;
use App\Models\Statistical;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'statistics']);
            return $next($request);
        });
    }

    function sale()
    {
        $top5_product_selling = OrderDetail::selectRaw("product_id, sum(number) total")->groupBy('product_id')->orderBy('total','desc')->limit(5)->paginate(5);
        $top5_slow_product_selling = OrderDetail::selectRaw("product_id, sum(number) total")->groupBy('product_id')->orderBy('total','asc')->limit(5)->paginate(5);
        $total_order = Order::selectRaw("count('user_id') total_order")->groupBy('user_id')->get();
        $list_customer = Order::join('order_details','orders.id','=','order_details.order_id')->selectRaw("user_id, sum(number) total_product")->groupBy('user_id')->orderBy('total_product','desc')->limit(5)->paginate(5);
        $products_best_view = Product::orderBy('views','desc')->take(20)->get();
        return view('admin.statistics.sale', compact('top5_product_selling','top5_slow_product_selling','list_customer','total_order','products_best_view'));
    }

    function statistical_30day(Request $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $before30day = Carbon::now('Asia/Ho_Chi_Minh')->subDay(30)->toDateString();

        $get = Statistical::whereBetween('order_date', [$before30day, $today])->orderBy('order_date', 'ASC')->get();
        foreach ($get as $v) {
            $chart_data[] = array(
                'period' => $v->order_date,
                'order' => $v->total_order,
                'sales' => $v->sales,
                'profit' => $v->profit,
                'quantity' => $v->quantity
            );
        }
        echo json_encode($chart_data);
    }

    function fillter_by_select(Request $request)
    {
        $data = $request->all();
        $select = $data['select'];

        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $before7day = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7)->toDateString();
        $before30day = Carbon::now('Asia/Ho_Chi_Minh')->subDay(30)->toDateString();
        $start_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $start_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $start_year = Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->toDateString();

        switch ($select) {
            case "7day":
                $get = Statistical::whereBetween('order_date', [$before7day, $today])->orderBy('order_date', 'ASC')->get();
                foreach ($get as $v) {
                    $chart_data[] = array(
                        'period' => $v->order_date,
                        'order' => $v->total_order,
                        'sales' => $v->sales,
                        'profit' => $v->profit,
                        'quantity' => $v->quantity
                    );
                }
                break;
            case "in_month":
                $get = Statistical::whereBetween('order_date', [$start_month, $today])->orderBy('order_date', 'ASC')->get();
                foreach ($get as $v) {
                    $chart_data[] = array(
                        'period' => $v->order_date,
                        'order' => $v->total_order,
                        'sales' => $v->sales,
                        'profit' => $v->profit,
                        'quantity' => $v->quantity
                    );
                }
                break;
            case "last_month":
                $get = Statistical::whereBetween('order_date', [$start_last_month, $end_last_month])->orderBy('order_date', 'ASC')->get();
                foreach ($get as $v) {
                    $chart_data[] = array(
                        'period' => $v->order_date,
                        'order' => $v->total_order,
                        'sales' => $v->sales,
                        'profit' => $v->profit,
                        'quantity' => $v->quantity
                    );
                }
                break;
            case "in_year":
                $get = Statistical::whereBetween('order_date', [$start_year, $today])->orderBy('order_date', 'ASC')->get();
                foreach ($get as $v) {
                    $chart_data[] = array(
                        'period' => $v->order_date,
                        'order' => $v->total_order,
                        'sales' => $v->sales,
                        'profit' => $v->profit,
                        'quantity' => $v->quantity
                    );
                }
                break;
            default:
        }

        echo json_encode($chart_data);
    }

    function fillter_by_date(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistical::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();

        foreach ($get as $v) {
            $chart_data[] = array(
                'period' => $v->order_date,
                'order' => $v->total_order,
                'sales' => $v->sales,
                'profit' => $v->profit,
                'quantity' => $v->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }

    function product_post(){
        $pro_out_stock = Product::where('inventory_num','<',10)->paginate(5);
        $posts_best_view = Post::orderBy('views','desc')->take(20)->get();
        return view('admin.statistics.product_post',compact('pro_out_stock','posts_best_view'));
    }
}
