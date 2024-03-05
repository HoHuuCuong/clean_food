<?php

namespace App\Http\Requests\SanPham;

use Illuminate\Foundation\Http\FormRequest;

class CreateSanPhamRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'ten_san_pham'      =>  'required|min:5',
            'slug_san_pham'     =>  'required|min:5',
            'hinh_anh'          =>  'required',
            'so_luong'          =>  'required|numeric',
            'mo_ta'             =>  'required|min:20',
            'id_danh_muc'       =>  'required|exists:danh_mucs,id',
            'is_open'           =>  'required|boolean',
            'gia_ban'           =>  'required|numeric|min:0',
            'gia_khuyen_mai'    =>  'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'ten_san_pham.required' =>  'Tên sản phẩm phải nhập',
            'ten_san_pham.min'      =>  'Tên sản phẩm phải từ 5 ký tự trở lên',
            'slug_san_pham.*'       =>  'Slug phải từ 5 ký tự trở lên',
            'hinh_anh.*'            =>  'Bạn phải nhập hình ảnh',
            'so_luong.*'            =>  'Số lượng không được để trống',
            'mo_ta.*'               =>  'Bạn phải nhập mô tả từ 20 ký tự',
            'id_danh_muc.*'         =>  'Danh mục không tồn tại',
            'is_open.*'             =>  'Trạng thái chỉ được Kinh doanh/Tạm dừng',
            'gia_ban.*'             =>  'Giá bán phải từ 0đ trở lên',
            'gia_khuyen_mai.*'      =>  'Giá bán phải từ 0đ trở lên',
        ];
    }
}
