<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
class HomeController extends Controller
{
    public function index()
    {
        $list_cate=ProductCategory::all();
        foreach($list_cate as &$cate){
            $cate['url_list_pro_by_cate']=route('product.showByCate',$cate->id);
        }

        $list_pro_selling=Product::select('*')->limit(4)->get();
        foreach($list_pro_selling as &$product){
            $product['url']=route('product.detail',$product->id);
            $product['url_checkout']=route('cart.checkout');
        }

        $list_highlight_pro=Product::select('*')->limit(6)->get();
        foreach($list_highlight_pro as &$product){
            $product['url']=route('product.detail',$product->id);
            $product['url_add_cart']=route('cart.add',$product->id);
            $product['url_checkout']=route('cart.checkout');
        }        
        
        return view('user.index',compact('list_cate','list_pro_selling','list_highlight_pro'));

    }
     public function search(Request $request)
    {
      $keyword=$request->keyword_submit;
      $search_product = Product::where('name', 'like', "%{$keyword}%")->get();

       return view('user.product.search')->with('search_product',$search_product)->with('keyword',$keyword);
    }
}
