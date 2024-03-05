<?php

namespace App\Http\Controllers;

use App\Http\Requests\TinTuc\CreateTinTucRequest;
use App\Http\Requests\TinTuc\DeleteTinTucRequest;
use App\Http\Requests\TinTuc\UpdateTinTucRequest;
use App\Models\TinTuc;
use Illuminate\Http\Request;

class TinTucController extends Controller
{

    public function index()
    {
        return view('admin.page.tin_tuc.index');
    }
    public function store(CreateTinTucRequest $request)
    {
        $data = $request->all();

        TinTuc::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã thêm mới tin tức thành công!',
        ]);
    }
    public function data()
    {
        $data = TinTuc::get();

        return response()->json([
            'data'  => $data,
        ]);
    }
    public function destroy(DeleteTinTucRequest $request)
    {
        TinTuc::where('id', $request->id)->first()->delete();

        return response()->json([
            'status'    => true,
        ]);
    }
    public function update(UpdateTinTucRequest $request)
    {
        $data = $request->all();
        $phim = TinTuc::where('id', $request->id)->first();
        $phim->update($data);

        return response()->json([
            'status'    => true,
        ]);
    }
    public function changeStatus($id)
    {
        $tinTuc = TinTuc::where('id', $id)->first();

        if($tinTuc) {
            $tinTuc->trang_thai = !$tinTuc->trang_thai;
            $tinTuc->save();
        }
    }
}
