<?php

namespace App\Http\Controllers;

use App\Models\ChiTietBanHang;
use App\Models\ChiTietHoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function index()
    {
        $data = ChiTietBanHang::join('san_phams', 'san_phams.id', 'chi_tiet_ban_hangs.id_san_pham')
                                ->select(
                                    DB::raw('SUM(chi_tiet_ban_hangs.so_luong) as tong_so_luong'),
                                    'san_phams.ten_san_pham',
                                )
                                ->take(5)
                                ->groupBy('san_phams.ten_san_pham')
                                ->get();
        $array_datas = [];
        $array_lable = [];
        foreach ($data as $key => $value) {
            array_push($array_lable, $value->ten_san_pham);
            array_push($array_datas, $value->tong_so_luong);
        }
        return view('admin.page.thong_ke.index', compact('array_lable','array_datas',));
    }

    public function getDataTheoSoLuong(Request $request)
    {
        $so_luong = $request->so_luong;

        $data = ChiTietBanHang::join('san_phams', 'san_phams.id', 'chi_tiet_ban_hangs.id_san_pham')
                                ->select(
                                    DB::raw('SUM(chi_tiet_ban_hangs.so_luong) as tong_so_luong'),
                                    'san_phams.ten_san_pham',
                                )
                                ->take($so_luong)
                                ->groupBy('san_phams.ten_san_pham')
                                ->get();
        $array_datas = [];
        $array_lable = [];
        foreach ($data as $key => $value) {
            array_push($array_lable, $value->ten_san_pham);
            array_push($array_datas, $value->tong_so_luong);
        }

        return view('admin.page.thong_ke.index', compact('array_lable','array_datas', 'so_luong' ));
    }
}
