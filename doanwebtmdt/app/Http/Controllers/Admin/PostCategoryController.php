<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'post_category']);
            return $next($request);
        });
    }

    function index(Request $request)
    {
        $key = $request->input('key');

        $status = $request->input('status');

        $list_action=array(
            'trash'=>'Xóa tạm thời'
        );

        $list_post_cate = PostCategory::where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(10);

        if ($status == 'trash') {
            $list_action=array(
                'active'=>'Khôi phục',
                'forceDelete'=>'Xóa vĩnh viễn'
            );

            $list_post_cate = PostCategory::onlyTrashed()->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(10);
        }

        $count=array(
            'active'=>PostCategory::count(),
            'trash'=>PostCategory::onlyTrashed()->count()
        );

        return view('admin.post_categories.index', compact('list_post_cate','count','list_action'));
    }

    function add()
    {
        return view('admin.post_categories.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:5|max:30|regex:/^([A-Za-zÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴáàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+){1,3}$/'
            ],
            [
                'name.regex' => 'Tên danh mục bài viết phải có định dạng chữ cái hoặc khoảng trắng',
                'max' => 'Tên danh mục bài viết có độ dài tối đa là :max ký tự',
                'min' => 'Tên danh mục bài viết có độ dài tối thiểu là :min ký tự'
            ]
        );

        PostCategory::create([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'user_id' => Auth::id()
        ]);
        return redirect(route('admin.post_category.index'))->with('success', 'Thêm danh mục bài viết thành công');
    }

    function delete(Request $request, $id)
    {
        $status=$request->input('status');
        if($status=='trash'){
            PostCategory::onlyTrashed()->find($id)->forceDelete();

            return redirect(route('admin.post_category.index',['status'=>'trash']))->with('success', 'Xóa vĩnh viễn danh mục bài viết thành công');
        }else{
            PostCategory::destroy($id);

            return redirect(route('admin.post_category.index'))->with('success', 'Xóa danh mục bài viết thành công');
        }
    }

    function action(Request $request){
        $list_post_cate_id=$request->input('list_post_cate_id');
        
        if($list_post_cate_id){
            $action=$request->input('action');

            if($action=='trash'){
                PostCategory::destroy($list_post_cate_id);

                return redirect(route('admin.post_category.index', ['status' => 'trash', 'page'=>1]))->with('success', 'Xóa danh mục bài viết thành công');
            }
            if($action=='active'){
                PostCategory::onlyTrashed()->whereIn('id',$list_post_cate_id)->restore();

                return redirect(route('admin.post_category.index', ['page'=>1]))->with('success', 'Khôi phục danh mục bài viết thành công');
            }
            if($action=='forceDelete'){
                PostCategory::onlyTrashed()->whereIn('id',$list_post_cate_id)->forceDelete();

                return redirect(route('admin.post_category.index', ['status' => 'trash', 'page'=>1]))->with('success', 'Xóa vĩnh viễn danh mục bài viết thành công');
            }
            return redirect(route('admin.post_category.index'))->with('error','Bạn chưa chọn hành động nào');
        }else{
            return redirect(route('admin.post_category.index'))->with('error', 'Bạn chưa chọn danh mục bài viết nào');
        }
    }

    function edit(Request $request,$id){
        $post_cate=PostCategory::withTrashed()->find($id);

        return view('admin.post_categories.edit',compact('post_cate'));
    }

    function update(Request $request,$id){
        $request->validate(
            [
                'name' => 'required|min:5|max:30|regex:/^([A-Za-zÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴáàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+){1,3}$/'
            ],
            [
                'name.regex' => 'Tên danh mục bài viết phải có định dạng chữ cái hoặc khoảng trắng',
                'max' => 'Tên danh mục bài viết có độ dài tối đa là :max ký tự',
                'min' => 'Tên danh mục bài viết có độ dài tối thiểu là :min ký tự'
            ]
        );

        PostCategory::withTrashed()->where('id',$id)->update([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name')),
            'description' => $request->input('description')
        ]);

        $status=$request->input('status');
        if($status=='trash'){
            return redirect(route('admin.post_category.index',['status'=>'trash']))->with('success', 'Cập nhật danh mục bài viết thành công');
        }else{
            return redirect(route('admin.post_category.index'))->with('success', 'Cập nhật danh mục bài viết thành công');
        }
    }
}
