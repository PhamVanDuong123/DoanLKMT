<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $fillter=$request->input('fillter');

        $list_order = Order::paginate(8);

        if($fillter=='today'){
            $list_order=Order::whereRaw('year(created_at) = ?',date('Y'))->whereRaw('month(created_at) = ?',date('m'))->whereRaw('day(created_at) = ?',date('d'))->paginate(8);
        }

        if($fillter=='in_month'){
            $list_order=Order::whereRaw('year(created_at) = ?',date('Y'))->whereRaw('month(created_at) = ?',date('m'))->paginate(8);
        }
        
        if($option=='name'||$option=='code'){
            if($status == '' || $status == 'all'){
                $list_order = Order::where($option, 'like', "%{$key}%")->paginate(8);
            }else{
                $list_order = Order::where('status', $status)->where($option, 'like', "%{$key}%")->paginate(8);
            }
        }

        if($option=='date'){
            $date = explode('-', $key);
            if($status == '' || $status == 'all'){
                $list_order=Order::whereRaw('year(created_at) = ?',$date[0])->whereRaw('month(created_at) = ?',$date[1])->whereRaw('day(created_at) = ?',$date[2])->paginate(8);
            }else{
                $list_order=Order::where('status',$status)->whereRaw('year(created_at) = ?',$date[0])->whereRaw('month(created_at) = ?',$date[1])->whereRaw('day(created_at) = ?',$date[2])->paginate(8);
            }
        }

        $count = array(
            'all' => Order::count(),
            'received' => Order::where('status', 'received')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'being transported' => Order::where('status', 'being transported')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        );

        return view('admin.orders.index', compact('list_order', 'count'));
    }

    function process(Request $request, $id)
    {
        $status = $request->input('status');
        if($status=='being transported'){
            Order::where('id',$id)->update([
                'status'=>$status
            ]);

            return redirect(route('admin.order.index'));
        }
        
        $order = Order::find($id);
        $order->status='processing';
        $order->save();

        return view('admin.orders.process', compact('order'));
    }

    function process2(Request $request,$id){
        
    }

    function exit($id){
        Order::where('id',$id)->update([
            'status'=>'received'
        ]);

        return redirect(route('admin.order.index'));
    }
}
