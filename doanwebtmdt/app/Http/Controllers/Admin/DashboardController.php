<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request,$next){
            session(['mod_active'=>'dashboard']);
            return $next($request);
        });
    }

    function show(){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $num_order_success=Order::where('status',2)->count();
        $num_order_processing=Order::where('status',1)->count();
        $revenue=$this->get_revenue();
        $num_order_cancelled=Order::where('status',0)->count();
        $list_new_order=Order::where('status',1)->orderByDesc('id')->paginate(8);
        $revenue_today=$this->get_revenue($today);
        $profit_today=$this->get_profit_today();
        $qty_today=$this->get_qty_today();
        $order_today=$this->get_order_today();
        return view('admin.dashboard.show',compact('num_order_success','num_order_processing','revenue','num_order_cancelled','list_new_order','revenue_today','profit_today','qty_today','order_today'));
    }

    function get_revenue($date=''){
        $revenue=0;
        $list_order_success=Order::where('status',2)->get();
        if(!empty($date))
            $list_order_success=Order::where('status',2)->where('order_date',$date)->get();
        
        foreach($list_order_success as $item){
            foreach($item->products as $sub_item){
                $revenue+=$sub_item->pivot->number*$sub_item->pivot->price;
            }
        }
        return $revenue;
    }

    function get_profit_today(){
        $profit = 0;
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $list_order_success=Order::where('status',2)->where('order_date',$today)->get();
        foreach($list_order_success as $item){
            $list_order_detail=OrderDetail::where('order_id',$item->id)->get();
            foreach($list_order_detail as $item2){
                $profit+=($item2->number*$item2->price)-($item2->number*$item2->price_cost);
            }
        }
        return $profit;
    }

    function get_qty_today(){
        $qty = 0;
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $list_order_success=Order::where('status',2)->where('order_date',$today)->get();
        
        foreach($list_order_success as $item){
            $list_order_detail=OrderDetail::where('order_id',$item->id)->get();
            foreach($list_order_detail as $item2){
                $qty+=$item2->number;
            }
        }
        return $qty;
    }

    function get_order_today(){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        return Order::where('status',2)->where('order_date',$today)->count();
    }    
}
