<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Feeship;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    function index()
    {
        $list_province = Province::orderBy('id', 'asc')->get();
        return view('admin.delivery.index')->with(compact('list_province'));
    }

    function load_district_ward(Request $request)
    {
        $data = $request->all();
        $select_val = $data['select_val'];
        $result = $data['result'];

        $html = '<option value="">-- Chọn --</option>';
        if ($result == 'district') {
            $list_district = District::where('province_id', $select_val)->get();
            foreach ($list_district as $item) {
                $html .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        } else if ($result == 'ward') {
            $list_ward = Ward::where('district_id', $select_val)->get();
            foreach ($list_ward as $item) {
                $html .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }

        echo $html;
    }

    function load_feeship()
    {
        $t = 0;
        $html = '<table class="table table-striped">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" name="checkall">
                </th>
                <th scope="col">STT</th>
                <th scope="col">Tỉnh/Thành phố</th>
                <th scope="col">Quận/Huyện</th>
                <th scope="col">Xã/Phường/Thị trấn</th>
                <th scope="col">Phí vận chuyển</th>
            </tr>
        </thead>
        <tbody>';

        $list_feeship = Feeship::orderByDesc('id')->get();

        foreach ($list_feeship as $item) {
            $t++;
            $html .= '<tr>
            <td>
                <input type="checkbox">
            </td>
            <td>' . $t . '</td>
            <td>' . $item->province->name . '</td>
            <td>' . $item->district->name . '</td>
            <td>' . $item->ward->name . '</td>
            <td class="edit_feeship" contenteditable data-id="' . $item->id . '">' . number_format($item->fee, 0, ',', '.') . 'đ</td>
        </tr>';
        }
        $html .= '
                </tbody>
            </table>';

        echo $html;
    }

    function add_feeship(Request $request)
    {
        $data = $request->all();
        $province_id = $data['province_id'];
        $district_id = $data['district_id'];
        $ward_id = $data['ward_id'];
        $fee = $data['fee'];

        $result = array();

        if(!$this->check_feeship_exist($province_id,$district_id,$ward_id)){
            $feeship = Feeship::create([
                'province_id' => $province_id,
                'district_id' => $district_id,
                'ward_id' => $ward_id,
                'fee' => filter_var($fee, FILTER_SANITIZE_NUMBER_INT),
            ]);
    
            $result['status']='success';
            $result['message']='Thêm phí vận chuyển thành công';
        }else{
            $result['status']='error';
            $result['message']='Phí vận chuyển của địa phương này đã tồn tại. Bạn có thể chỉnh sửa nó!';
        }       

        echo json_encode($result);
    }

    function check_feeship_exist($province_id,$district_id,$ward_id){
        $feeship=Feeship::where('province_id',$province_id)->where('district_id',$district_id)->where('ward_id',$ward_id)->first();
        if($feeship)
            return true;
        return false;
    }

    function edit_feeship(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $fee = $data['fee'];

        $feeship = Feeship::find($id);
        $feeship->fee = filter_var($fee,FILTER_SANITIZE_NUMBER_INT);
        $feeship->save();

        echo $feeship;
    }
}
