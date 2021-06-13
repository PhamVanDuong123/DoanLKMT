<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;

class ProductController extends Controller
{
    function index(){
        $list_pro=Product::paginate(10);
        if(!empty($list_pro)){
            foreach($list_pro as &$product){
                $product['url']=route('product.detail',$product->id);
                $product['url_add_cart']=route('cart.add',$product->id);
                $product['url_checkout']=route('cart.checkout');
            }
        }

        $list_cate=ProductCategory::all();
        foreach($list_cate as &$catetegory){
            $catetegory['url_list_pro_by_cate']=route('product.showByCate',$catetegory->id);
        }

        return view('user.product.index',compact('list_pro','list_cate'));
    }

    function showByCategory($cate_id){
        $cate=ProductCategory::find($cate_id);
        
        $list_pro=Product::where('product_category_id',$cate_id)->paginate(4);
        if(!empty($list_pro)){
            foreach($list_pro as &$product){
                $product['url']=route('product.detail',$product->id);
                $product['url_add_cart']=route('cart.add',$product->id);
                $product['url_checkout']=route('cart.checkout');
            }
        }

        $list_cate=ProductCategory::all();
        foreach($list_cate as &$catetegory){
            $catetegory['url_list_pro_by_cate']=route('product.showByCate',$catetegory->id);
        }

        return view('user.product.showByCaterory',compact('cate','list_pro','list_cate'));
    }

    function detail($id){
        $product=Product::find($id);
        $product['url_add_cart']=route('cart.add',$id);
        $product['url_checkout']=route('cart.checkout');

        $list_pro_image=ProductImage::where('product_id',$id)->get();

        $list_pro_same_cate=Product::where('product_category_id',$product->product_category_id)->get();
        if(!empty($list_pro_same_cate)){
            foreach($list_pro_same_cate as &$pro){
                $pro['url']=route('product.detail',$pro->id);
                $pro['url_add_cart']=route('cart.add',$pro->id);
                $pro['url_checkout']=route('cart.checkout');
            }
        }

        $list_cate=ProductCategory::all();
        foreach($list_cate as &$cate){
            $cate['url_list_pro_by_cate']=route('product.showByCate',$cate->id);
        }

        return view('user.product.detail',compact('product','list_pro_image','list_pro_same_cate','list_cate'));
    }
}
