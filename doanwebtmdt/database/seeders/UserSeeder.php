<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'fullname'=>'Huỳnh Hoàng Hưng',
            'username'=>'hunghuynh',
            'email'=>'hunghuynh813@gmail.com',
            'password'=>Hash::make('abc12345'),
            'phone'=>'0123456789',
            'gender'=>'male',
            'dob'=>'2000-10-31',
            'address'=>'TP.HCM',
            'avatar'=>'uploads\huynhhoanghung.jpg',
            'permission'=>1,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            'fullname'=>'Huỳnh Hoàng Hiếu',
            'username'=>'hieuhuynh',
            'email'=>'hieuhuynh@gmail.com',
            'password'=>Hash::make('abc12345'),
            'phone'=>'0123456788',
            'gender'=>'male',
            'dob'=>'2005-10-31',
            'address'=>'Bến Tre',
            'avatar'=>'uploads\huynhhoanghung.jpg',
            'permission'=>3,
            'created_at'=>date('Y-m-d H:m:s',time())
        ],
        [
            'fullname'=>'Phan Văn Dương',
            'username'=>'duongphan',
            'email'=>'duongphan@gmail.com',
            'password'=>Hash::make('abc12345'),
            'phone'=>'0123456787',
            'gender'=>'male',
            'dob'=>'2000-10-5',
            'address'=>'Long An',
            'avatar'=>'uploads\icecream_circle.png',
            'permission'=>2,
            'created_at'=>date('Y-m-d H:m:s',time())
        ]]);
    }
}
