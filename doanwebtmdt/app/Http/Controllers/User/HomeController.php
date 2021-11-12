<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCategory;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Crypt;
use Illuminate\Database\Eloquent\Collection;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $url_canonical = \URL::current();
        $list_cate = ProductCategory::all();
        foreach ($list_cate as &$cate) {
            $cate['url_list_pro_by_cate'] = route('product.showByCate', $cate->id);
        }

        $list_pro_selling = Product::where('status', 'approved')->select('*')->limit(4)->get();
        foreach ($list_pro_selling as &$product) {
            $product['url'] = route('product.detail', $product->id);
            $product['url_checkout'] = route('cart.checkout');
        }

        $list_highlight_pro = Product::where('status', 'approved')->select('*')->limit(6)->get();
        foreach ($list_highlight_pro as &$product) {
            $product['url'] = route('product.detail', $product->id);
            $product['url_add_cart'] = route('cart.add', $product->id);
            $product['url_checkout'] = route('cart.checkout');
        }

        $list_pro_in_cate = array();
        //lấy ds sp của 2 loại sp đầu tiên
        for ($i = 0; $i < 2; $i++) {
            $list_pro_in_cate[] = Product::where('status','approved')->where('product_category_id',$list_cate[$i]['id'])->get();
            foreach ($list_pro_in_cate[$i] as &$product) {
                //dd($list_pro_in_cate);
                $product['url'] = route('product.detail', $product['id']);
                $product['url_add_cart'] = route('cart.add', $product['id']);
                $product['url_checkout'] = route('cart.checkout');
            }
        }

        return view('user.index', compact('list_cate', 'list_pro_selling', 'list_highlight_pro', 'list_pro_in_cate', 'url_canonical'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword_submit;
        $search_product = Product::where('status','approved')->where('name', 'like', "%{$keyword}%")->get();
        $list_cate = ProductCategory::all();
        foreach ($list_cate as &$catetegory) {
            $catetegory['url_list_pro_by_cate'] = route('product.showByCate', $catetegory->id);
        }

        return view('user.product.search')->with('search_product', $search_product)->with('keyword', $keyword)->with('list_cate', $list_cate);
    }
    // search with auto complete

    function get_Login()
    {
        return view('user.account.login');
    }
    public function post_Login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required|min:5|max:32'

            ],
            [
                'email.required' => 'Bạn chưa nhập Email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email Email',
                'password.required' => 'Bạn chưa nhập Password',
                'password.min' => 'Password không được nhỏ hơn 5 ký tự',
                'password.max' => 'Password không được lớn hơn 32 ký tự'
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //lấy tt sp đã đặt của tk trong cookie đưa vào giỏ hàng
            // dd(Cookie::get(Auth::id()));
            // Cookie::forget(Auth::id());
            //Cookie::forget('1');

            //dd(Cookie::get());

            // if (null!==Cookie::get(Auth::id())) {
            //     dd(Cookie::get(Auth::id()));
            //     foreach (Cookie::get(Auth::id()) as $item) {
            //         Cart::add(['id' => $item->id, 'name' => $item->name, 'qty' => $item->qty, 'price' => $item->price, 'options' => ['thumb' => $item->options->thumb]]);
            //     }
            //     dd(Cart::Content());
            // }
            return redirect('/');
        } else {
            return redirect('user/account/login')->with('error', 'Đăng nhập không thành công');
        }
    }
    function logout()
    {
        //đẩy tt giỏ hàng vào cookie
        //dd(Cart::content());
        // $cart = array();
        // foreach (Cart::content() as $key => $value) {
        //     $cart[]=$value;
        // }
        // dd($cart);

        //Cookie::queue(Auth::id(), $cart,10);
        // $response = new Response('hello');
        // $response->withCookie(cookie(Auth::id(),$cart,3600));


        Auth::logout();

        //clear giỏ hàng khi đăng xuất        
        Cart::destroy();

        return redirect('/');
    }
    function get_signup()
    {
        return view('user.account.signup');
    }

    function post_signup(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email|unique:users',
                'fullname' => 'required|regex:/^([A-Za-zÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴáàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+){1,60}$/',
                'phone' => 'min:10|max:12|regex:/^[\d]{10,12}$/|unique:users',

                'password' => 'min:8|max:15|regex:/^([\w!@#$%^&*().\_]+){8,15}$/',
                'passwordAgain' => "required|same:password"
            ],
            [
                'email.required' => 'Bạn chưa nhập Email',
                'fullname.required' => 'Bạn chưa nhập tên người đăng ký',
                'email.email' => 'Bạn chưa nhập đúng định dạng Email',
                'email.unique' => 'Email đã tồn tại',
                'phone.unique' => "Số điện thoại đã được đăng ký",
                'confirmed' => 'Xác nhận mật khẩu phải trùng khớp với mật khẩu',
                'password.required' => 'Bạn chưa nhập Password',
                'password.min' => 'Password không được nhỏ hơn 8 ký tự',
                'password.max' => 'Password không được lớn hơn 32 ký tự',
                'passwordAgain.required' => "Bạn chưa nhập lại mật khẩu",
                'passwordAgain.same' => "Mật khẩu bạn nhập lại chưa đúng"

            ]
        );
        //dd($request->all());  
        $user = new User;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect('user/account/signup')->with('success', 'Chúc mừng bạn đã đăng ký tài khoản thành công');
    }
    function detail()
    {
        $user = Auth::user();
        //dd($user);
        return view('user.account.detail', ['user' => $user]);
    }
    function account_detail(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|regex:/^([A-Za-zÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰYÝỲỶỸỴáàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\s]+){1,60}$/',
                'phone' => 'min:10|max:12|regex:/^[\d]{10,12}$/',
                'avatar' => 'image|max:20480',
                'password' => 'min:8|max:15|regex:/^([\w!@#$%^&*().\_]+){8,15}$/',
                'passwordAgain' => 'required|same:password'

            ],
            [
                'fullname.regex' => 'Họ tên phải có định dạng là chữ cái hoặc khoảng trắng',
                'phone.regex' => 'Số điện thoại phải thuộc các ký tự số',
                'password.regex' => 'Mật khẩu phải là ký tự hoa, ký tự thường, số, dấu chấm, gạch dưới, ký tự đặc biệt',
                'confirmed' => 'Xác nhận mật khẩu phải trùng khớp với mật khẩu',
                'required' => ':attribute không được để trống',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu bạn nhập lại chưa khớp',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa là :max ký tự',
                'avatar.max' => 'Ảnh đại diện có độ dài tối đa là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',

            ],
            [
                'fullname' => 'Họ tên',
                'password' => 'Mật khẩu',
                'avatar' => 'Ảnh đại diện'
            ]
        );

        $avatar = Auth::user()->avatar;
        //dd($avatar);
        $this->upload_image($request, 'avatar', $avatar);

        $user = Auth::User();
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->avatar = $avatar;
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect(route('account.detail'))->with('success', 'Cập nhật thông tin tài khoản thành công');
    }
    function upload_image($request, $image, &$thumb)
    {
        //kt file có tt
        if ($request->hasFile($image)) {
            //lấy file
            $file = $request->$image;

            //lấy tên file
            $fileName = $file->getClientOriginalName();

            //đưa file lên server
            $file->move('public\uploads', $fileName);

            $thumb = 'http://localhost:8080/DoanLKMT/doanwebtmdt/public/uploads/' . $fileName;
        }
    }
    public function autocomplete_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['query']) {

            $product = Product::where('name', 'LIKE', '%' . $data['query'] . '%')->get();

            $output = '
            <ul class="dropdown-menu" style="display:block; position:relative">';

            foreach ($product as $key => $val) {
                $output .= '
               <li class="li_search_ajax"><a href="#">' . $val->name . '</a></li>
               ';
            }

            $output .= '</ul>';
            echo $output;
        }
    }
}
