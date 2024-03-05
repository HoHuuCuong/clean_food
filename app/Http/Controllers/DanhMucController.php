<?php

namespace App\Http\Controllers;

use App\Http\Requests\DanhMuc\CreateDanhMucRequest;
use App\Http\Requests\DanhMuc\DeleteDanhMucRequest;
use App\Http\Requests\DanhMuc\UpdateDanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.danh_muc.index');
    }
    public function store(CreateDanhMucRequest $request)
    {
        $data = $request->all();

        DanhMuc::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã thêm mới danh mục thành công!',
        ]);
    }
    public function data()
    {
        $sql  = "SELECT A.*, B.ten_danh_muc as ten_danh_muc_cha
                 FROM danh_mucs A LEFT JOIN danh_mucs B
                 on A.id_danh_muc_cha = B.id";
        $data = DB::select($sql);
        return response()->json([
            'list' => $data
        ]);
    }
    public function changeStatus($id)
    {
        $danhMuc = DanhMuc::where('id', $id)->first();
        if($danhMuc){
            $danhMuc->is_open = !$danhMuc->is_open;
            $danhMuc->save();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công'
            ]);
        }else{
            return response()->json([
                'status'     => false,
                'message'    => 'Đã có lỗi hệ thống!'
            ]);
        }
    }

    public function update(UpdateDanhMucRequest $request)
    {
        $data    = $request->all();
        $sanPham = DanhMuc::find($request->id); // where('id', $request->id)->first();
        $sanPham->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật danh mục thành công!',
        ]);
    }
    public function destroy(DeleteDanhMucRequest $request)
    {
        DanhMuc::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa danh mục thành công!',
        ]);

    }
}
