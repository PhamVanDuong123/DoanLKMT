<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function detail($name){
        $page=Page::where('code','like',$name)->select('*')->first();

        $list_pro_selling=Product::select('*')->limit(6)->get();
        foreach($list_pro_selling as &$product){
            $product['url']=route('product.detail',$product->id);
            $product['url_checkout']=route('cart.checkout');
        }
        return view('user.page.detail',compact('page','list_pro_selling'));
    }
}
