<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateTaiKhoanRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.page.tai_khoan.index');
    }
    public function store(CreateTaiKhoanRequest $request)
    {

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        Admin::create($data);

        return response()->json([
            'status'    => true
        ]);
    }
    public function data()
    {
        $data = Admin::get();

        return response()->json([
            'data'  => $data,
        ]);
    }
    public function viewLogin()
    {
        return view('admin.login');
    }
    public function actionLogin(Request $request)
    {

        $data['email']      = $request->email;
        $data['password']   = $request->password;

        $check = Auth::guard('admin')->attempt($data);

        return response()->json([
            'status'    => $check,
        ]);
    }
    public function logout()
    {
        Auth::guard('admin')->logout();

        toastr()->success('Bạn đã đăng xuất tài khoản !');
        return redirect('/admin/login');

    }
    public function destroy(Request $request)
    {
        Admin::where('id', $request->id)->first()->delete();

        return response()->json([
            'status'    => true,
        ]);
    }
    public function update(Request $request)
    {
        $data      = $request->all();
        $TaiKhoan = Admin::find($request->id);
        $data['password'] = bcrypt($data['password']);
        $TaiKhoan->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật thành công!',
        ]);

    }

}
