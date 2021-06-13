<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                //1
                'name' => 'Asus',
                'phone' => '0123456789',
                'email' => 'asus@gmail.com',
                'address' => 'Taiwan',
                'country' => 'Taiwan',
                'logo' => null,
                'website' => 'asus.com'
            ],
            [
                //2
                'name' => 'Intel',
                'phone' => '0123456788',
                'email' => 'intel@gmail.com',
                'address' => 'USA',
                'country' => 'USA',
                'logo' => null,
                'website' => 'intel.com'
            ],
            [
                //3
                'name' => 'ASRock',
                'phone' => '0123456787',
                'email' => 'asrock@gmail.com',
                'address' => 'USA',
                'country' => 'USA',
                'logo' => null,
                'website' => 'asrock.com'
            ],
            [
                //4
                'name' => 'Nvidia',
                'phone' => '0123456786',
                'email' => 'nvidia@gmail.com',
                'address' => 'USA',
                'country' => 'USA',
                'logo' => null,
                'website' => 'nvidia.com'
            ],
            [
                //5
                'name' => 'Acer',
                'phone' => '0123456785',
                'email' => 'acer@gmail.com',
                'address' => 'Taiwan',
                'country' => 'Taiwan',
                'logo' => null,
                'website' => 'acer.com'
            ],
            [
                //6
                'name' => 'Adata',
                'phone' => '0123456784',
                'email' => 'adata@gmail.com',
                'address' => 'China',
                'country' => 'China',
                'logo' => null,
                'website' => 'adata.com'
            ],
            [
                //7
                'name' => 'AOC',
                'phone' => '0123456783',
                'email' => 'aoc@gmail.com',
                'address' => 'China',
                'country' => 'China',
                'logo' => null,
                'website' => 'aoc.com'
            ],
            [
                //8
                'name' => 'Gigabyte',
                'phone' => '0123456782',
                'email' => 'gigabyte@gmail.com',
                'address' => 'USA',
                'country' => 'USA',
                'logo' => null,
                'website' => 'gigabyte.com'
            ],
            [
                //9
                'name' => 'Dell',
                'phone' => '0123456781',
                'email' => 'dell@gmail.com',
                'address' => 'USA',
                'country' => 'USA',
                'logo' => null,
                'website' => 'dell.com'
            ],
            [
                //10
                'name' => 'Cooler Master',
                'phone' => '0123456780',
                'email' => 'coolermaster@gmail.com',
                'address' => 'USA',
                'country' => 'USA',
                'logo' => null,
                'website' => 'coolermaster.com'
            ],
            [
                //11
                'name' => 'HP',
                'phone' => '0123456779',
                'email' => 'hp@gmail.com',
                'address' => 'USA',
                'country' => 'USA',
                'logo' => null,
                'website' => 'hp.com'
            ],
            [
                //12
                'name' => 'Logitech',
                'phone' => '0123456778',
                'email' => 'logitech@gmail.com',
                'address' => 'UK',
                'country' => 'UK',
                'logo' => null,
                'website' => 'logitech.com'
            ],
            [
                //13
                'name' => 'Corsair',
                'phone' => '0123456777',
                'email' => 'corsair@gmail.com',
                'address' => 'UK',
                'country' => 'UK',
                'logo' => null,
                'website' => 'corsair.com'
            ],
            [
                //14
                'name' => 'Colorfull',
                'phone' => '0123456776',
                'email' => 'colorfull@gmail.com',
                'address' => 'China',
                'country' => 'China',
                'logo' => null,
                'website' => 'colorfull.com'
            ],
            [
                //15
                'name' => 'Kingmax',
                'phone' => '0123456775',
                'email' => 'kingmax@gmail.com',
                'address' => 'China',
                'country' => 'China',
                'logo' => null,
                'website' => 'kingmax.com'
            ],
            [
                //16
                'name' => 'AMD',
                'phone' => '0123456774',
                'email' => 'amd@gmail.com',
                'address' => 'USA',
                'country' => 'USA',
                'logo' => null,
                'website' => 'amd.com'
            ],
            [
                //17
                'name' => 'MSI',
                'phone' => '0123456773',
                'email' => 'msi@gmail.com',
                'address' => 'Taiwan',
                'country' => 'Taiwan',
                'logo' => null,
                'website' => 'msi.com'
            ]
        ]);
    }
}
