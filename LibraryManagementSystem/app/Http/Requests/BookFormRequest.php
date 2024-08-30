<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BookFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }

 

    public function attributes()
    {
        return [
            'title' => 'عنوان الكتاب',
            'author' => 'اسم المؤلف',
            'description' => 'الوصف',
            'published_at' => 'تاريخ النشر',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'يجب أن يكون حقل :attribute من نوع نصي',
            'min' => 'يجب أن يكون حقل :attribute عدد حروفه أكبر من :min',
            'date' => 'يجب أن يكون :attribute تاريخ صالح',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|min:3',
            'description' => 'nullable|string',
            'published_at' => 'nullable|date',
        ];
    }
}
