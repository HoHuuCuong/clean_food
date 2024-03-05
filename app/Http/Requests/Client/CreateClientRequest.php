<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'ho_va_ten'         =>  'required',
            'phone'             =>  'required',
            'email'             =>  'required|unique:clients,email',
            'gioi_tinh'         =>  'required',
            'ngay_sinh'         =>  'required|date',
            'password'          =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.*'         =>  'Họ và tên không được để trống!',
            'phone.*'             =>  'Số điện thoại không được để trống!',
            'email.required'      =>  'Email không được để trống!',
            'email.unique'        =>  'Email đã tồn tại!',
            'gioi_tinh.*'         =>  'Gioi tính không được để trống!',
            'ngay_sinh.*'         =>  'Ngày sinh không được để trống!',
            'password.*'          =>  'Mật khẩu không được để trống!',
        ];
    }
}
