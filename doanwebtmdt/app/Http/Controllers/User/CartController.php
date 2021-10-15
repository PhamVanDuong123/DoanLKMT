<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function show(){
        $list_pro = Cart::content();
        // dd($list_pro);
        return view('user.cart.show',compact('list_pro'));
    }

    function add($id){
        $product = Product::find($id);
        //Cart::destroy();

        Cart::add(['id' => $id, 
        'name' => $product->name, 
        'qty' => 1, 
        'price' => $product->price, 
        'options' => [
            'thumb' => $product->thumb
        ]]);

        return redirect('user/cart/show');
    }

    function remove($rowId){
        Cart::remove($rowId);

        return redirect('user/cart/show');
    }

    function destroy(){
        Cart::destroy();

        return redirect('user/cart/show');
    }

    function update(Request $request){
        // dd($request->all());
        $data = $request->get('qty');

        foreach($data as $k=>$v){
            Cart::update($k, $v);
        }
        return redirect('user/cart/show');
    }

    function checkout(){
        // var_dump(Cart::total());
        // exit;
        // $shipping_fee=20000;
        // $total=(double)Cart::total();
        //$total=$total+$shipping_fee;
        // echo $total;
        // echo "----";
        // echo $shipping_fee;
        // echo "----";
        // echo $total2;
        // echo "----";
        // exit;
        // return view('user.cart.checkout',compact('total'));
        return view('user.cart.checkout');
    }

    function pay(Request $request){
        // dd($request->all());
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'payment'=>'required'
        ],[
            'required'=>':attribute không được để trống!',
            'payment.required'=>'Bạn chưa chọn phương thức thanh toán'
        ],[
            'name'=>'Họ tên',
            'phone'=>'Số điện thoại',
            'address'=>'Địa chỉ',
        ]);
        
        $order = Order::create([
            'code'=>'DH-12',
            'name'=>$request->name,            
            'phone'=>$request->phone,
            'address'=>$request->address,
            'note'=>$request->note,
            'shipping_fee'=>20000,
            'payment'=>$request->payment,
            'promotion_code'=>$request->promotion_code,
            'user_id'=>Auth::id()
        ]);
        // dd(Cart::content());
        foreach(Cart::content() as $item){
                OrderDetail::create([
                'order_id' => $order->id,
                'product_id' =>$item->id,
                'number'=>$item->qty,
                'price'=>$item->price,
            ]);
        }

        //Xóa giỏ hàng sau khi đặt hàng
        Cart::destroy();

        return redirect(route('home'))->with('success','Đặt hàng thành công');
    }
}
