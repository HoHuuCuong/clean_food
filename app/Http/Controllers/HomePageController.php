<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactRequest;
use App\Jobs\ContactJob;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\TinTuc;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function viewHomePage()
    {
        // $sanPham = SanPham::where('is_open', 1)->get();
        return view('client.homepage');
    }

    public function viewRegister()
    {
        return view('client.page.register');
    }

    public function viewLogin()
    {
        return view('client.page.login');
    }

    public function tinTuc()
    {
        $tinTuc = TinTuc::get();
        return view('client.tintuc', compact('tinTuc'));
    }

    public function chiTiettinTuc($id)
    {
        $tinTuc = TinTuc::find($id);
        $tinTuc2 = TinTuc::orderBy('created_at')
                            ->get();
        return view('client.chitiettintuc', compact('tinTuc', 'tinTuc2'));
    }

    public function viewListProduct($id)
    {
        $danhMuc = DanhMuc::where('id', $id)->first();
        if($danhMuc->id_danh_muc_cha == 0) {
            $list_id_danh_muc = DanhMuc::where('id_danh_muc_cha', $id)
                                        ->select('id')
                                        ->get();
        } else {
            $list_id_danh_muc = DanhMuc::where('id', $id)
                                        ->select('id')
                                        ->get();
        }

        $data = SanPham::whereIn('id_danh_muc', $list_id_danh_muc)->get();
        return view('client.list_product', compact('data', 'danhMuc'));
    }

    public function viewContact()
    {
        return view('client.contact');
    }
    public function actionContact(ContactRequest $request)
    {
        $data = $request->all();
        $data['ho_va_ten']          = $request->ho_va_ten;
        $data['email']              = $request->email;
        $data['tieu_de']            = $request->tieu_de;
        $data['so_dien_thoai']      = $request->so_dien_thoai;
        $data['noi_dung']           = $request->noi_dung;

        ContactJob::dispatch($data);

        return response()->json([
            'status'    => 1,
            'message'   => 'Đã gửi cho nhà bán hàng!',
        ]);
    }

}
