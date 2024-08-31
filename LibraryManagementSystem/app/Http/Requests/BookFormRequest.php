<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BookFormRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }

    //**________________________________________________________________________________________________

    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }
    //**________________________________________________________________________________________________

    public function attributes()
    {
        return [
            'title' => 'عنوان الكتاب',
            'author' => 'اسم المؤلف',
            'description' => 'الوصف',
            'published_at' => 'تاريخ النشر',
            'case'=>'حالة الكتاب'
        ];
    }
    //**________________________________________________________________________________________________
    public function messages()
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'يجب أن يكون حقل :attribute من نوع نصي',
            'min' => 'يجب أن يكون حقل :attribute عدد حروفه أكبر من :min',
            'date' => 'يجب أن يكون :attribute تاريخ صالح',
        ];
    }
  

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|min:3',
            'description' => 'nullable|string',
            'published_at' => 'nullable|date',
            'case'=>'required|string|nullable',
        ];
    }
}
