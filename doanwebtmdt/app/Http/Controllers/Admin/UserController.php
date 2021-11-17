<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'user']);
            return $next($request);
        });
    }

    function index(Request $request)
    {
        //lấy trạng thái
        $status = $request->input('status');

        //khai báo danh sách action mđ (status=active)
        $list_action = array(
            'trash' => 'Vô hiệu hóa'
        );

        //lấy từ khóa tìm kiếm
        $key = $request->input('key', '');

        $list_user = User::where('fullname', 'like', "%$key%")->orderByDesc('id')->paginate(10);

        if ($status == 'trash') {
            $list_action = array(
                'active' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            );
            $list_user = User::onlyTrashed()->where('fullname', 'like', "%$key%")->orderByDesc('id')->paginate(10);
        }

        $countActive = User::count();
        $countTrash = User::onlyTrashed()->count();

        $count = array(
            'active' => $countActive,
            'trash' => $countTrash
        );

        return view('admin.users.index', compact('list_user', 'count', 'list_action'));
    }

    function detail($id){
        $user=User::withTrashed()->find($id);
        $action='detail';
        return view('admin.users.detail',compact('user','action'));
    }

    function delete(Request $request, $id)
    {
        if (Auth::id() != $id) {
            $status = $request->input('status');
            if ($status == 'trash') {
                User::onlyTrashed()->find($id)->forceDelete();

                return redirect(route('admin.user.index'))->with('success', 'Bạn đã xóa vĩnh viễn thành viên thành công');
            } else {
                User::destroy($id);

                $route_detail = route('admin.user.detail', $id);
                return redirect(route('admin.user.index'))->with('success', "Bạn đã xóa thành viên thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
            }
        }
    }

    function action(Request $request)
    {
        //lấy ds id của các user được chọn
        $list_user_id = $request->input('list_user_id');
        //dd($list_user_id);
        //kt ds user có dl hay k
        if ($list_user_id) {
            //loại id của user đang login trong ds nếu có
            foreach ($list_user_id as $k => $id) {
                if (Auth::id() == $id)
                    unset($list_user_id[$k]);
            }
            //kt lại ds user có dl hay k
            if (!empty($list_user_id)) {
                //xử lý
                $action = $request->input('action');
                if ($action == 'trash') {
                    User::destroy($list_user_id);

                    return redirect(route('admin.user.index', ['status' => 'trash', 'page'=>1]))->with('success', 'Vô hiệu hóa danh sách thành viên thành công');
                }
                if ($action == 'active') {
                    User::onlyTrashed()->whereIn('id', $list_user_id)->restore();

                    return redirect(route('admin.user.index', ['page'=>1]))->with('success', 'Khôi phục danh sách thành viên thành công');
                }
                if ($action == 'forceDelete') {
                    User::onlyTrashed()->whereIn('id', $list_user_id)->forceDelete();

                    return redirect(route('admin.user.index', ['status' => 'trash', 'page'=>1]))->with('success', 'Xóa vĩnh viễn danh sách thành viên thành công');
                }
                return redirect(route('admin.user.index'))->with('error', 'Bạn chưa chọn hành động nào');
            }
            return redirect(route('admin.user.index'))->with('error', 'Bạn không thể thao tác trên chính tài khoản của bạn');
        } else {
            return redirect(route('admin.user.index'))->with('error', 'Bạn chưa chọn thành viên nào');
        }
    }

    function edit($id)
    {
        $user = User::withTrashed()->find($id);
        $action = 'update';

        return view('admin.users.detail', compact('user','action'));
    }

    function update(Request $request, $id)
    {
        User::where('id', $id)->update(['permission' => $request->permission]);
        
        return redirect(route('admin.user.index'))->with('success', 'Cập nhật quyền tài khoản thành công');
    }
}
