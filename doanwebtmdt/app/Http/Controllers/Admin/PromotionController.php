<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PromotionController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'promotion']);
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

        $list_promotion = Promotion::where('code', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);

        if ($status == 'trash') {
            $list_action = array(
                'active' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            );
            $list_promotion = Promotion::onlyTrashed()->where('code', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
        }

        if ($status == 'approved') {
            $list_promotion = Promotion::where('status', 'approved')->where('code', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
        }

        if ($status == 'not approved yet') {
            $list_action = array(
                'approved' => 'Duyệt',
                'trash' => 'Xóa tạm thời'
            );
            $list_promotion = Promotion::where('status', 'not approved yet')->where('code', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
        }

        $count = array(
            'all' => Promotion::count(),
            'approved' => Promotion::where('status', 'approved')->count(),
            'not approved yet' => Promotion::where('status', 'not approved yet')->count(),
            'trash' => Promotion::onlyTrashed()->count()
        );

        return view('admin.promotions.index', compact('list_promotion', 'count', 'list_action'));
    }

    function detail($id){
        $promotion=Promotion::withTrashed()->find($id);
        return view('admin.promotions.detail',compact('promotion'));
    }

    function add()
    {
        return view('admin.promotions.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:5|max:50',
                'code' => 'required|min:5|max:30',
                'start_day' => 'required|after:today',
                'end_day' => 'required|after_or_equal:start_day',
                'number' => 'required|min:1',
                'qty' => 'required|min:1',
                'condition' => 'required',
                'min_total_order'=>'gte:number'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa là :max ký tự',
                'unique' => 'Mã khuyến mãi đã được sử dụng',
                'end_day.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu',
                'min_total_order.gte'=>'Giá trị đơn hàng tối thiểu không được nhỏ hơn giá trị giảm'
            ],
            [
                'name' => 'Tên khuyến mãi',
                'code' => 'Mã khuyến mãi',
                'start_day' => 'Ngày bắt đầu',
                'end_day' => 'Ngày kết thúc',
                'qty' => 'Số lượng',
                'number' => 'Giá trị giảm',
                'condition' => 'Hình thức giảm',
                'min_total_order'=>'Giá trị đơn hàng tối thiểu'
            ]
        );

        $promotion = Promotion::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'condition' => $request->input('condition'),
            'start_day' => $request->input('start_day'),
            'end_day' => $request->input('end_day'),
            'qty' => $request->input('qty'),
            'number' => $request->input('number'),
            'min_total_order' => $request->input('min_total_order')
        ]);

        $route_detail = route('admin.promotion.detail', $promotion->id);
        return redirect(route('admin.promotion.index'))->with('success', "Thêm khuyến mãi thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
    }

    function delete(Request $request, $id)
    {
        $status = $request->input('status');
        //dd($status);
        if ($status == 'trash') {
            Promotion::onlyTrashed()->find($id)->forceDelete();

            return redirect(route('admin.promotion.index', ['status' => 'trash', 'page' => 1]))->with('success', 'Xóa vĩnh viễn khuyến mãi thành công');
        } else {
            Promotion::destroy($id);

            $route_detail = route('admin.promotion.detail', $id);
            return redirect(route('admin.promotion.index', ['status' => 'trash', 'page' => 1]))->with('success', "Xóa khuyến mãi thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
        }
    }

    function action(Request $request)
    {
        $list_promotion_id = $request->input('list_promotion_id');

        if (!empty($list_promotion_id)) {
            $action = $request->input('action');

            if ($action == 'trash') {
                Promotion::destroy($list_promotion_id);

                return redirect(route('admin.promotion.index', ['status' => 'trash', 'page' => 1]))->with('success', 'Xóa khuyến mãi thành công');
            }
            if ($action == 'approved') {
                Promotion::where('status', 'not approved yet')->whereIn('id', $list_promotion_id)->update(['status' => 'approved']);

                return redirect(route('admin.promotion.index', ['status' => 'approved', 'page' => 1]))->with('success', 'Duyệt khuyến mãi thành công');
            }
            if ($action == 'active') {
                Promotion::onlyTrashed()->whereIn('id', $list_promotion_id)->restore();

                return redirect(route('admin.promotion.index', ['status' => 'all', 'page' => 1]))->with('success', 'Khôi phục khuyến mãi thành công');
            }
            if ($action == 'forceDelete') {
                Promotion::onlyTrashed()->whereIn('id', $list_promotion_id)->forceDelete();

                return redirect(route('admin.promotion.index', ['status' => 'trash', 'page' => 1]))->with('success', 'Xóa vĩnh viễn khuyến mãi thành công');
            }

            return redirect(route('admin.promotion.index'))->with('error', 'Bạn chưa chọn hành động nào');
        } else {
            return redirect(route('admin.promotion.index'))->with('error', 'Bạn chưa chọn khuyến mãi nào');
        }
    }

    function edit(Request $request, $id)
    {
        $status = $request->input('status');
        if ($status == 'trash') {
            $promotion = Promotion::onlyTrashed()->find($id);
        } else {
            $promotion = Promotion::find($id);
        }

        return view('admin.promotions.edit', compact('promotion'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|min:5|max:50',
                'code' => 'required|min:5|max:30',
                'start_day' => 'required',
                'end_day' => 'required|after_or_equal:start_day',
                'number' => 'required|min:1',
                'qty' => 'required|min:1',
                'condition' => 'required',
                'min_total_order'=>'gte:number'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối đa là :max ký tự',
                'unique' => 'Mã khuyến mãi đã được sử dụng',
                'end_day.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu',                
                'min_total_order.gte'=>'Giá trị đơn hàng tối thiểu không được nhỏ hơn giá trị giảm'                
            ],
            [
                'name' => 'Tên khuyến mãi',
                'code' => 'Mã khuyến mãi',
                'start_day' => 'Ngày bắt đầu',
                'end_day' => 'Ngày kết thúc',
                'qty' => 'Số lượng',
                'number' => 'Giá trị giảm',
                'condition' => 'Hình thức giảm',
                'min_total_order'=>'Giá trị đơn hàng tối thiểu'
            ]
        );

        $t = Promotion::withTrashed()->where('code', $request->input('code'))->where('id', '!=', $id)->count();
        if ($t > 0) {
            return redirect(route('admin.promotion.index'))->with('error', 'Mã khuyến mãi đã tồn tại');
        }

        Promotion::withTrashed()->where('id', $id)->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'qty' => $request->input('qty'),
            'start_day' => $request->input('start_day'),
            'end_day' => $request->input('end_day'),
            'condition' => $request->input('condition'),
            'number' => $request->input('number'),
        ]);

        $status=$request->input('status');

        $route_detail = route('admin.promotion.detail', $id);
        return redirect(route('admin.promotion.index',['status'=>$status]))->with('success', "Cập nhật khuyến mãi thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
    }

    function approve(Request $request){
        $list_promo_not_approve=Promotion::where('status','not approved yet')->paginate(5);
        
        $key=$request->key;
        if(!empty($key)){
            $list_promo_not_approve=Promotion::where('status','not approved yet')->where('code','like',"%{$key}%")->paginate(5);
        }

        return view('admin.promotions.approve',compact('list_promo_not_approve'));
    }

    function approve_promo(Request $request,$id){
        $status = $request->status;
        if($status=='approved'){
            $promotion=Promotion::find($id);
            $promotion->status=$status;
            $promotion->save();

            return redirect(route('admin.promotion.approve'))->with('success','Xét duyệt khuyến mãi thành công');
        }else{
            return redirect()->back()->with('error','Bạn chưa thay đổi trạng thái xét duyệt');
        }        
    }
}
