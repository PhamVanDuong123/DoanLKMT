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
          if($sort_by=='sp_hot')
          {
              $list_pro=Product::where('status','approved')->orderBy('views','DESC')->paginate(10)->appends(request()->query());
          }
          if($sort_by=='sp_moi')
          {
              $list_pro=Product::where('status','approved')->orderBy('created_at','DESC')->paginate(10)->appends(request()->query());
          }
          if($sort_by=='giam_dan')
          {
              $list_pro=Product::where('status','approved')->orderBy('price','DESC')->paginate(10)->appends(request()->query());
          }
          elseif($sort_by=='tang_dan')
          {
              $list_pro=Product::where('status','approved')->orderBy('price','ASC')->paginate(10)->appends(request()->query());
          }
         elseif($sort_by=='kytu_za')
         {
          $list_pro=Product::where('status','approved')->orderBy('name','DESC')->paginate(10)->appends(request()->query());
         }
         elseif($sort_by=='kytu_az'){
          $list_pro=Product::where('status','approved')->orderBy('name','ASC')->paginate(10)->appends(request()->query());
         }
         elseif($sort_by=='kytu_az'){
            $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('name','ASC')->paginate(4);
            }  
        // giá tiền
            elseif($sort_by=='duoi500k'){
                $list_pro=Product::where('status','approved')->where('price','<',500000)->paginate(10)->appends(request()->query());
            } 
            elseif($sort_by=='500_1000k'){
                $list_pro=Product::where('status','approved')->whereBetween('price',[500000,1000000])->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='1000k_2000k'){
                $list_pro=Product::where('status','approved')->whereBetween('price',[1000000,2000000])->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='tren_2000k'){
                $list_pro=Product::where('status','approved')->whereBetween('price',[2000000,5000000])->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='tren_5000k'){
                $list_pro=Product::where('status','approved')->whereBetween('price',[5000000,10000000])->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='tren_10tr'){
                $list_pro=Product::where('status','approved')->where('price','>',10000000)->paginate(10)->appends(request()->query());
            }
            //nhà sản xuất
            elseif($sort_by=='Asus'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',1)->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='Intel'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',2)->paginate(10)->appends(request()->query());
            }

            elseif($sort_by=='ASRock'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',3)->paginate(10)->appends(request()->query());
            }

            elseif($sort_by=='Nvidia'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',4)->paginate(10)->appends(request()->query());
            }

            elseif($sort_by=='AMD'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',16)->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='MSI'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',17)->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='Logitech'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',12)->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='Kingmax'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',15)->paginate(10)->appends(request()->query());
            }
            elseif($sort_by=='Corsair'){
                $list_pro=Product::where('status','approved')->where('brand_id','=',13)->paginate(10)->appends(request()->query());
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
            if($sort_by=='sp_moi')
            {
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('created_at','DESC')->paginate(4)->appends(request()->query());
            }
         
            if($sort_by=='giam_dan')
            {
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('price','DESC')->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='tang_dan')
            {
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('price','ASC')->paginate(4)->appends(request()->query());
            }
           elseif($sort_by=='kytu_za')
           {
            $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('name','DESC')->paginate(4)->appends(request()->query());
           }
           //thương hiệu
           elseif($sort_by=='kytu_az'){
            $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->orderBy('name','ASC')->paginate(4)->appends(request()->query());
            }  
            elseif($sort_by=='duoi500k'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('price','<',500000)->paginate(4)->appends(request()->query());
            } 
            elseif($sort_by=='500_1000k'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->whereBetween('price',[500000,1000000])->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='1000k_2000k'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->whereBetween('price',[1000000,2000000])->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='tren_2000k'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->whereBetween('price',[2000000,5000000])->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='tren_5000k'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->whereBetween('price',[5000000,10000000])->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='tren_10tr'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('price','>',10000000)->paginate(4)->appends(request()->query());
            }
            //nhà sản xuất
            elseif($sort_by=='Asus'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',1)->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='Intel'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',2)->paginate(4)->appends(request()->query());
            }

            elseif($sort_by=='ASRock'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',3)->paginate(4)->appends(request()->query());
            }

            elseif($sort_by=='Nvidia'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',4)->paginate(4)->appends(request()->query());
            }

            elseif($sort_by=='AMD'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',16)->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='MSI'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',17)->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='Logitech'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',12)->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='Kingmax'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',15)->paginate(4)->appends(request()->query());
            }
            elseif($sort_by=='Corsair'){
                $list_pro=Product::where('status','approved')->where('product_category_id',$cate_id)->where('brand_id','=',13)->paginate(4)->appends(request()->query());
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
    


    

