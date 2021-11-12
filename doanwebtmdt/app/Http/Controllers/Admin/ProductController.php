<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use HasFactory;
class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'product']);
            return $next($request);
        });
    }

    function index(Request $request)
    {
        $key = $request->input('key');

        $status = $request->input('status');
        $search_option = $request->input('search_option_product');
        $list_action = array(
            'trash' => 'Xóa tạm thời'
        );
         //search_option = title
         if ($search_option == 'title' || $search_option == '') {
            $list_Product = Product::where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);

            if ($status == 'trash') {
                $list_action = array(
                    'active' => 'Khôi phục',
                    'forceDelete' => 'Xóa vĩnh viễn'
                );
                $list_Product = Product::onlyTrashed()->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
            }

            if ($status == 'approved') {
                $list_Product = Product::where('status', 'approved')->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
            }

            if ($status == 'not approved yet') {
                $list_action = array(
                    'approved' => 'Duyệt',
                    'trash' => 'Xóa tạm thời'
                );
                $list_Product = Product::where('status', 'not approved yet')->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
            }
        }
         //search_option = brand
        if ($search_option == 'brand') {
            $brand = Brand::where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
            $list_id = array();
            foreach ($brand as $item) {
                $list_id[] = $item->id;
            }
            $list_Product = Product::whereIn('brand_id', $list_id)->orderByDesc('id')->paginate(5);

            if ($status == 'trash') {
                $list_action = array(
                    'active' => 'Khôi phục',
                    'forceDelete' => 'Xóa vĩnh viễn'
                );
                $list_Product = Product::whereIn('brand_id', $list_id)->orderByDesc('id')->paginate(5);
            }

            if ($status == 'approved') {
                $list_Product = Product::whereIn('brand_id', $list_id)->orderByDesc('id')->paginate(5);
            }

            if ($status == 'not approved yet') {
                $list_action = array(
                    'approved' => 'Duyệt',
                    'trash' => 'Xóa tạm thời'
                );
                $list_Product = Product::whereIn('brand_id', $list_id)->orderByDesc('id')->paginate(5);
            }
        }
        //search_option = product_category
        if ($search_option == 'category') {
            $product_category = ProductCategory::where('name', 'like', "%{$key}%")->get();
            $list_id = array();
            foreach ($product_category as $item) {
                $list_id[] = $item->id;
            }
            $list_Product = Product::whereIn('product_category_id', $list_id)->orderByDesc('id')->paginate(5);
            if ($status == 'trash') {
                $list_action = array(
                    'active' => 'Khôi phục',
                    'forceDelete' => 'Xóa vĩnh viễn'
                );
                $list_Product = Product::whereIn('product_category_id', $list_id)->orderByDesc('id')->paginate(5);
            }

            if ($status == 'approved') {
                $list_Product = Product::whereIn('product_category_id', $list_id)->orderByDesc('id')->paginate(5);
            }

            if ($status == 'not approved yet') {
                $list_action = array(
                    'approved' => 'Duyệt',
                    'trash' => 'Xóa tạm thời'
                );
                $list_Product = Product::whereIn('product_category_id', $list_id)->orderByDesc('id')->paginate(5);
            }
        }
         //search_option = country
       


        $count = array(
            'approved' => Product::where('status', 'approved')->count(),
            'not approved yet' => Product::where('status', 'not approved yet')->count(),
            'trash' => Product::onlyTrashed()->count(),
            'all' => Product::count()
        );

        return view('admin.product.index', compact('list_Product', 'count', 'list_action'));
    }

    function detail($id)
    {
        $product = Product::withTrashed()->find($id);

        return view('admin.product.detail', compact('product'));
    }

    function add()
    {
        $list_product_cate = ProductCategory::all();
        $list_brand_cate = Brand::all();

        return view('admin.product.add', compact('list_product_cate','list_brand_cate' ));
    }

    function store(Request $request)
    {
        //dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:5|max:200',
                'brand_id'=>'required',
                'short_desc' => 'required|min:10|max:300',
                'product_category_id' => 'required',
                'thumb' => 'required|image|max:20480',
                'price'=>'required',
                'old_price'=>'required',
                'price_cost'=>'required|lte:price',
            ],
            [
                'required' => ':attribute không được để trống',
                'numeric'=>':attribute định dạng là số',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa thiểu là :max ký tự',
                'thumb.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
                'price_cost.lte' =>'Giá gốc không được lớn hơn giá bán'
            ],
            [
                'name' => 'Tên sản phẩm',
                'code' => 'Mã sản phẩm',
                'brand_id'=> 'Thương hiệu',
                'price'=>"Giá bán",
                'old_price'=>"Giá cũ",
                'price_cost'=>"Giá gốc",
                'short_desc' => 'Tóm tắt ngắn',
                'product_category_id' => 'Danh mục sản phẩm',
                'thumb' => 'Ảnh đại diện',
            ]
        );

        if ($request->hasFile('thumb')) {
            $file = $request->thumb;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $thumb = asset('uploads/' . $fileName);
        }       
            $product = Product::create([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name')),
            'brand_id' => $request->input('brand_id'),
            'price'=>filter_var($request->input('price'),FILTER_SANITIZE_NUMBER_INT),
            'old_price'=>filter_var($request->input('old_price'),FILTER_SANITIZE_NUMBER_INT),
            'price_cost'=>filter_var($request->input('price_cost'),FILTER_SANITIZE_NUMBER_INT),
            'inventory_num'=>$request->input('inventory_num'),
            'short_desc' => $request->input('short_desc'),
            'detail_desc'=>$request->input('detail_desc'),
            'warranty'=>$request->input('warranty'),
            'product_category_id' => $request->input('product_category_id'),
            'user_id' => Auth::id(),
            'thumb' => $thumb,
        ]); 
        $route_detail = route('admin.product.detail',$product->id);
        
        return redirect(route('admin.product.index'))->with('success', "Thêm sản phẩm mới thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\"> vào đây </a> để xem chi tiết!");
    }

    function delete(Request $request, $id)
    {
        $status = $request->input('status');
        if ($status == 'trash') {
            Product::onlyTrashed()->forceDelete();
            return redirect(route('admin.product.index', ['status' => 'trash']))->with('success', 'Xóa vĩnh viễn bài viết thành công');
        } else {
            Product::destroy($id);
            return redirect(route('admin.product.index'))->with('success', 'Xóa bài viết thành công');
        }
    }

    function action(Request $request)
    {
        $list_Product_id = $request->input('list_Product_id');

        if ($list_Product_id) {
            $action = $request->input('action');

            if ($action == 'trash') {
                Product::destroy($list_Product_id);

                return redirect(route('admin.product.index', ['status' => 'trash', 'page' => 1]))->with('success', 'Xóa bài viết thành công');
            }
            if ($action == 'approved') {
                Product::where('status', 'not approved yet')->whereIn('id', $list_Product_id)->update(['status' => 'approved']);

                return redirect(route('admin.product.index', ['status' => 'trash']))->with('success', 'Phê duyệt bài viết thành công');
            }
            if ($action == 'active') {
                Product::onlyTrashed()->whereIn('id', $list_Product_id)->restore();

                return redirect(route('admin.product.index', ['status' => 'trash']))->with('success', 'Khôi phục bài viết thành công');
            }
            if ($action == 'forceDelete') {
                Product::onlyTrashed()->whereIn('id', $list_Product_id)->forceDelete();

                return redirect(route('admin.product.index', ['status' => 'trash']))->with('success', 'Xóa vĩnh viễn bài viết thành công');
            }

            return redirect(route('admin.product.index'))->with('error', 'Bạn chưa chọn hành động nào');
        } else {
            return redirect(route('admin.product.index'))->with('error', 'Bạn chưa chọn bài viết nào');
        }
    }

    function edit(Request $request, $id)
    {
        $list_product_cate = ProductCategory::all();
       // $product = Product::find($id);
        $list_brand_cate = Brand::all();
       // $brand=Brand::find($id);
        $product = Product::withTrashed()->find($id);
      

        return view('admin.product.edit', compact('product', 'list_product_cate','list_brand_cate'));
    }

    function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:5|max:200',
                'brand_id'=>'required',
                'short_desc' => 'required|min:10|max:300',
                'product_category_id' => 'required',
                'thumb' => 'image|max:20480',
                'price'=>'required',
                'old_price'=>'required',
                'price_cost'=>'required|lte:price',
            ],
            [
                'required' => ':attribute không được để trống',
                'numeric'=>':attribute định dạng là số',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa thiểu là :max ký tự',
                'thumb.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
                'price_cost.lte' =>'Giá gốc không được lớn hơn giá bán'
            ],
            [
                'name' => 'Tên sản phẩm',
                'code' => 'Mã sản phẩm',
                'brand_id'=> 'Thương hiệu',
                'price'=>"Giá bán",
                'old_price'=>"Giá cũ",
                'price_cost'=>"Giá gốc",
                'short_desc' => 'Tóm tắt ngắn',
                'product_category_id' => 'Danh mục sản phẩm',
                'thumb' => 'Ảnh đại diện',
            ]
        );      
            $thumb = Product::withTrashed()->find($id)->thumb;

            $this->upload_image($request, 'thumb',$thumb);

            Product::withTrashed()->where('id', $id)->update([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name')),
            'brand_id' => $request->input('brand_id'),
            'price'=>filter_var($request->input('price'),FILTER_SANITIZE_NUMBER_INT),
            'old_price'=>filter_var($request->input('old_price'),FILTER_SANITIZE_NUMBER_INT),
            'price_cost'=>filter_var($request->input('price_cost'),FILTER_SANITIZE_NUMBER_INT),
            'inventory_num'=>$request->input('inventory_num'),
            'short_desc' => $request->input('short_desc'),
            'detail_desc'=>$request->input('detail_desc'),
            'warranty'=>$request->input('warranty'),
            'product_category_id' => $request->input('product_category_id'),           
            'thumb' => $thumb             
            ]);
            $status = $request->input('status');
            
         
            $route_detail = route('admin.product.detail',$id);
            if ($status == 'trash') {
                return redirect(route('admin.product.index', ['status' => 'trash']))->with('success', "Cập nhật bài viết thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
            } else {
                return redirect(route('admin.product.index',['status'=>$status]))->with('success', "Cập nhật khuyến mãi thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
            }
    }

    function upload_image($request, $image,&$thumb)
    {
        if ($request->hasFile($image)) {
            //lấy file
            $file = $request->$image;

            //lấy tên file
            $fileName = $file->getClientOriginalName();

            //đưa file lên server
            $file->move('public\uploads', $fileName);

            $thumb = 'http://localhost:8081/DoanLKMT/doanwebtmdt/public/uploads/' . $fileName;
        }
    }

    function approve(Request $request){
        $list_pro_not_approve=Product::where('status','not approved yet')->paginate(5);
        
        $key=$request->key;
        if(!empty($key)){
            $list_pro_not_approve=Product::where('status','not approved yet')->where('name','like',"%{$key}%")->paginate(5);
        }

        return view('admin.product.approve',compact('list_pro_not_approve'));
    }

    function approve_pro(Request $request,$id){
        $status = $request->status;
        if($status=='approved'){
            $product=Product::find($id);
            $product->status=$status;
            $product->save();

            return redirect(route('admin.product.approve'))->with('success','Xét duyệt sản phẩm thành công');
        }else{
            return redirect()->back()->with('error','Bạn chưa thay đổi trạng thái xét duyệt');
        }        
    }
}
