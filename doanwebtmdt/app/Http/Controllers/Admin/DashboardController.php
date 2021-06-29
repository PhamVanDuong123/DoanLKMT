<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $num_order_success=Order::where('status','delivered')->count();
        $num_order_processing=Order::where('status','processing')->count();
        $revenue=$this->get_revenue();
        $num_order_cancelled=Order::where('status','cancelled')->count();
        $list_new_order=Order::where('status','received')->orderByDesc('id')->paginate(8);
        return view('admin.dashboard.show',compact('num_order_success','num_order_processing','revenue','num_order_cancelled','list_new_order'));
    }

    function get_revenue(){
        $revenue=0;
        $list_order_success=Order::where('status','delivered')->get();
        foreach($list_order_success as $item){
            foreach($item->products as $sub_item){
                $revenue+=$sub_item->pivot->number*$sub_item->pivot->price;
            }
        }
        return $revenue;
    }
}
