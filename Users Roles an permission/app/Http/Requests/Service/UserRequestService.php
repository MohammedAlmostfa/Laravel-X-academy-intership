<?php

namespace App\Http\Requests\Service;

use Illuminate\Contracts\Validation\Validator;

class UserRequestService
{
    public function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }

    public function attributes()
    {
        return [
            'name' => 'اسم',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة السر',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'ان حقل :attribute مطلوب',
            'unique' => 'ان حقل ال :attribute مستعمل مسبقا',
            'email' => 'يجب أن يكون حقل :attribute صالح',
            'strings' => 'ان حقل :attribute يجب ان يكون من نوع نصي',

        ];
    }
}
