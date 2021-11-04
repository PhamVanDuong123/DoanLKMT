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
                'price'=>990000,
                'price_cost'=>900000
            ],
            [
                'order_id'=>1,
                'product_id'=>3,
                'number'=>1,
                'price'=>5050000,
                'price_cost'=>5000000
            ],
            [
                'order_id'=>2,
                'product_id'=>2,
                'number'=>1,
                'price'=>3190000,
                'price_cost'=>3000000
            ],
            [
                'order_id'=>3,
                'product_id'=>5,
                'number'=>1,
                'price'=>2450000,
                'price_cost'=>2200000
            ],
            [
                'order_id'=>3,
                'product_id'=>3,
                'number'=>10,
                'price'=>5050000,
                'price_cost'=>5000000
            ],
            [
                'order_id'=>4,
                'product_id'=>3,
                'number'=>1,
                'price'=>5050000,
                'price_cost'=>5000000
            ],
            [
                'order_id'=>4,
                'product_id'=>6,
                'number'=>2,
                'price'=>4690000,
                'price_cost'=>4500000
            ],
            [
                'order_id'=>5,
                'product_id'=>3,
                'number'=>2,
                'price'=>5050000,
                'price_cost'=>5000000
            ]
        ]);
    }
}
