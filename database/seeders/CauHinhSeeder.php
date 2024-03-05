<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CauHinhSeeder extends Seeder
{

    public function run()
    {
        DB::table('cau_hinhs')->delete();

        DB::table('cau_hinhs')->truncate();

        DB::table('cau_hinhs')->insert([
            [
                'list_image'    =>  'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkbg_Kczs7msOzIWifUdP0qPOWoq74vRYGkxJIZFEG5ByIaFp_3h6zS58l948HSRnaDDk&usqp=CAU,https://thanhhafresh.com/files/assets/slide/slide_1.jpg,',
                'list_title'    =>  'TIEU DE 01|TIEU DE 02',
                'list_des'      =>  'Ảnh Rau 2|Ảnh Rau 2',
                'list_link'     =>  'https://youtube.com|https://google.com',
            ]
        ]);
    }
}
