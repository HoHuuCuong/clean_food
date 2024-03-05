<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'     =>        'required|min:5',
            'phone'         =>        'required|digits:10',
            'email'         =>        'required|email|unique:clients,email',
            'gioi_tinh'     =>        'required',
            'ngay_sinh'     =>        'required|date',
            'password'      =>        'required|min:3',
            're_password'   =>        'required|same:password',
        ];
    }
}
