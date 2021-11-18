<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'name'=>'Giới thiệu',
                'code'=>Str::slug('Giới thiệu'),
                'content'=>'<p><strong>Giới thiệu</strong></p>
                <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p>
                <p>Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn</p>
                <p style="text-align: center;">
                    <img src="{{asset(\'public/images/img-detail.jpg\')}}" alt="">
                </p>
                <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời. Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn.</p>
                <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p>
                <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời. Phát biểu tại buổi ra mắt sản phẩm mái ngói năng lượng mặt trời và hệ thống pin dự trữ mới của Tesla và SolarCity vào thứ Sáu vừa rồi, Musk, người vừa là chủ tịch của cả hai công ty vừa là CEO của Tesla, nói về lý do tại sao tầm nhìn của ông ấy về điện năng lượng mặt trời tại Mỹ sâu xa hơn sẽ có nhiều việc cho các công lưới điện chứ không phải ít hơn.</p>
                <p>Một trong số đó là nhiều tiểu bang có luật “mua lại điện” đỏi hỏi các công ty lưới điện phải mua lại lượng điện dư thừa mà khách hàng tạo ra bởi năng lượng mặt trời. Cũng có những lo ngại rằng người ta có thể dùng ngói năng lượng mặt trời tự sản xuất điện năng lượng mặt trời độc lập với lưới – và như vậy sẽ giảm số người phụ thuộc vào lưới điện và chuyển các chi phí điện lưới đó cho những người không dùng điện năng lượng mặt trời.</p>',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'name'=>'Liên hệ',
                'code'=>Str::slug('Liên hệ'),
                'content'=>'<div class="contact-form-title"><em class="pvi-Contact_PhoneCall"></em>Tổng đài miễn phí</div>
                <p>Tư vấn mua hàng: <a href="tel:19001009">1900 1009</a></p>
                <p>Chăm sóc khách hàng: <a href="tel:19001009">1900 1009</a>&nbsp;/&nbsp;<a href="mailto:cskh@abc.vn">cskh@abc.vn</a></p>',
                'created_at'=>date('Y-m-d H:m:s',time())
            ]
        ]);
    }
}
