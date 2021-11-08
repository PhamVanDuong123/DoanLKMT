<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PromotionController extends Controller
{
    function process(Request $request){
        $data = $request->all();
        
        if(!$this->check_code_exist($data['promotion_code'])){
            return redirect()->back()->with('error','Mã khuyến mãi này không tồn tại!');
        }elseif($this->check_num_code($data['promotion_code'])<1){
            return redirect()->back()->with('error','Mã khuyến mãi này đã được dùng hết!');
        }elseif(!$this->check_expiry_code($data['promotion_code'])){
            return redirect()->back()->with('error','Mã khuyến mãi này đã hết thời gian áp dụng!');
        }else{
            $promotion = Promotion::where('code',$data['promotion_code'])->where('status','approved')->first();
            $promotion->qty-=1;
            $promotion->save();
            // Session::flush();
            $promotion_session = Session::get('promotion');

            if($promotion_session){
                //dd($promotion_session);
                // echo "1";
                $pro[]=array(
                    'code'=>$promotion->code,
                    'condition'=>$promotion->condition,
                    'number'=>$promotion->number
                );
                // dd($pro);
                Session::put('promotion',$pro);
            }else{
                // echo "2";
                $pro[]=array(
                    'code'=>$promotion->code,
                    'condition'=>$promotion->condition,
                    'number'=>$promotion->number
                );
                //dd($pro);
                Session::put('promotion',$pro);
            }
            Session::save();

            return redirect()->back()->with(['success'=>'Mã giảm giá đã được áp dụng']);
        }
    }

    function check_code_exist($code){
        $data = Promotion::where('code',$code)->where('status','approved')->first();
        if($data){
            return true;
        }
        return false;
    }

    function check_num_code($code){
        $data = Promotion::where('code',$code)->where('status','approved')->first();
        return $data->qty;
    }

    function check_expiry_code($code){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $data = Promotion::where('code',$code)->where('status','approved')->where('start_day','<=',$now)->where('end_day','>=',$now)->first();
        if($data){
            return true;
        }
        return false;
    }
}
