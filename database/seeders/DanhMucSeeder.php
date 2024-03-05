<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DanhMucSeeder extends Seeder
{
    public function run()
    {
        DB::table('danh_mucs')->delete();

        DB::table('danh_mucs')->truncate();

        DB::table('danh_mucs')->insert([
            [
                'ten_danh_muc'            => 'Sản Phẩm Sạch Anpaso',
                'slug_danh_muc'           => Str::slug('Sản Phẩm Sạch Anpaso'),
                'is_open'                => '1',
                'id_danh_muc_cha'         => 0,
            ],
            [
                'ten_danh_muc'            => 'Bếp Nhà An',
                'slug_danh_muc'           => Str::slug('Bếp Nhà An'),
                'is_open'                => '1',
                'id_danh_muc_cha'         => 0,
            ],
            [
                'ten_danh_muc'            => 'Mì Rau Củ Ăn Dặm Anpaso',
                'slug_danh_muc'           => Str::slug('Mì Rau Củ Ăn Dặm Anpaso'),
                'is_open'                => '1',
                'id_danh_muc_cha'         => 1,
            ],
            [
                'ten_danh_muc'            => 'Ngũ Cốc Dinh Dưỡng Mẹ Và Bé',
                'slug_danh_muc'           => Str::slug('Ngũ Cốc Dinh Dưỡng Mẹ Và Bé'),
                'is_open'                => '1',
                'id_danh_muc_cha'         => 1,
            ],
            [
                'ten_danh_muc'            => 'Món xào trộn',
                'slug_danh_muc'           => Str::slug('Món xào trộn'),
                'is_open'                => '1',
                'id_danh_muc_cha'         => 2,
            ],
            [
                'ten_danh_muc'            => 'Món chay',
                'slug_danh_muc'           => Str::slug('Món chay'),
                'is_open'                => '1',
                'id_danh_muc_cha'         => 2,
            ],


        ]);
    }
}
