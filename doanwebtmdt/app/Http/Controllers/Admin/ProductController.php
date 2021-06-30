<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\Brand;
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

        $list_Product = Product::where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);

        $list_action = array(
            'trash' => 'Xóa tạm thời'
        );

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
            $list_Product = Product::where('status', 'not approved yet')->where('name', 'like', "%{$key}%")->paginate(5);
        }

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
        $product = Product::find($id);

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
           
                'short_desc' => 'required|min:10|max:300',
                'product_category_id' => 'required',
                'thumb' => 'required|image|max:20480',
                'price'=>'required|numeric',
                'old_price'=>'required|numeric',
                

                
            ],
            [
                'required' => ':attribute không được để trống',
                'numeric'=>':attribute định dạng là số',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa thiểu là :max ký tự',
                'thumb.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
            ],
            [
                'name' => 'Tên sản phẩm',
                'code' => 'Mã sản phẩm',
                'price'=>"Giá bán",
                'old_price'=>"Giá cũ",
                'short_desc' => 'Tóm tắt ngắn',
                'product_category_id' => 'Danh mục sản phẩm',
                'thumb' => 'Ảnh đại diện',
                
            ]
        );

        if ($request->hasFile('thumb')) {
            $file = $request->thumb;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $thumb = 'http://localhost:8081/DoanLKMT/doanwebtmdt/public/uploads/' . $fileName;
        }
       
         Product::create([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name')),
            'brand_id' => $request->input('brand_id'),
            'price'=>$request->input('price'),
            'old_price'=>$request->input('old_price'),
           
            'inventory_num'=>$request->input('inventory_num'),
            'short_desc' => $request->input('short_desc'),
            'detail_desc'=>$request->input('detail_desc'),
            'warranty'=>$request->input('warranty'),

            'product_category_id' => $request->input('product_category_id'),
            'user_id' => Auth::id(),
            'thumb' => $thumb,
             
            
           
           
        ]); 

        return redirect(route('admin.product.index'))->with('thongbao', 'Thêm sản phẩm mới thành công');
    }

    function delete(Request $request, $id)
    {
        $status = $request->input('status');
        if ($status == 'trash') {
            Product::onlyTrashed()->forceDelete();
            return redirect(route('admin.product.index', ['status' => 'trash']))->with('thongbao', 'Xóa vĩnh viễn bài viết thành công');
        } else {
            Product::destroy($id);
            return redirect(route('admin.product.index'))->with('thongbao', 'Xóa bài viết thành công');
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

                return redirect(route('admin.product.index', ['status' => 'trash']))->with('thongbao', 'Phê duyệt bài viết thành công');
            }
            if ($action == 'active') {
                Product::onlyTrashed()->whereIn('id', $list_Product_id)->restore();

                return redirect(route('admin.product.index', ['status' => 'trash']))->with('thongbao', 'Khôi phục bài viết thành công');
            }
            if ($action == 'forceDelete') {
                Product::onlyTrashed()->whereIn('id', $list_Product_id)->forceDelete();

                return redirect(route('admin.product.index', ['status' => 'trash']))->with('thongbao', 'Xóa vĩnh viễn bài viết thành công');
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
                'name' => 'required|min:10|max:200',
                'short_desc' => 'required|min:10|max:300',
                'product_category_id' => 'required',
                'thumb' => 'image|max:20480',
               
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối thiểu là :max ký tự',
                'thumb.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
            ],
            [
                'name' => 'Tiêu đề bài viết',
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
            'price'=>$request->input('price'),
            'old_price'=>$request->input('old_price'),
           
            'inventory_num'=>$request->input('inventory_num'),
            'short_desc' => $request->input('short_desc'),
            'detail_desc'=>$request->input('detail_desc'),
            'warranty'=>$request->input('warranty'),

            'product_category_id' => $request->input('product_category_id'),
           
            'thumb' => $thumb,
             
            ]);
            $status = $request->input('status');
            if ($status == 'trash') {
                return redirect(route('admin.product.index', ['status' => 'trash']))->with('thongbao', 'Cập nhật sản phẩm thành công');
            } else {
                return redirect(route('admin.product.index'))->with('thongbao', 'Cập nhật sản phẩm thành công');
            }
    }

    function upload_image($request, $image,&$thumb)
    {
        if ($request->hasFile($image)) {
            $file = $request->$image;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $thumb = 'http://localhost:8081/DoanLKMT/doanwebtmdt/public/uploads/' . $fileName;
        }
    }
}
