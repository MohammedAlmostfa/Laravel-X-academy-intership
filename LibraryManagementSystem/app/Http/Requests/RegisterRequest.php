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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'اسم المستخدم',
            'email' => 'عنوان البريد الالكتروني',
            'password' => 'كلمة السر',
        ];

    }

    
    public function messages()
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'يجب أن يكون حقل :attribute من نوع نصي',
            'unique' => 'ان حقل ال :attribute مستعمل مسبقا',
            'email' => 'يجب أن يكون حقل :attribute صالح',
            'max:255'=>'عدد احرف ال :attribute يجب ان يكون اق من 255',
            'min'=>'ان عدد احرف  :attribute يجب ان يكون اكبر من 6'
        ];
    }
}
