<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{

    public function index()
    {
        return view('admin.page.binh_luan.index');
    }

    public function getData()
    {
        $binhLuan = BinhLuan::join('clients', 'clients.id', 'binh_luans.id_khach_hang')
                            ->select('binh_luans.*', 'clients.ho_va_ten')
                            ->get();

        return response()->json([
            'data' => $binhLuan
        ]);
    }

    public function getDataDM()
    {
        $data = DanhMuc::where('id_danh_muc_cha', '>', 0)
                        ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function getDataSP($id)
    {
        if($id == 0){
            $data = SanPham::where('id_danh_muc', $id)->get();
            $binhLuan = BinhLuan::join('clients', 'clients.id', 'binh_luans.id_khach_hang')
                            ->select('binh_luans.*', 'clients.ho_va_ten')
                            ->get();

            return response()->json([
                'data' => $data,
                'dataBL' => $binhLuan
            ]);
        }else{
            $data = SanPham::where('id_danh_muc', $id)->get();

            return response()->json([
                'data' => $data
            ]);
        }
    }

    public function getDataTheoSP($id)
    {
        $binhLuan = BinhLuan::join('clients', 'clients.id', 'binh_luans.id_khach_hang')
                            ->where('id_san_pham', $id)
                            ->select('binh_luans.*', 'clients.ho_va_ten')
                            ->get();

        return response()->json([
            'data' => $binhLuan
        ]);
    }

    public function deleteBL(Request $request)
    {
        $binhLuan = BinhLuan::find($request->id);

        if($binhLuan){
            $binhLuan->delete();
            return response()->json([
                'status' => 1,
                'message'=> 'Đã xóa bình luận!'
            ]);
        }
    }
}
