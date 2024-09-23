<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequestUpdate extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
               'name' => 'nullable',
               'email' => 'nullable|email|unique:students,email|string',
               'password' => 'nullable',
           ];
    }

    public function attributes()
    {
        return [
            'name' => 'اسم المستخدم',
            'email' => 'ايميل المستخدم',
            'password' => 'كلمة السر',
        ];
    }

    public function messages()
    {
        return [
            'string' => 'ان حقل :attribute يجب ان يكون من نوع نصي',
            'unique' => 'ان حقل :attribute موجود مسبقا',

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
