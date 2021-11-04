<?php

namespace Database\Seeders;

use App\Models\Statistical;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            ProductCategorytSeeder::class,
            BrandSeeder::class,
            PromotionSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            PageSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            StatisticalSeeder::class
        ]);
    }
}
