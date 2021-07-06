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
        return view('admin.users.detail',compact('user'));
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

    function editAdmin(Request $request, $id)
    {
        $user = User::withTrashed()->find($id);

        return view('admin.users.editAdmin', compact('user'));
    }

    function updateAdmin(Request $request, $id)
    {
        $request->validate(
            [
                'fullname' => 'required|regex:/^([A-Za-zÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴáàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+){1,60}$/',
                'phone' => 'min:10|max:12|regex:/^[\d]{10,12}$/',
                'password' => !empty($request->input('password')) ? 'min:8|max:15|regex:/^([\w!@#$%^&*().\_]+){8,15}$/|confirmed' : '',
                'avatar' => 'image|max:20480', //size < 20Mb(20*1024Kb)
                'permission'=>'required'
            ],
            [
                'fullname.regex' => 'Họ tên phải có định dạng là chữ cái hoặc khoảng trắng',
                'phone.regex' => 'Số điện thoại phải thuộc các ký tự số',
                'password.regex' => 'Mật khẩu phải là ký tự hoa, ký tự thường, số, dấu chấm, gạch dưới, ký tự đặc biệt',
                'confirmed' => 'Xác nhận mật khẩu phải trùng khớp với mật khẩu',
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa là :max ký tự',
                'avatar.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
            ],
            [
                'fullname' => 'Họ tên',
                'password' => 'Mật khẩu',
                'avatar' => 'Ảnh đại diện',
                'permission'=>'Quyền'
            ]
        );

        $password=User::find($id)->password;
        
        $update = array(
            'fullname' => $request->input('fullname'),
            'password' => !empty($request->input('password')) ? Hash::make($request->input('password')) : $password,
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address'),
            'permission' => $request->input('permission'),
        );

        //upload ảnh lên server
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $avatar = 'uploads/' . $fileName;
            $update['avatar'] = $avatar;
        }

        User::where('id', $id)->update($update);

        $route_detail = route('admin.user.detail', $id);
        
        $status = $request->input('status');
        if ($status == 'trash') {
            return redirect(route('admin.user.index', ['status' => 'trash']))->with('success', "Cập nhật thông tin tài khoản thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
        } else {
            return redirect(route('admin.user.index'))->with('success', "Cập nhật thông tin tài khoản thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
        }
    }

    function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate(
            [
                'fullname' => 'required|regex:/^([A-Za-zÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴáàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+){1,60}$/',
                'phone' => 'min:10|max:12|regex:/^[\d]{10,12}$/',
                'password' => !empty($request->input('password')) ? 'min:8|max:15|regex:/^([\w!@#$%^&*().\_]+){8,15}$/|confirmed' : '',
                'avatar' => 'image|max:20480' //size < 20Mb(20*1024Kb)
            ],
            [
                'fullname.regex' => 'Họ tên phải có định dạng là chữ cái hoặc khoảng trắng',
                'phone.regex' => 'Số điện thoại phải thuộc các ký tự số',
                'password.regex' => 'Mật khẩu phải là ký tự hoa, ký tự thường, số, dấu chấm, gạch dưới, ký tự đặc biệt',
                'confirmed' => 'Xác nhận mật khẩu phải trùng khớp với mật khẩu',
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa là :max ký tự',
                'avatar.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
            ],
            [
                'fullname' => 'Họ tên',
                'password' => 'Mật khẩu',
                'avatar' => 'Ảnh đại diện'
            ]
        );

        $password=User::find($id)->password;

        $update = array(
            'fullname' => $request->input('fullname'),
            'password' => !empty($request->input('password')) ? Hash::make($request->input('password')) : $password,
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address')
        );

        //upload ảnh lên server
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $avatar = 'uploads/' . $fileName;
            $update['avatar'] = $avatar;
        }

        User::where('id', $id)->update($update);
        
        return redirect(route('admin.user.index'))->with('success', 'Cập nhật thông tin tài khoản thành công');
    }
}
