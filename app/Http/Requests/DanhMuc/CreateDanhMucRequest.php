<?php

namespace App\Http\Requests\DanhMuc;

use Illuminate\Foundation\Http\FormRequest;

class CreateDanhMucRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten_danh_muc'            => 'required|min:3',
            'slug_danh_muc'           => 'required|min:3',
            'is_open'                 => 'required|boolean',
            'id_danh_muc_cha'         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ten_danh_muc.*'            => 'Tên danh mục phải ít nhất 3 kí tự',
            'slug_danh_muc.*'           => 'Slug danh mục ít nhất phải 3 kí tự',
            'is_open.*'                 => 'Tình trạng không được để trống',
            'id_danh_muc_cha.*'         => 'Danh mục cha không được để trống',
        ];
    }
}
