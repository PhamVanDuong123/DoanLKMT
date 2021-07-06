<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('promotions')->insert([
            [
                'name'=>'Sale 1.1',
                'code'=>'sale-1-1',
                'thumb'=>'uploads/huynhhoanghung.jpg',
                'description'=>'Giảm giá khủng ngày 1.1',
                'start_day'=>'2021-1-1',
                'end_day'=>'2021-1-2',
                'number'=>5,
                'percents'=>10
            ],
            [
                'name'=>'Sale 2.2',
                'code'=>'sale-2-2',
                'thumb'=>'uploads/huynhhoanghung.jpg',
                'description'=>'Giảm giá khủng ngày 2.2',
                'start_day'=>'2021-2-2',
                'end_day'=>'2021-2-3',
                'number'=>15,
                'percents'=>10
            ],
            [
                'name'=>'Sale 3.3',
                'code'=>'sale-3-3',
                'thumb'=>'uploads/huynhhoanghung.jpg',
                'description'=>'Giảm giá khủng ngày 3.3',
                'start_day'=>'2021-3-3',
                'end_day'=>'2021-3-4',
                'number'=>10,
                'percents'=>10
            ]
        ]);
    }
}
