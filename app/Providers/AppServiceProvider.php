<?php

namespace App\Providers;

use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $danhMucCha = DanhMuc::where('is_open',1)
                             ->where('id_danh_muc_cha', 0)
                             ->get();
        $danhMucCon = DanhMuc::where('is_open', 1)
                             ->where('id_danh_muc_cha', '>', 0)
                             ->get();
        $SanPham = SanPham::where('is_open',1)->take(4)->get();
        // dd($danhMucCha);
        View()->share('danhMucCha', $danhMucCha);
        View()->share('SanPham', $SanPham);
        View()->share('danhMucCon', $danhMucCon);
    }
}
