<?php

namespace App\Http\Requests\customer;

use App\Rules\FullnameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class customernrequestcreat extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json($validator->errors(), 422));
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // تأكد من إرجاع true للسماح بتنفيذ الطلب
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required',  new FullnameRule()],
            'email' => ['required', 'email', 'unique:customers,email'],
            'phone_number' => ['required', 'regex:/^\+963[1-9][0-9]{8}$/','unique:customers,phone_number']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'اسم المستخدم',
            'email' => 'ايميل المستخدم',
            'phone_number' => 'رقم الموبايل'
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'حقل :attribute مطلوب.',
            'alpha' => 'حقل :attribute يجب أن يحتوي على حروف فقط.',
            'email' => 'حقل :attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
            'unique' => 'حقل :attribute مستخدم بالفعل.',
            'required' => 'حقل :attribute مطلوب.',
            'regex' => 'حقل :attribute يجب أن يكون رقم هاتف سوري صالح.'
        ];
    }
}
