<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'san_phams';

    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'slug_san_pham',
        'is_open',
        'gia_ban',
        'gia_khuyen_mai',
        'id_danh_muc',
        'hinh_anh',
        'mo_ta',
        'mo_ta_ngan',
        'so_luong',
    ];
}
