<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index(){
        $list_post=Post::paginate(2);
        foreach($list_post as &$post){
            $post['url']=route('post.detail',$post->id);
        }
        
        $list_pro_selling=Product::select('*')->limit(6)->get();
        foreach($list_pro_selling as &$product){
            $product['url']=route('product.detail',$product->id);
            $product['url_checkout']=route('cart.checkout');
        }
        return view('user.post.index',compact('list_post','list_pro_selling'));
    }

    function detail($id){
        $post=Post::find($id);

        $list_pro_selling=Product::select('*')->limit(6)->get();
        foreach($list_pro_selling as &$product){
            $product['url']=route('product.detail',$product->id);
            $product['url_checkout']=route('cart.checkout');
        }

        return view('user.post.detail',compact('post','list_pro_selling'));
    }
}
