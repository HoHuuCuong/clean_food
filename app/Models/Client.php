<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'ho_va_ten',
        'phone',
        'email',
        'gioi_tinh',
        'ngay_sinh',
        'password',
        'is_active',
        'is_block',
        'hash',
        'hash_reset',
    ];
}
