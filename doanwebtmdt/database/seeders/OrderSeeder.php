<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'code'=>'DH-01',
                'user_id'=>1,
                'name'=>'Huỳnh Hoàng Hưng',
                'phone'=>'0123456789',
                'address'=>'TPHCM',
                'note'=>'abc',
                'shipping_fee'=>20000,
                'payment'=>'cod',
                'promotion_code'=>'kmdb-01',
                'status'=>'received',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'code'=>'DH-02',
                'user_id'=>2,
                'name'=>'Phan Văn Dương',
                'phone'=>'0123456789',
                'address'=>'TPHCM',
                'note'=>'abc',
                'shipping_fee'=>20000,
                'payment'=>'cod',
                'promotion_code'=>'kmdb-02',
                'status'=>'processing',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'code'=>'DH-03',
                'user_id'=>3,
                'name'=>'Huỳnh Hoàng Hiếu',
                'phone'=>'0123456789',
                'address'=>'TPHCM',
                'note'=>'abc',
                'shipping_fee'=>20000,
                'payment'=>'cod',
                'promotion_code'=>'kmdb-01',
                'status'=>'being transported',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'code'=>'DH-04',
                'user_id'=>1,
                'name'=>'Huỳnh Hoàng Hưng',
                'phone'=>'0123456789',
                'address'=>'TPHCM',
                'note'=>'abc',
                'shipping_fee'=>20000,
                'payment'=>'cod',
                'promotion_code'=>'kmdb-01',
                'status'=>'delivered',
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'code'=>'DH-05',
                'user_id'=>2,
                'name'=>'Phan Văn Dương',
                'phone'=>'0123456789',
                'address'=>'TPHCM',
                'note'=>'abc',
                'shipping_fee'=>20000,
                'payment'=>'cod',
                'promotion_code'=>'kmdb-01',
                'status'=>'cancelled',
                'created_at'=>date('Y-m-d H:m:s',time())                
            ]
            ]);
    }
}
