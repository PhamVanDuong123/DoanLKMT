<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            [
                'order_id'=>1,
                'product_id'=>1,
                'number'=>2,
                'price'=>150000
            ],
            [
                'order_id'=>1,
                'product_id'=>3,
                'number'=>1,
                'price'=>200000
            ],
            [
                'order_id'=>2,
                'product_id'=>2,
                'number'=>1,
                'price'=>200000
            ],
            [
                'order_id'=>3,
                'product_id'=>5,
                'number'=>1,
                'price'=>200000
            ],
            [
                'order_id'=>3,
                'product_id'=>3,
                'number'=>10,
                'price'=>200000
            ],
            [
                'order_id'=>4,
                'product_id'=>3,
                'number'=>1,
                'price'=>200000
            ],
            [
                'order_id'=>4,
                'product_id'=>3,
                'number'=>3,
                'price'=>200000
            ],
            [
                'order_id'=>5,
                'product_id'=>3,
                'number'=>2,
                'price'=>50000
            ]
        ]);
    }
}
