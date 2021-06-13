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
                'description'=>'Giảm giá khủng ngày 1.1',
                'start_day'=>'2021-1-1',
                'end_day'=>'2021-1-2',
                'percents'=>10
            ],
            [
                'name'=>'Sale 2.2',
                'description'=>'Giảm giá khủng ngày 2.2',
                'start_day'=>'2021-2-2',
                'end_day'=>'2021-2-3',
                'percents'=>10
            ],
            [
                'name'=>'Sale 3.3',
                'description'=>'Giảm giá khủng ngày 3.3',
                'start_day'=>'2021-3-3',
                'end_day'=>'2021-3-4',
                'percents'=>10
            ]
        ]);
    }
}
