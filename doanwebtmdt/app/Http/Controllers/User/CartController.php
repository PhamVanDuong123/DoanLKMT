<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Double;

class CartController extends Controller
{
    function show()
    {
        $list_pro = Cart::content();
        foreach($list_pro as &$item){
            $item->options->url_detail=route('product.detail',$item->id);   
        }
        return view('user.cart.show', compact('list_pro'));
    }

    function add($id)
    {
        $data = array();
        $product = Product::find($id);
        //Cart::destroy();

        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => [
                'thumb' => $product->thumb
            ]
        ]);
        // return redirect('user/cart/show');
        $data['html_cart'] = $this->update_html_cart();
        $data['success'] = "Sản phẩm đã được thêm thành công vào giỏ hàng";

        echo json_encode($data);
    }

    function remove($rowId)
    {
        Cart::remove($rowId);

        $data['html_cart'] = $this->update_html_cart();
        $data['cart'] = $this->update_cart();

        echo json_encode($data);
    }

    function destroy()
    {
        Cart::destroy();
        Session::forget('promotion');

        $data['html_cart'] = $this->update_html_cart();

        echo json_encode($data);
    }

    function update(Request $request)
    {
        $qty = $_POST['qty'];
        $id = $_POST['id'];

        Cart::update($id, $qty);

        //lấy đối tượng trong giỏ hàng
        $product_cart=Cart::get($id);
        

        $data['html_cart'] = $this->update_html_cart();
        $data['num_cart'] = "<p>Có <strong>".Cart::count()."</strong> sản phẩm trong giỏ hàng</p>";
        $data['product_cart']=$product_cart;
        $data['cart']=Cart::content();
        $data['promotion']=Session::get('promotion');

        echo json_encode($data);
    }

    function checkout()
    {
        $shipping_fee = 20000;
        $total = Cart::total();
        $total = (float)str_replace(array(',', '.'), '', $total);
        $total += $shipping_fee;        

        return view('user.cart.checkout', compact('shipping_fee', 'total'));
    }

    function pay(Request $request)
    {
        $shipping_fee = 20000;
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment' => 'required'
        ], [
            'required' => ':attribute không được để trống!',
            'payment.required' => 'Bạn chưa chọn phương thức thanh toán'
        ], [
            'name' => 'Họ tên',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
        ]);

        $order = Order::create([
            'code' => 'DH-0' . Order::get()->max()->id + 1,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'shipping_fee' => $shipping_fee,
            'payment' => $request->payment,
            'promotion_code' => $request->promotion_code,
            'user_id' => Auth::id()
        ]);
        // dd(Cart::content());
        foreach (Cart::content() as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'number' => $item->qty,
                'price' => $item->price,
                'price_cost' => Product::where('id', $item->id)->first()->price_cost
            ]);
        }

        //Xóa giỏ hàng sau khi đặt hàng
        Cart::destroy();
        
        //Xóa mã khuyến mãi
        Session::forget('promotion');

        return redirect(route('home'))->with('success', 'Đặt hàng thành công');
    }

    function update_html_cart()
    {
        $data = "
        <div id='btn-cart'>
        <a class='text-white' href='http://localhost:8080/DoanLKMT/doanwebtmdt/user/cart/show'><i class='fa fa-shopping-cart' aria-hidden='true'></i></a>
                                    <span id='num'>" . Cart::count() . "</span>
                                </div>
                                <div id='dropdown'>
                                    <p class='desc'>Có <span>" . Cart::count() . " sản phẩm</span> trong giỏ hàng</p>";
        if (Cart::count() > 0) {
            $data .= "
                                        <ul class='list-cart'>";
            foreach (Cart::content() as $product) {
                $data .= "
                                            <li class='clearfix'>
                                            <a href='' title='' class='thumb fl-left'>
                                                <img src='" . $product->options->thumb . "' alt=''>
                                            </a>
                                            <div class='info fl-right'>
                                                <a href='' title='' class='product-name'>" . $product->name . "</a>
                                                <p class='price'>" . number_format($product->price, 0, ',', '.') . "đ</p>
                                                <p class='qty'>Số lượng: <span>" . $product->qty . "</span></p>
                                            </div>
                                        </li>
                                            ";
            }

            $data .= "</ul>";
        }

        $data .= "<div class='total-price clearfix'>
                                    <p class='title fl-left'>Tổng:</p>
                                    <p class='price fl-right'>" . Cart::total() . "đ</p>
                                </div>
                                <div class='action-cart clearfix'>
                                    <a href='http://localhost:8080/DoanLKMT/doanwebtmdt/user/cart/show' title='Giỏ hàng' class='view-cart fl-left'>Giỏ hàng</a>
                                    ";
        if (Cart::count() > 0) {
            $data .= "<a href='http://localhost:8080/DoanLKMT/doanwebtmdt/user/cart/checkout' title='Thanh toán' class='checkout fl-right'>Thanh toán</a>";
        }
        $data .= "</div>
                            </div>";

        return $data;
    }

    function update_cart()
    {
        $t = 0;
        $data = "
            <div class='section-detail table-responsive'>
                <table class='table'>
        <thead>
                        <tr>
                            <td scope='col'>STT</td>
                            <td scope='col'>Ảnh sản phẩm</td>
                            <td scope='col'>Tên sản phẩm</td>
                            <td scope='col'>Giá sản phẩm</td>
                            <td scope='col'>Số lượng</td>
                            <td scope='col' colspan='2'>Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>";
        foreach (Cart::content() as $product) {
            $t++;
            $data .= "
                            <tr>
                            <td scope='row'>" . $t . "</td>
                            <td scope='col'>
                                <a href='' title='' class='thumb'>
                                    <img src='" . $product->options->thumb . "' alt=''>
                                </a>
                            </td>
                            <td scope='col'>
                                <a href='' title='' class='name-product'>" . $product->name . "</a>
                            </td>
                            <td scope='col'>" . number_format($product->price, 0, ',', '.') . "đ</td>
                            <td scope='col'>
                                <input type='number' name='qty[" . $product->rowId . "]' min='1' data-rowId='" . $product->rowId . "' value='" . $product->qty . "' class='num-order'>
                            </td>
                            <td scope='col'>" . number_format($product->subtotal, 0, ',', '.') . "đ</td>
                            <td scope='col'>
                                <a href='javacript:' title='' data-rowId='" . $product->rowId . "' class='del-product'><i class='fa fa-trash-o'></i></a>
                            </td>
                        </tr>
                            ";
        }
        $data .= "
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan='7'>
                                <div class='clearfix'>
                                    <p id='total-price' class='fl-right'>Tổng giá: <span>" . Cart::total() . "đ</span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='7'>
                                <div class='clearfix'>
                                    <div class='fl-left'>
                                        <a href='http://localhost:8080/DoanLKMT/doanwebtmdt/' title='' id='buy-more'>Mua tiếp</a>
                                        <a href='javacript:' id='destroy-cart' title=''>Xóa tất cả giỏ hàng</a>
                                    </div>
                                    <div class='fl-right'>
                                        <a href='http://localhost:8080/DoanLKMT/doanwebtmdt/user/cart/checkout' title='' id='checkout-cart'>Thanh toán</a>                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                    </table>
            </div>
                    ";
        return $data;
    }
}
