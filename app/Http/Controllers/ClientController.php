<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\QuenMatKhauJob;
use App\Jobs\SendMailCreateClientJob;
use App\Models\BinhLuan;
use App\Models\ChiTietBanHang;
use App\Models\Client;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\YeuThich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class ClientController extends Controller
{
    public function viewQuenMatKhau()
    {
        return view('client.page.quen_mat_khau');
    }
    public function actioQuenMatKhau(Request $request)
    {
        $data = $request->all();
        $client =  Client::where('email', $data['email'])->first();
        $data['full_name']= $client->ho_va_ten;
        $data['hash']= $client->hash;

        QuenMatKhauJob::dispatch($data, $data['email']);

        Toastr::success("Đã gửi mail thành công!");

        return redirect('/login');
    }
    public function viewResetPassword($hash)
    {
        return view('client.page.reset_pass', compact('hash'));

    }
    public function actioResetPassword(Request $request)
    {
        $client = Client::where('hash', $request->hash)->first();
        if($client){
            $client->password = bcrypt($request->password);
            $client->save();
            Toastr::success('Đã thay đổi mật khẩu thành công!');
            return redirect('/login');
        }else{
            Toastr::error('Đã có lỗi hệ thống!');
            return redirect('/login');
        }
    }


    public function actionRegister(CreateClientRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['hash'] = Str::uuid();
        Client::create($data);

        SendMailCreateClientJob::dispatch($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo tài khoản thành công',
        ]);
    }


    public function actionLogin(Request $request)
    {
        $data['email']      = $request->email;
        $data['password']   = $request->password;

        $check = Auth::guard('client')->attempt($data);
        if($check) {
            if(Auth::guard('client')->user()->is_active == 0){
                Auth::guard('client')->logout();
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản chưa được kích hoạt!',
                ]);
            }
            return response()->json(['status' => true]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Tài khoản hoặc mật khẩu không đúng!',
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('client')->logout();

        toastr()->success('Bạn đã đăng xuất tài khoản !');
        return redirect('/');

    }

    public function getData()
    {
        $data = Client::get();

        return response()->json([
            'data'  => $data,
        ]);
    }
    public function ViewKH()
    {
        return view('admin.page.quan_ly_khach_hang.index');
    }

    public function destroy(Request $request)
    {
        Client::where('id', $request->id)->first()->delete();

        return response()->json([
            'status'    => true,
        ]);
    }
    public function update(Request $request)
    {
        $data      = $request->all();
        $KhachHang = Client::find($request->id);
        $data['password'] = bcrypt($data['password']);
        $KhachHang->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật khách hàng thành công!',
        ]);

    }

    public function activeClient($hash)
    {
        $client = Client::where('hash', $hash)->first();
        if($client){
            if($client->is_active == 1){
                toastr()->warning('Tài khoản đã được kích hoạt trước đó!');
                return redirect('/login');
            }
            $client->is_active = 1;
            $client->save();

            toastr()->success('Đã kích hoạt tài khoản thành công!');

            return redirect('/login');
        }
    }

    public function yeuThich($id)
    {
        $KhachHang = Auth::guard('client')->user();

        $yeuThich = YeuThich::where('id_san_pham', $id)
                            ->where('id_khach_hang', $KhachHang->id)
                            ->first();
        if($yeuThich){
            return response()->json([
                'status'    => false,
                'message'   => 'Đã thêm vào yêu thích trước đó!',
            ]);
        }else{
            YeuThich::create([
                'id_san_pham'       => $id,
                'id_khach_hang'     => $KhachHang->id,
                'is_yeu_thich'      => 0,
            ]);

            return response()->json([
                'status'    => true,
                'message'   => 'Đã thêm vào yêu thích thành công!',
            ]);
        }


    }

    public function comment(Request $request)
    {
        $KhachHang = Auth::guard('client')->user();

        $data = $request->all();

        BinhLuan::create([
            'id_san_pham'   =>   $request->id_san_pham,
            'id_khach_hang' =>   $KhachHang->id,
            'noi_dung'      =>   $request->noi_dung,
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Đã bình luận bài viết!',
        ]);
    }

    public function viewYeuthich()
    {
        $KhachHang = Auth::guard('client')->user();
        $yeuThich = YeuThich::where('id_khach_hang', $KhachHang->id)
                            ->join('san_phams', 'yeu_thiches.id_san_pham', 'san_phams.id')
                            ->select('san_phams.*', 'yeu_thiches.id as id_yeu_thich')
                            ->get();
        return view('client.yeuthich', compact('yeuThich'));
    }

    public function huyYeuThich($id)
    {
        $KhachHang = Auth::guard('client')->user();

        $yeuThich = YeuThich::where('id_san_pham', $id)
                            ->where('id_khach_hang', $KhachHang->id)
                            ->first();
        if($yeuThich){
            $yeuThich->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã hủy yêu thích!',
            ]);
        }
    }

    public function viewCapNhatThongTin()
    {
        $KhachHang = Auth::guard('client')->user();

        $client = Client::find($KhachHang->id);
        return view('client.capnhatClient', compact('client'));
    }

    public function updateInfoClient(UpdateClientRequest $request)
    {
        $data = $request->all();
        if(isset($request->password)){
            $client = Client::find($request->id);
            $data['password'] = bcrypt($data['password']);
            $client->update($data);

        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật thông tin thành công',
        ]);
    }

    public function searchSanPham($keySearch)
    {
        $sanPham = SanPham::where('is_open', 1)
                          ->where('ten_san_pham', 'like', '%' . $keySearch . '%')
                          ->get();
        return view('client.search_san_pham', compact('sanPham', 'keySearch'));
    }

    public function viewLichSuDonHang()
    {
        $KhachHang = Auth::guard('client')->user();

        $donHang = DonHang::where('id_khach_hang', $KhachHang->id)->get();

        return view('client.lich_su_don_hang');
    }

    public function dataLichSuDonHang()
    {
        $KhachHang = Auth::guard('client')->user();

        $donHang = DonHang::where('id_khach_hang', $KhachHang->id)->get();

        return response()->json([
            'data'    => $donHang,
        ]);
    }

    public function dataLichSuDonHangChiTiet($id)
    {
        $KhachHang = Auth::guard('client')->user();

        $data = ChiTietBanHang::where('id_don_hang', $id)
                            ->where('id_khach_hang', $KhachHang->id)
                            ->join('san_phams', 'chi_tiet_ban_hangs.id_san_pham', 'san_phams.id')
                            ->select('chi_tiet_ban_hangs.*', 'san_phams.ten_san_pham', 'san_phams.slug_san_pham', 'san_phams.hinh_anh', 'san_phams.gia_ban', 'san_phams.gia_khuyen_mai')
                            ->get();
        return response()->json([
            'data'    => $data,
        ]);
    }
}
