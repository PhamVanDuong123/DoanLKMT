<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class PromotionController extends Controller
{
    function process(Request $request)
    {
        $data = $request->all();
        $result = array();
        $result['title']='Áp dụng mã giảm giá thất bại';
        $result['status']='error';

        if (!$this->check_code_exist($data['promotion_code'])) {            
            $result['message']='Mã khuyến mãi này không tồn tại!';
        } elseif ($this->check_num_code($data['promotion_code']) < 1) {
            $result['message']='Mã khuyến mãi này đã được dùng hết!';
        } elseif (!$this->check_expiry_code($data['promotion_code'])) {
            $result['message']='Mã khuyến mãi này đã hết thời gian áp dụng!';
        } elseif (!$this->check_total_order($data['promotion_code'])) {
            $promotion =  Promotion::where('code', $data['promotion_code'])->where('status', 'approved')->first();
            $min_total_order = number_format($promotion->min_total_order,0,',','.');

            $result['message']='Mã khuyến mãi này chỉ được áp dụng cho đơn hàng có tổng giá trị tối thiểu từ '.$min_total_order.'đ';
        } else {
            $promotion = Promotion::where('code', $data['promotion_code'])->where('status', 'approved')->first();
            $promotion->qty -= 1;
            $promotion->save();
            
            $promotion_session = Session::get('promotion');

            if ($promotion_session) {
                //trả lại sl mã khuyến mãi cũ nếu có
                $promotion_old = Promotion::where('code', $promotion_session[0]['code'])->first();
                $promotion_old->qty++;
                $promotion_old->save();

                $pro[] = array(
                    'code' => $promotion->code,
                    'condition' => $promotion->condition,
                    'number' => $promotion->number
                );
                // dd($pro);
                Session::put('promotion', $pro);
            } else {
                // echo "2";
                $pro[] = array(
                    'code' => $promotion->code,
                    'condition' => $promotion->condition,
                    'number' => $promotion->number
                );
                //dd($pro);
                Session::put('promotion', $pro);
            }
            
            $result['title']='Áp dụng mã giảm giá thành công';
            $result['status']='success';
            $result['message']='Mã giảm giá đã được áp dụng';
            
        }

        $result2['name']=$data['name'];
        $result2['phone']=$data['phone'];
        $result2['address']=$data['address'];
        $result2['note']=$data['note'];
        $result2['payment']=$data['payment'];
        Session::put('infoship', $result2);
        Session::save();

        echo json_encode($result);
    }

    function check_code_exist($code)
    {
        $data = Promotion::where('code', $code)->where('status', 'approved')->first();
        if ($data) {
            return true;
        }
        return false;
    }

    function check_num_code($code)
    {
        $data = Promotion::where('code', $code)->where('status', 'approved')->first();
        return $data->qty;
    }

    function check_expiry_code($code)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $data = Promotion::where('code', $code)->where('status', 'approved')->where('start_day', '<=', $now)->where('end_day', '>=', $now)->first();
        if ($data) {
            return true;
        }
        return false;
    }

    function check_total_order($code){
        $total = filter_var(Cart::total(),FILTER_SANITIZE_NUMBER_INT);
        $data = Promotion::where('code', $code)->where('status', 'approved')->first();

        if($data->condition==2){
            if($total<$data->min_total_order){
                return false;
            }                
        }

        return true;
    }
}
