<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuThich extends Model
{
    use HasFactory;

    protected $table = 'yeu_thiches';

    protected $fillable = [
        'id_san_pham',
        'id_khach_hang',
        'is_yeu_thich',
    ];
}
