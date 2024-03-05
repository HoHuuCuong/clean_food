<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'        =>  'required',
            'so_dien_thoai'    =>  'required|digits:10',
            'email'            =>  'required',
            'tieu_de'          =>  'required',
            'noi_dung'         =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required'         =>  'Họ và tên không được để trống!',
            'so_dien_thoai.required'     =>  'Số điện thoại không được để trống!',
            'so_dien_thoai.digits'       =>  'Số điện phải là 10 số!',
            'email.required'             =>  'Email không được để trống!',
            'tieu_de.required'           =>  'Tiêu đề không được để trống!',
            'noi_dung.required'          =>  'Nội dung không được để trống!',
        ];
    }
}
