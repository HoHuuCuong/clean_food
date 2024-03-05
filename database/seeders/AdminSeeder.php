<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{

    public function run()
    {
        DB::table('admins')->delete();

        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
                'email'             =>   'admin@master.com',
                'password'          =>    bcrypt(123123),
                'ho_va_ten'         =>   'ADMIN',
                'ngay_sinh'         =>   '2000-01-01',
                'so_dien_thoai'     =>   '1111111111',
            ]
        ]);
    }
}
