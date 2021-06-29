<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                //1
                'name'=>'Chuột gaming SteelSeries Rival 310',
                'code'=>Str::slug('Chuột gaming SteelSeries Rival 310'),
                'brand_id'=>13,
                'price'=>999000,
                'old_price'=>1389000,
                'thumb'=>'https://lh3.googleusercontent.com/R7ReWmjRPltJPq8ofoCc-vIHl9mfaRNksAZ8AGgL4s6jqB7AU11-LSC7qh1S0IqyG08MTma99AA78RkpYg=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Cảm biến True Move 3 được phát triển bởi Steelseries, tỉ lệ track 1:1 cho độ chính xác tuyệt đối.- Tuỳ chỉnh từ 100-12000 DPI (bước nhảy 100 DPI). Lưu và chỉnh nhanh được 2 mức DPI trên chuột.',
                'detail_desc'=>'<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir="ltr"><strong>Thiết kế và trải nghiệm</strong></h3><p dir="ltr">Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>',
                'warranty'=>24,
                'product_category_id'=>7,                
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //2
                'name'=>'Màn hình LCD ACER EK241Y',
                'code'=>Str::slug('Màn hình LCD ACER EK241Y'),
                'brand_id'=>5,
                'price'=>3190000,
                'old_price'=>3490000,
                'thumb'=>'https://lh3.googleusercontent.com/xGsY5yO53sWLLYGXLdEwn2A0Gsqi4ovNpNLj64rNHusbe2NkdJrTQ-orN5iGLR0jfSP79fwwdkoug8cgigLgGE0NcSZGT2dBBw=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Kích thước: 23.8" (1920 x 1080), Tỷ lệ 16:9, Góc nhìn: 178 (H) / 178 (V)
                - Tần số quét: 75Hz , Thời gian phản hồi 4 ms
                - HIển thị màu sắc: 16.7 triệu màu
                - Cổng hình ảnh: , 1 x HDMI, 1 x VGA/D-sub',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>11,
                'user_id'=>3,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //3
                'name'=>'Màn hình LCD GIGABYTE G24F-EK',
                'code'=>Str::slug('Màn hình LCD GIGABYTE G24F-EK'),
                'brand_id'=>8,
                'price'=>5050000,
                'old_price'=>5550000,
                'thumb'=>'https://lh3.googleusercontent.com/R1U0dAMRdCEYUNzTS3xXpDlz2eJlRSiuqtrHmMboDQAZokUKrIGnDFHGmmoN-uQHDf-7tE_3OZuqcjLCUZwNLDKSBS2hxa8W=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>"- Kích thước: 24inch (1920 x 1080), Tỷ lệ 16:9
                - Tấm nền IPS, Góc nhìn: 178 (H) / 178 (V)
                - Tần số quét: 165Hz , Thời gian phản hồi 1 ms
                - Công nghệ đồng bộ: FreeSync",
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>11,
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //4
                'name'=>'Bàn phím cơ GIGABYTE AORUS K9',
                'code'=>Str::slug('Bàn phím cơ GIGABYTE AORUS K9'),
                'brand_id'=>8,
                'price'=>2290000,
                'old_price'=>3450000,
                'thumb'=>'https://lh3.googleusercontent.com/EGI1Uvdmw0PR04pCiwzZqek98ZwfvAltKJfNLbbQk-x9JQHlEstI-6fEwHFVCD38H04gtb07t8Tcm5gmqkqM=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Bàn phím cơ
                - Kết nối USB 2.0
                - Kiểu switch Flaretech switches',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>8,                
                'user_id'=>3,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //5
                'name'=>'RAM desktop KINGMAX Zeus Dragon RGB (1x16GB)',
                'code'=>Str::slug('RAM desktop KINGMAX Zeus Dragon RGB (1x16GB)'),
                'brand_id'=>15,
                'price'=>2450000,
                'old_price'=>2650000,
                'thumb'=>'https://lh3.googleusercontent.com/JCJzwKOMUKbkocUJwhcEqIaplaqnQ9n1jYcDEzMGcMQik6Jvh9CCLwDBIy1OzlgIQJSEhkitOI2W1ZqW8dw=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Dung lượng: 1 x 16GB
                - Thế hệ: DDR4
                - Bus: 3000MHz
                - Cas: 16',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>3,                
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //6
                'name'=>'RAM laptop KINGMAX Kingmax 32GB (3200) (1 x 32GB)',
                'code'=>Str::slug('RAM laptop KINGMAX Kingmax 32GB (3200) (1 x 32GB)'),
                'brand_id'=>15,
                'price'=>4690000,
                'old_price'=>4770000,
                'thumb'=>'https://lh3.googleusercontent.com/zBtRdsoxP9zSiDyMPPhEAfrZ0EiWa5qwQN-pxv-qgDzDvozqqZ7ImMFambvwubH4-Rm4Ml42pKhzk_bDmphw=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Dung lượng: 1 x 32GB
                - Thế hệ: DDR4
                - Bus: 3200MHz
                - Cas: 16',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>3,
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //7
                'name'=>'Ổ cứng SSD Kingmax PX4480 500GB',
                'code'=>Str::slug('Ổ cứng SSD Kingmax PX4480 500GB'),
                'brand_id'=>13,
                'price'=>3190000,
                'old_price'=>3390000,
                'thumb'=>'https://lh3.googleusercontent.com/2sgZqwtyNDHC2fo1Obyxgyft_8a0Ym_O-LWu2JOxquNAPcmpPU_xkeSrzylLJtM4rfkdZpWk2k2uliehuNNYF5ofqb2rhuU=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'-Dung lượng: 500GB
                - Kích thước: M.2
                - Kết nối: M.2 NVMe
                - NAND: 3D-NAND
                - Tốc độ đọc/ghi (tối đa): 5000MB/s | 2500MB/s',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>6,                
                'user_id'=>3,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //8
                'name'=>'CPU AMD Ryzen Threadripper 1920X',
                'code'=>Str::slug('CPU AMD Ryzen Threadripper 1920X'),
                'brand_id'=>16,
                'price'=>22200000,
                'old_price'=>24000000,
                'thumb'=>'https://lh3.googleusercontent.com/Hv_QSEPcYcFkF414c6IM3nkJ1kq-ft-zf8Hky4VCB4bV2vgROSKUdBTRholISnFWdeAZCaxn9rqpS9S-ig=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Tốc độ xử lý: 3.5 GHz - 4.0 GHz ( 12 nhân, 24 luồng)
                - Bộ nhớ đệm: 39MB',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>1,                
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //9
                'name'=>'CPU Intel Core i3-8350K',
                'code'=>Str::slug('CPU Intel Core i3-8350K'),
                'brand_id'=>2,
                'price'=>4550000,
                'old_price'=>4990000,
                'thumb'=>'https://lh3.googleusercontent.com/eCjhTTh0FLWYQMEPjCKsm5EEp_H5tY4997yC1ofu1DDZlAJxzz5oA3uKIaldcMvujMkzA8siabmL7pCRxG9M=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Tốc độ xử lý: 4.0 GHz ( 4 nhân, 4 luồng)
                - Bộ nhớ đệm: 8MB
                - Đồ họa tích hợp: Intel UHD Graphics 630',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>1,                
                'user_id'=>3,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //10
                'name'=>'CPU Intel Core I5-8600K',
                'code'=>Str::slug('CPU Intel Core I5-8600K'),
                'brand_id'=>2,
                'price'=>7300000,
                'old_price'=>7600000,
                'thumb'=>'https://lh3.googleusercontent.com/GspstRuVBedfNQs0hvvJISOYxrQ84HVwbJuvJBSxZNAvACh9oW8P7ndsWlabH0C-UsK7jsYMwA1lrekR5U0r=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Tốc độ xử lý: 3.6 GHz ( 6 nhân, 6 luồng)
                - Bộ nhớ đệm: 9MB
                - Đồ họa tích hợp: Intel UHD Graphics 630',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>1,                
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //11
                'name'=>'CPU INTEL Core i9-11900',
                'code'=>Str::slug('CPU INTEL Core i9-11900'),
                'brand_id'=>2,
                'price'=>13390000,
                'old_price'=>13990000,
                'thumb'=>'https://lh3.googleusercontent.com/UMa36MlAeb8jh1vS9TVsQ44s783vPG6YH62RPvbO7pORZm5CnEaiCqsHunfLX4aaXpIoSj8yc2DBUthAFM82y2G-MfW-fY_e=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'Tốc độ: 2.50 GHz - 5.20 GHz (8nhân, 16 luồng)
                Bộ nhớ đệm: 16MB
                Chip đồ họa tích hợp: Intel UHD Graphics 750',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>1,                
                'user_id'=>3,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //12
                'name'=>'Card màn hình ASUS Dual GeForce RTX 2060',
                'code'=>Str::slug('Card màn hình ASUS Dual GeForce RTX 2060'),
                'brand_id'=>1,
                'price'=>14990000,
                'old_price'=>15200000,
                'thumb'=>'https://lh3.googleusercontent.com/K4qOOVyQW0H36BXAGXYQe4Mm-cfnCCh_ZFRbedx9wINErgQfwOFLUhdGy7km-Ijw4LYtzqcgU5eFPO_6lp0BqBwIgemIJDA=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'Base Clock: 1395 MHz
                Gaming Mode (Default) - GPU Boost Clock: 1755 MHz, GPU Base Clock: 1365 MHz
                - Nguồn phụ: 1 x 8-pin',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>2,                
                'user_id'=>3,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //13
                'name'=>'Card màn hình ASUS GeForce GTX 1050Ti 4GB',
                'code'=>Str::slug('Card màn hình ASUS GeForce GTX 1050Ti 4GB'),
                'brand_id'=>1,
                'price'=>4650000,
                'old_price'=>4990000,
                'thumb'=>'https://lh3.googleusercontent.com/yPLY4fD-O5PkVQc25Ld9WnXjQVqjWCuZjHqwO2BgaZq-mQGIWViIMTuqdbNQVGohx-GSX_lqJ_om14P3KLfE4YlAKBuWnCs=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Chip đồ họa: GeForce GTX 1050Ti
                - Bộ nhớ: 4GB GDDR5 (128-bit)
                - OC Mode - GPU Boost Clock : 1442 MHz , GPU Base Clock : 1328 MHz Gaming Mode (Default) - GPU Boost Clock : 1417 MHz , GPU Base Clock : 1303 MHz
                - Nguồn phụ: Không nguồn phụ',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>2,                
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //14
                'name'=>'Card màn hình ASUS NVIDIA GeForce GT 710',
                'code'=>Str::slug('Card màn hình ASUS NVIDIA GeForce GT 710'),
                'brand_id'=>1,
                'price'=>1590000,
                'old_price'=>1790000,
                'thumb'=>'https://lh3.googleusercontent.com/NvzEAXh8R6JdybqDj4djxJN817nAGaLNYnACFfylsTERKwoOs7F6ONWxUrjtM8YVcai_UX9CkDVIr0i9W4F_QHQJ_c-n9cxP=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'-Chip đồ họa: GeForce GT 710
                - Bộ nhớ: 2GB GDDR5 (32-bit)',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>2,                
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //15
                'name'=>'Card màn hình MSI GeForce RTX 3060',
                'code'=>Str::slug('Card màn hình MSI GeForce RTX 3060'),
                'brand_id'=>17,
                'price'=>26490000,
                'old_price'=>28000000,
                'thumb'=>'https://lh3.googleusercontent.com/gNwtq_YrR9cimqW1nVW7LBYeRbASj2T81D0S3z9cn_-IMVt7NL1dQJr3gtfLaAze7NC7klFwhNpc0-zrAqNWa9qPXfX1_wXOtw=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Chip đồ họa: GeForce RTX 3060
                - Bộ nhớ: 12GB GDDR6 (192-bit)
                - Boost: 1837 MHz
                - Nguồn phụ: 1 x 6-pin + 1 x 8-pin',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>2,                
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //16
                'name'=>'CPU AMD Ryzen R3 1200',
                'code'=>Str::slug('CPU AMD Ryzen R3 1200'),
                'brand_id'=>16,
                'price'=>2710000,
                'old_price'=>2990000,
                'thumb'=>'https://lh3.googleusercontent.com/PvmAZg9Vhnqly3tXQaFrSu9x_EUGgNcNv3L_Jr48IAb0Zf4vTJlCecqkUQ5GaSRdqggEC_Dp_jcwI2hfumY=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Socket: AM4 , AMD Ryzen thế hệ thứ 1
                - Tốc độ xử lý: 3.1 GHz - 3.4 GHz ( 4 nhân, 4 luồng)
                - Bộ nhớ đệm: 8MB',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>1,                
                'user_id'=>1,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                //17
                'name'=>'CPU AMD A8-7600',
                'code'=>Str::slug('CPU AMD A8-7600'),
                'brand_id'=>16,
                'price'=>2030000,
                'old_price'=>2200000,
                'thumb'=>'https://lh3.googleusercontent.com/WjBuM5p1ql_uyLzzbT4f3wW81Oq4mEKQeBNWi7SH5Ba9ib_Kz6wXTram2K7iV8JYCsO_zJxh99JARYW76gI=w500-rw',
                'inventory_num'=>100,
                'short_desc'=>'- Socket: FM2+ , AMD A-Series
                - Tốc độ xử lý: 3.1 GHz - 3.8 GHz ( 4 nhân
                - Bộ nhớ đệm: 4MB
                - Đồ họa tích hợp: AMD Radeon R7',
                'detail_desc'=>"<h3><strong>Sơ lược</strong></h3><p>Cùng ra mắt với người anh em sinh đôi của mình Sensei 310 hồi giữa năm 2017, Rival 310 được công ty sản xuất gaming gear đến từ Đan Mạch mong muốn sẽ là sản phẩm thống trị phân khúc chuột chơi game tầm trung. Thiết kế cơ bản lại cái đẹp bắt nguồn từ chính nét cơ bản đo, cùng với phần phối với giá thành hợp lý - $60, Steelseries Rival 310 được tin rằng sẽ cạnh tranh song phẳng với những Razer DeathAdder, Logitech G403 hay Zowie FK1.</p><h3 dir='ltr'><strong>Thiết kế và trải nghiệm</strong></h3><p dir='ltr'>Steelseries là một trong những tập đoàn sản xuất thiết bị ngoại vi nổi tiếng nhất trong giới E-sports và hầu như tất cả những sản phẩm của họ được thiết kế để phục vụ cho thi đấu chuyên nghiệp đỉnh cao. Tiền nhiệm của Rival 310 và Sensei 310 – Steelseries Rival 300 đã đứng trên đỉnh cao là một trong những con chuột toàn diện nhất, không chỉ đặc biệt dành cho game thủ, mà còn phù hợp cho người dùng phổ thông. Tuy nhiên, Rival 300 không phải không có những điểm yếu mà Steelseries đã ngay lập tức tiếp nhận ý kiến từ người dùng và ra mắt phiên bản hoàn hảo hơn: Rival 310.</p>",
                'warranty'=>24,
                'product_category_id'=>1,
                
                'user_id'=>3,
                'status'=>'approved',
                'created_at'=>date('Y-m-d H:m:s',time())
            ]
        ]);
    }
}
