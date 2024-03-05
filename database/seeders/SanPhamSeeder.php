<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class SanPhamSeeder extends Seeder
{
    public function run()
    {
        DB::table('san_phams')->delete();

        DB::table('san_phams')->truncate();

        DB::table('san_phams')->insert([
            [
                'ten_san_pham'            => 'Mì bí đỏ ăn dặm tự nhiên nguyên chất Anpaso ',
                'slug_san_pham'           => Str::slug('Mì bí đỏ ăn dặm tự nhiên nguyên chất Anpaso '),
                'hinh_anh'                => 'https://anpaso.vn/wp-content/uploads/2022/05/120gg.jpg',
                'mo_ta'                   => 'Mì bí đỏ tự nhiên nguyên chất',
                'mo_ta_ngan'              => 'Bí đỏ 100% tự nhiên nguyên chất từ nông trại hữu cơ
                                                Sợi mì bí đỏ mềm mịn, tươi mới, hương vị ngọt và thanh.
                                                Giàu các loại khoáng chất như vitamin K, canxi, sắt rất tốt cho sức khỏe.
                                                Bổ sung nhiều chất xơ rất tốt cho hệ tiêu hóa của trẻ nhỏ, đặc biệt là trẻ lười ăn rau hay bị táo bón.',
                'gia_ban'                 => 36000,
                'gia_khuyen_mai'          => 30000,
                'so_luong'                => 10,
                'id_danh_muc'             => '3',
                'is_open'                 => '1',
            ],
            [
                'ten_san_pham'            => 'Mì Mầm Lúa Mạch Ăn Dặm Organic Anpaso 120g',
                'slug_san_pham'           => Str::slug('Mì Mầm Lúa Mạch Ăn Dặm Organic Anpaso 120g'),
                'hinh_anh'                => 'https://anpaso.vn/wp-content/uploads/2022/05/120gg.jpg',
                'mo_ta'                   => '– Dinh dưỡng từ 100g: Xơ hòa tan (soluble fiber) 2.41g, Polyphenol tổng (Total polyphenols) 66.4mg',
                'mo_ta_ngan'              => '– Polyphenol như chất chống oxy hóa để giảm căng thẳng oxy hóa
                                                – Xơ dồi dào giúp cải thiện các vấn đề ăn uống thiếu xơ và rau xanh
                                                – Vitamin và khoáng chất đa dạng cải thiện hệ miễn dịch, tăng trưởng tế bào và thị lực',
                'gia_ban'                 => 42000,
                'gia_khuyen_mai'          => 35000,
                'so_luong'                => 15,
                'id_danh_muc'             => '3',
                'is_open'                 => '1',
            ],
            [
                'ten_san_pham'            => 'Bột Ngũ Cốc Mẹ Bầu Anpaso',
                'slug_san_pham'           => Str::slug('Bột Ngũ Cốc Mẹ Bầu Anpaso'),
                'hinh_anh'                => 'https://anpaso.vn/wp-content/uploads/2022/06/Ngu-coc-loi-sua-13-1.png',
                'mo_ta'                   => 'Giúp mẹ có sữa non sớm sau sinh',
                'mo_ta_ngan'              => 'Giải quyết cơn đói, đẩy xa cơn nghén cho mẹ bầu
                                            Loại bỏ chứng táo bón thường gặp
                                            Giảm nguy cơ mắc bệnh tiểu đường
                                            Dinh dưỡng dồi dào, mẹ khỏe bé phát triển khỏe mạnh',
                'gia_ban'                 => 298000,
                'gia_khuyen_mai'          => 270000,
                'so_luong'                => 20,
                'id_danh_muc'             => '4',
                'is_open'                 => '1',
            ],
            [
                'ten_san_pham'            => 'Ngũ cốc lợi sữa tiện lợi Anpaso (dạng gói)',
                'slug_san_pham'           => Str::slug('Ngũ cốc lợi sữa tiện lợi Anpaso (dạng gói)'),
                'hinh_anh'                => 'https://anpaso.vn/wp-content/uploads/2022/08/z3568345591022_98df0f78264b20f30b1da7f939f52925.jpg',
                'mo_ta'                   => 'Kích sữa về nhiều và giàu dinh dưỡng',
                'mo_ta_ngan'              => 'Ngăn chặn táo bón cho mẹ và bé
                                                Bé bú no lâu, ngủ sâu ngon giấc, tăng cân đều
                                                Tinh bột nghệ vàng giúp khí huyết lưu thông, đẩy sản dịch
                                                Mẹ lấy dáng về nhanh, da dẻ hồng hào',
                'gia_ban'                 => 248000,
                'gia_khuyen_mai'          => 220000,
                'so_luong'                => 15,
                'id_danh_muc'             => '4',
                'is_open'                 => '1',
            ],


        ]);
    }
}
