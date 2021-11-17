<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{ 
    function index(){
        $list_pro=Product::where('status','approved')->paginate(10);
        if(!empty($list_pro)){
            foreach($list_pro as &$product){
                $product['url']=route('product.detail',$product->id);
                $product['url_add_cart']=route('cart.add',$product->id);
                $product['url_checkout']=route('cart.checkout');
            }
        }

        if(isset($_GET['sort_by']))
        {
          $sort_by = $_GET['sort_by'];
       
          if($sort_by=='giam_dan')
          {
              $list_pro=Product::where('status','approved')->orderBy('price','DESC')->paginate(10);
          }
          elseif($sort_by=='tang_dan')
          {
              $list_pro=Product::where('status','approved')->orderBy('price','ASC')->paginate(10);
          }
         elseif($sort_by=='kytu_za')
         {
          $list_pro=Product::where('status','approved')->orderBy('name','DESC')->paginate(10);
         }
         elseif($sort_by=='kytu_az'){
          $list_pro=Product::where('status','approved')->orderBy('name','ASC')->paginate(10);
          }
        }
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
        
        $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->paginate(4);
     
        $list_cate=ProductCategory::all();
        foreach($list_cate as &$catetegory){
            $catetegory['url_list_pro_by_cate']=route('product.showByCate',$catetegory->id);
        }
     
        if(isset($_GET['sort_by']))
        {
            $sort_by = $_GET['sort_by'];
         
            if($sort_by=='giam_dan')
            {
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('price','DESC')->paginate(4);
            }
            elseif($sort_by=='tang_dan')
            {
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('price','ASC')->paginate(4);
            }
           elseif($sort_by=='kytu_za')
           {
            $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('name','DESC')->paginate(4);
           }
           elseif($sort_by=='kytu_az'){
            $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('name','ASC')->paginate(4);
            }  
        }
      
        if(!empty($list_pro)){
            foreach($list_pro as &$product){
                $product['url']=route('product.detail',$product->id);
                $product['url_add_cart']=route('cart.add',$product->id);
                $product['url_checkout']=route('cart.checkout');
            }
        }
         
        return view('user.product.showByCaterory',compact('cate','list_pro','list_cate'));
    }

    function flitterByCategory($cate_id){
        $cate=ProductCategory::find($cate_id);
        
    
        if(!empty($list_pro)){
            foreach($list_pro as &$product){
                $product['url']=route('product.detail',$product->id);
                $product['url_add_cart']=route('cart.add',$product->id);
                $product['url_checkout']=route('cart.checkout');
            }
        }
       
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
        $product=Product::where('status','approved')->find($id);
        $product['url_add_cart']=route('cart.add',$id);
        $product['url_checkout']=route('cart.checkout');

        $list_pro_image=ProductImage::where('product_id',$id)->get();

        $list_pro_same_cate=Product::where('status','approved')->where('product_category_id',$product->product_category_id)->get();
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
    


    

