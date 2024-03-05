<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(DanhMucSeeder::class);
        $this->call(SanPhamSeeder::class);
        $this->call(CauHinhSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
