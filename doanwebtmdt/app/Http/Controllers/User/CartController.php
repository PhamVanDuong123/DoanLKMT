<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Double;

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
        $shipping_fee = 20000;
        $total = Cart::total();
        $total = (Double)str_replace(array(',','.'),'',$total);
        $total+=$shipping_fee;

        return view('user.cart.checkout', compact('shipping_fee','total'));
    }

    function pay(Request $request){
        $shipping_fee=20000;
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
            'code'=>'DH-'.Order::get()->max()->id+1,
            'name'=>$request->name,            
            'phone'=>$request->phone,
            'address'=>$request->address,
            'note'=>$request->note,
            'shipping_fee'=> $shipping_fee,
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
