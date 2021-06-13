<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductCategorytSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([[
            //1
            'name'=>'CPU',
            'code'=>Str::slug('CPU'),
            'description'=>null,
            'user_id'=>1,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //2
            'name'=>'GPU',
            'code'=>Str::slug('GPU'),
            'description'=>null,
            'user_id'=>3,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //3
            'name'=>'Ram',
            'code'=>Str::slug('Ram'),
            'description'=>null,
            'user_id'=>1,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //4
            'name'=>'Mainboard',
            'code'=>Str::slug('Mainboard'),
            'description'=>null,
            'user_id'=>1,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //5
            'name'=>'Nguồn',
            'code'=>Str::slug('Nguồn'),
            'description'=>null,
            'user_id'=>3,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //6
            'name'=>'Ổ Cứng',
            'code'=>Str::slug('Ổ Cứng'),
            'description'=>null,
            'user_id'=>3,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //7
            'name'=>'Chuột',
            'code'=>Str::slug('Chuột'),
            'description'=>null,
            'user_id'=>1,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //8
            'name'=>'Bàn Phím',
            'code'=>Str::slug('Bàn Phím'),
            'description'=>null,
            'user_id'=>1,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //8
            'name'=>'Loa',
            'code'=>Str::slug('Loa'),
            'description'=>null,
            'user_id'=>3,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //9
            'name'=>'Tai nghe',
            'code'=>Str::slug('Tai nghe'),
            'description'=>null,
            'user_id'=>3,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //10
            'name'=>'Màn hình',
            'code'=>Str::slug('Màn hình'),
            'description'=>null,
            'user_id'=>1,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //11
            'name'=>'Quạt tản nhiệt',
            'code'=>Str::slug('Quạt tản nhiệt'),
            'description'=>null,
            'user_id'=>1,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            //12
            'name'=>'Vỏ Case',
            'code'=>Str::slug('Vỏ Case'),
            'description'=>null,
            'user_id'=>3,
            'created_at'=>date('Y-m-d H:m:s',time())
        ]]);
    }
}
