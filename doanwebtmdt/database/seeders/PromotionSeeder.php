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
                'name'=>'Giảm giá sau dịch',
                'code'=>'giamgiasaudich',
                'condition'=>1,
                'number'=>10,
                'qty'=>5,
                'start_day'=>'2021-11-1',
                'end_day'=>'2021-12-1'                
            ],
            [
                'name'=>'COVID-19',
                'code'=>'covid-19',
                'condition'=>2,
                'number'=>20000,
                'qty'=>5,
                'start_day'=>'2021-11-1',
                'end_day'=>'2021-12-1'                
            ],
            [
                'name'=>'Giảm giá cuối năm',
                'code'=>'giamgiacuoinam',
                'condition'=>1,
                'number'=>20,
                'qty'=>5,
                'start_day'=>'2021-11-1',
                'end_day'=>'2021-12-1'                
            ],
            [
                'name'=>'Giảm giá 11/11',
                'code'=>'giamgia11_11',
                'condition'=>1,
                'number'=>11,
                'qty'=>5,
                'start_day'=>'2021-11-1',
                'end_day'=>'2021-12-1'                
            ],
            [
                'name'=>'Giảm giá 200k',
                'code'=>'giamgia200k',
                'condition'=>2,
                'number'=>200000,
                'qty'=>5,
                'start_day'=>'2021-11-1',
                'end_day'=>'2021-12-1'                
            ]
        ]);
    }
}
