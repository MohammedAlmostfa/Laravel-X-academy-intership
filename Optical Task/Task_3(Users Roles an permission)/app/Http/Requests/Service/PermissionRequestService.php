<?php

namespace App\Http\Requests\Service;

use Illuminate\Contracts\Validation\Validator;

class PermissionRequestService
{
    public function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }

    public function attributes()
    {
        return [
            'name' => 'اسم المهمة',
            'description' => 'وصف المهمة',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'ان حقل :attribute مطلوب',
            'unique' => 'ان حقل ال :attribute مستعمل مسبقا',
            'string' => 'ان حقل :attribute يجب ان يكون من نوع نصي',
        ];
    }
}
