<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class BrandController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'brand']);
            return $next($request);
        });
    }

    function index(Request $request)
    {
        $key = $request->input('key');

        $status = $request->input('status');

        $list_action = array(
            'trash' => 'Xóa tạm thời'
        );

        if ($status == 'trash') {
            $list_action = array(
                'active' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            );
            $list_Brand = Brand::onlyTrashed()->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
        }else{
            $list_Brand = Brand::where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
        }

        $count = array(
            'trash' => Brand::onlyTrashed()->count(),
            'active' => Brand::count()
        );

        return view('admin.brand.index', compact('list_Brand', 'count', 'list_action'));
    }

    function detail($id)
    {
        $Brand = Brand::find($id);

        return view('admin.brand.detail', compact('brand'));
    }

    function add()
    {
      
        return view('admin.brand.add');
    }

    function store(Request $request)
    {
        //dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:4|max:200|unique:brands',
                'phone' => 'required||unique:brands|min:10|max:12|regex:/^[\d]{10,12}$/',
                'email' => 'bail|required|email|unique:brands',
                'address' => 'required|min:10|max:200',
                'country' => 'required|min:5|max:200',
                'logo'=>'required|image|max:20480',
                'website'  => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'unique'=>' :attribute không được trùng',
                'phone.regex' => 'Số điện thoại phải thuộc các ký tự số',
                'email'=>'Vui lòng nhập email đúng định dạng',
                'url'=>'Vui lòng nhập đúng định dạng website',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa là :max ký tự',
                'logo.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
            ],
            [
                'name' => 'Tên thương hiệu',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'address' => 'Địa chỉ',
                'country' => 'Quốc gia'
            ]
        );

        if ($request->hasFile('logo')) {
            $file = $request->logo;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $logo = asset('uploads/' . $fileName);
        }

        Brand::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'website' => $request->input('website'),
            'logo'=>$logo
          
          
          
           
          //  'thumb' => $thumb
        ]);

        return redirect(route('admin.brand.index'))->with('success', 'Thêm bài viết thành công');
    }

    function delete(Request $request, $id)
    {
        $status = $request->input('status');
        if ($status == 'trash') {
            Brand::onlyTrashed()->find($id)->forceDelete();
            return redirect(route('admin.brand.index', ['status' => 'trash']))->with('success', 'Xóa vĩnh viễn bài viết thành công');
        } else {
            Brand::destroy($id);
            return redirect(route('admin.brand.index'))->with('success', 'Xóa bài viết thành công');
        }
    }

    function action(Request $request)
    {
        $list_Brand_id = $request->input('list_brand_id');
        if ($list_Brand_id) {
            $action = $request->input('action');

            if ($action == 'trash') {
                Brand::destroy($list_Brand_id);

                return redirect(route('admin.brand.index', ['status' => 'trash', 'page' => 1]))->with('success', 'Xóa bài viết thành công');
            }

            if ($action == 'active') {
                Brand::onlyTrashed()->whereIn('id', $list_Brand_id)->restore();

                return redirect(route('admin.brand.index', ['status' => 'all', 'page' => 1]))->with('success', 'Khôi phục bài viết thành công');
            }
            if ($action == 'forceDelete') {
                Brand::onlyTrashed()->whereIn('id', $list_Brand_id)->forceDelete();

                return redirect(route('admin.brand.index', ['status' => 'trash', 'page' => 1]))->with('success', 'Xóa vĩnh viễn bài viết thành công');
            }

            return redirect(route('admin.brand.index'))->with('error', 'Bạn chưa chọn hành động nào');
        } else {
            return redirect(route('admin.brand.index'))->with('error', 'Bạn chưa chọn bài viết nào');
        }
    }

    function edit(Request $request, $id)
    {
     
        $brand = Brand::withTrashed()->find($id);

        return view('admin.brand.edit', compact('brand'));
    }

    function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:4|max:200',
                'phone' => 'required|min:10|max:12|regex:/^[\d]{10,12}$/',
                'email' => 'bail|required|email',
                'address' => 'required|min:10|max:200',
                'country' => 'required|min:5|max:200',
                'logo'=>'image|max:20480',
                'website'  => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'unique'=>' :attribute không được trùng',
                'phone.regex' => 'Số điện thoại phải thuộc các ký tự số',
                'email'=>'Vui lòng nhập email đúng định dạng',
                'url'=>'Vui lòng nhập đúng định dạng website',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa là :max ký tự',
                'logo.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
            ],
            [
                'name' => 'Tên thương hiệu',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'address' => 'Địa chỉ',
                'country' => 'Quốc gia'

            ]
        );

        //$thumb = Brand::withTrashed()->find($id)->thumb;

        $this->upload_image($request, 'logo', $logo);

        Brand::withTrashed()->where('id', $id)->update([
          
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'website' => $request->input('website'),
            'logo'=>$logo
          
        ]);

        $status = $request->input('status');
        if ($status == 'trash') {
            return redirect(route('admin.brand.index', ['status' => 'trash']))->with('success', 'Cập nhật thương hiệu thành công');
        } else {
            return redirect(route('admin.brand.index'))->with('success', 'Cập nhật thương hiệu thành công');
        }
    }

    function upload_image($request, $image, &$logo)
    {
        if ($request->hasFile($image)) {
            $file = $request->$image;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $logo = 'http://localhost:8081/DoanLKMT/doanwebtmdt/public/uploads/' . $fileName;
        }
    }
}
