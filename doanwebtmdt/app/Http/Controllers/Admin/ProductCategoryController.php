<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use HasFactory;
class ProductCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'product_category']);
            return $next($request);
        });
    }
    
    public function index(Request $request)

    {
         $key = $request->input('key');

        $status = $request->input('status');

        $list_product_category = ProductCategory::where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(15);

        $list_action = array(
            'trash' => 'Xóa tạm thời'
        );

        if ($status == 'trash') {
            $list_action = array(
                'active' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            );
            $list_product_category = ProductCategory::onlyTrashed()->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);

        }

     
        $count = array(
          /*   'approved' => ProductCategory::where('status', 'approved')->count(),
            'not approved yet' => ProductCategory::where('status', 'not approved yet')->count(), */
            'trash' => ProductCategory::onlyTrashed()->count(),
            'active' => ProductCategory::count()
        );

      

      //  return view('admin.product_category.index',['product_category'=>$product_category]);
        return view('admin.product_category.index', compact('list_product_category', 'count', 'list_action'));
     
    }
    public function getadd()
    {
       
        return view('admin.product_category.add');
     
    }
    public function postadd(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'required|regex:/^([A-Za-zÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴáàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+){1,60}$/',
            'code' => 'required|min:5|max:30|unique:post_categories',
           
        ],
        [
            'name.regex'=>'Họ tên phải có định dạng là chữ cái hoặc khoảng trắng',
            'code.regex'=>'code phải có định dạng là chữ cái hoặc khoảng trắng',
            'unique'=>' :attribute không được trùng',
            'required'=>':attribute không được để trống',
            'min'=>':attribute có độ dài tối thiểu là :min',
            'max'=>':attribute có độ dài tối đa là :max',
         
        ],
        [       'name' => 'Tên loại sản phẩm',
                'code' => 'Mã loại sản phẩm',
                
        ]
    );
        
        $product_category=new ProductCategory;
        $product_category->name=$request->name;
        $product_category->code=Str::slug($request->code);
        $product_category->description=$request->description;
        $product_category->user_id=Auth::user()->id;
        $product_category->save();
        return redirect('admin/product_category/index')->with('thongbao','Thêm loại sản phẩm thành công');


    }
    public function postedit(Request $request,$id)
    {
        $product_category=ProductCategory::find($id);
        $this->validate($request,
        [
            'name'=>'required|regex:/^([A-Za-zÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴáàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+){1,60}$/',
          
           
        ],
        [
            'name.regex'=>'Họ tên phải có định dạng là chữ cái hoặc khoảng trắng',
          
          
            'required'=>':attribute không được để trống',
            'min'=>':attribute có độ dài tối thiểu là :min',
            'max'=>':attribute có độ dài tối đa là :max',
         
        ]);
        
        
        $status=$request->input('status');
        if($status=='trash'){
            ProductCategory::onlyTrashed()->where('id',$id)->update([
                'name' => $request->input('name'),
                'code' => Str::slug($request->input('name')),
                'description' => $request->input('description')
            ]);

            return redirect(route('admin.product_category.index',['status'=>'trash']))->with('success', 'Cập nhật danh mục sản phẩm thành công');
        }else{
            ProductCategory::where('id',$id)->update([
                'name' => $request->input('name'),
                'code' => Str::slug($request->input('name')),
                'description' => $request->input('description')
            ]);

            return redirect(route('admin.product_category.index'))->with('thongbao', 'Cập nhật danh mục sản phẩm thành công');
        }
        

    }
    public function getedit($id)
    {
        $product_category=ProductCategory::withTrashed()->find($id);
        return view('admin.product_category.edit',['product_category'=>$product_category]);

    }
  
    public function deletecategory(Request $request,$id)
    {
        $status = $request->input('status');
        if ($status =='trash') {
            ProductCategory::onlyTrashed()->find($id)->forceDelete();
            return redirect(route('admin.product_category.index', ['status' => 'trash', 'page' => 1]))->with('thongbao', 'Xóa vĩnh viễn bài viết thành công');
        } else {
            ProductCategory::destroy($id);
            return redirect(route('admin.product_category.index',['status' => 'trash', 'page' => 1]))->with('thongbao', 'Xóa bài viết thành công');
        }
        
    }
    public function action(Request $request)
    {
        $list_product_category_id=$request->input('list_product_category_id');
        if($list_product_category_id){
        
        $action=$request->input('action');
        if($action=='trash'){
            ProductCategory::destroy($list_product_category_id);

            return redirect(route('admin.product_category.index'))->with('thongbao','xóa thành công loại sản phẩm');

        }
        if($action=='active')
        {
            ProductCategory::onlyTrashed()->whereIn('id',$list_product_category_id)->restore();
            return redirect(route('admin.product_category.index',['status'=>'trash']))->with('thongbao','khôi phục loại sản phẩm thành công');


        }
        if($action=='forceDelete')
        {
            ProductCategory::onlyTrashed()->whereIn('id',$list_product_category_id)->forceDelete();
            return redirect(route('admin.product_category.index'))->with('thongbao','Xóa vĩnh viễn loại sản phẩm thành công');
        }
        return redirect(route('admin.product_category.index'))->with('error','Bạn chưa chọn hành động nào');

    }
    else
    {
        return redirect(route('admin.product_category.index'))->with('error','Bạn chưa chọn loại sản phẩm nào ');
    }
  }


  
}
