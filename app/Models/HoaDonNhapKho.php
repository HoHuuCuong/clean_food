<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonNhapKho extends Model
{
    use HasFactory;

    protected $table = 'hoa_don_nhap_khos';

    protected $fillable = [
        'ma_hoa_don',
        'tong_tien_hoa_don',
        'ghi_chu',
        'tinh_trang',
        'id_admin',
    ];
}
