<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_hoa_dons';

    protected $fillable = [
        'id_san_pham',
        'ten_san_pham',
        'so_luong_nhap',
        'don_gia_nhap',
        'thanh_tien',
        'id_hoa_don_nhap',
    ];
}
