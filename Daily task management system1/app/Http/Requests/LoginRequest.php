<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {

        return redirect()->back()->with('error', '$validator->errors(): ');

    }

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
          'email' => 'عنوان البريد الالكتروني',
            'password' => 'كلمة السر',
        ];

    }

    public function messages()
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'يجب أن يكون حقل :attribute من نوع نصي',
            'email' => 'يجب أن يكون حقل :attributeصالح',
        ];
    }

}
