<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDonNhapKho;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NhapKhoController extends Controller
{
    public function viewQLHD()
    {
        return view('admin.page.quan_ly_hoa_don_nhap_kho.index');
    }
    public function dataHoaDon()
    {
        $dataHD = HoaDonNhapKho::join('admins', 'hoa_don_nhap_khos.id_admin','admins.id')
                                ->select('hoa_don_nhap_khos.*','admins.ho_va_ten')
                                ->where('hoa_don_nhap_khos.tinh_trang' , 1)
                                ->get();

        return response()->json([
            'datahd'  => $dataHD,
        ]);
    }
    public function dataChiTiet($id)
    {
        $dataChiTiet = HoaDonNhapKho::join('chi_tiet_hoa_dons', 'hoa_don_nhap_khos.id','chi_tiet_hoa_dons.id_hoa_don_nhap')
                                     ->where('chi_tiet_hoa_dons.id_hoa_don_nhap' , $id)
                                     ->select('chi_tiet_hoa_dons.*')
                                     ->get();
        return response()->json([
            'dataChiTiet'  => $dataChiTiet,
        ]);
    }
    public function deleteHD(Request $request)
    {
        HoaDonNhapKho::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Đã hóa đơn thành công!',
        ]);

    }
    public function index()
    {
        return view('admin.page.nhap_kho.index');
    }

    public function dataSP()
    {
        $data = SanPham::get();

        return response()->json([
            'data'  => $data,
        ]);
    }

    public function createDetail(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $CheckhoaDon = HoaDonNhapKho::latest()->first();
        if($CheckhoaDon){
            $ma_hoa_don = 1000 + $CheckhoaDon->id;
        }else{
            $ma_hoa_don = 1000;
        }
        $checkHD = HoaDonNhapKho::where('tinh_trang', 0)->first();
        if($checkHD){
            $chiTietHoaDon = ChiTietHoaDon::join('hoa_don_nhap_khos','hoa_don_nhap_khos.id','chi_tiet_hoa_dons.id_hoa_don_nhap')
                                        ->where('chi_tiet_hoa_dons.id_san_pham', $request->id)
                                        ->where('hoa_don_nhap_khos.tinh_trang', 0)
                                        ->first();
            if($chiTietHoaDon) {
                $chiTietHoaDon->so_luong_nhap = $chiTietHoaDon->so_luong_nhap + 1;
                $chiTietHoaDon->save();
                return response()->json([
                    'status' => 1,
                    'message' => 'Thêm thành công',
                ]);
            } else {
                $chiTietHoaDon = ChiTietHoaDon::create([
                    'id_hoa_don_nhap'   => $checkHD->id,
                    'id_san_pham'       => $request->id,
                    'ten_san_pham'      => $request->ten_san_pham,
                ]);

                return response()->json([
                    'status' => 1,
                    'message' => 'Thêm thành công',
                ]);
            }
        }else{
            $hoaDon = HoaDonNhapKho::create([
                'ma_hoa_don' => $ma_hoa_don,
                'id_admin'   => $admin->id,
            ]);

            $chiTietHoaDon = ChiTietHoaDon::join('hoa_don_nhap_khos','hoa_don_nhap_khos.id','chi_tiet_hoa_dons.id_hoa_don_nhap')
                                            ->where('chi_tiet_hoa_dons.id_san_pham', $request->id)
                                            ->where('hoa_don_nhap_khos.tinh_trang', 0)
                                            ->first();
            if($chiTietHoaDon) {
                $chiTietHoaDon->so_luong_nhap = $chiTietHoaDon->so_luong_nhap + 1;
                $chiTietHoaDon->save();
            } else {
                $chiTietHoaDon = ChiTietHoaDon::create([
                    'id_hoa_don_nhap'   => $hoaDon->id,
                    'id_san_pham'       => $request->id,
                    'ten_san_pham'      => $request->ten_san_pham,
                ]);

                return response()->json([
                    'status' => 1,
                    'message' => 'Thêm thành công',
                ]);
            }
        }
    }

    public function dataDetail()
    {
        $data = ChiTietHoaDon::join('hoa_don_nhap_khos', 'chi_tiet_hoa_dons.id_hoa_don_nhap', 'hoa_don_nhap_khos.id')
                            ->where('hoa_don_nhap_khos.tinh_trang', 0)
                            ->select('chi_tiet_hoa_dons.*')
                            ->get();
        return response()->json([
            'status' => 1,
            'data'   => $data,
        ]);
    }

    public function updateDetail(Request $request)
    {
        $sanPham = ChiTietHoaDon::find($request->id);
        if($sanPham){
            $sanPham->so_luong_nhap = $request->so_luong_nhap;
            $sanPham->don_gia_nhap = $request->don_gia_nhap;
            $sanPham->thanh_tien = $request->so_luong_nhap * $request->don_gia_nhap;
            $sanPham->save();
            return response()->json([
                'status'    => 1,
                'message'   => 'Cập nhật thành công !',
            ]);
        }

    }

    public function deleteDetail(Request $request)
    {
        $sanPham = ChiTietHoaDon::find($request->id);
        // dd($sanPham);
        if($sanPham){
            $sanPham->delete();
            return response()->json([
                'status'    => 1,
                'message'   => 'Xóa thành công !',
            ]);
        }
    }

    public function acceptNhapKho(Request $request)
    {
        $hoaDon = HoaDonNhapKho::where('tinh_trang', 0)->first();

        $chiTietHoaDon = ChiTietHoaDon::where('id_hoa_don_nhap', $hoaDon->id)->get();
        $tong_tien = 0;
        foreach($chiTietHoaDon as $key => $value){
            $tong_tien += $value->thanh_tien;
        }

        $hoaDon->ghi_chu = $request->ghi_chu;
        $hoaDon->tinh_trang = 1;
        $hoaDon->tong_tien_hoa_don = $tong_tien;
        $hoaDon->save();

        return response()->json([
            'status'    => 1,
            'message'   => 'Nhập kho thành công !',
        ]);
    }
}

