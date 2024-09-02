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
            'case'=>'حالة الكتاب',
            'category'=>'فئة الكتاب',
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
            'max' => 'يجب أن يكون حقل :attribute عدد حروفه اصغر من :max',
        ];
    }
  

    public function rules(): array
    {
        // for show the data with filtring
        if ($this->isMethod('get')) {

            $rules['author'] = 'nullable|string|min:3';
            $rules['category']='nullable|string|min:3|max:10';
            $rules['case']='nullable|string';

        }
        // for add book
        elseif ($this->isMethod('post')) {
            $rules['title']='required|string|max:25';
            $rules['author'] = 'required|string|min:3|max:20';
            $rules['description'] = 'nullable|string|max:255';
            $rules['published_at'] = 'nullable|date';
            $rules['category']='required|string|min:3|max:10';

        }
        // for update book

        elseif ($this->isMethod('put') || $this->isMethod('patch')) {

            $rules['title']='nullable|string|max:255';
            $rules['author'] = 'nullable|string|min:3';
            $rules['description'] = 'nullable|string';
            $rules['published_at'] = 'nullable|date';
            $rules['case']='nullable|string';
            $rules['category']='nullable|string|min:3|max:10';


        }
        return $rules;
    }
}
