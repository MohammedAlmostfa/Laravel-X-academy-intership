<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class InstructorRequestCreate extends FormRequest
{


    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:25|unique:instructors,name',
            'experience' => 'required|integer|max:50',
            'specialty' => 'required|exists:specialties,id'
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
            'name' => 'اسم المدرس',
            'experience' => 'خبرة المدرس',
            'specialty' => 'تخصص المدرس',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'string' => 'ان حقل :attribute يجب ان يكون من نوع نصي',
            'integer' => 'ان حقل :attribute يجب ان يكون من نوع رقمي',
            'unique' => 'ان حقل :attribute موجود مسبقا',
            'required' => 'ان حقل :attribute مطلوب',
            'exists' => 'ان حقل :attribute غير موجود'
        ];
    }
}
