<?php

namespace App\Http\Requests\DanhMuc;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDanhMucRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'    =>  'required|exists:danh_mucs,id',
        ];
    }

    public function messages()
    {
        return [
            'id.*'  => 'Danh mục không tồn tại!',
        ];
    }
}
