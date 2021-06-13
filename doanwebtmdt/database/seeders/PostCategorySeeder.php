<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_categories')->insert([
            [
                'name'=>'Tin công nghệ',
                'code'=>Str::slug('Tin công nghệ'),
                'description'=>null,
                'user_id'=>3,
                'created_at'=>date('Y-m-d H:m:s',time())
            ],
            [
                'name'=>'Đánh giá sản phẩm',
                'code'=>Str::slug('Đánh giá sản phẩm'),
                'description'=>null,
                'user_id'=>3,
                'created_at'=>date('Y-m-d H:m:s',time())
            ]
        ]);
    }
}
