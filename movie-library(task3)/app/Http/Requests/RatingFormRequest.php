<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;

class RatingFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }
    //**________________________________________________________________________________________________

    public function authorize(): bool
    {
        return auth()->check();

    }
    //**________________________________________________________________________________________________
    public function rules()
    {
        $rules=[];
        if ($this->isMethod('post')) {

            $rules['movie_id'] ='required|exists:movies,id';
            $rules['rating'] = 'required|integer|between:1,5';
            $rules['review'] = 'nullable|string'
            ;
        }
        if ($this->isMethod('put') || $this->isMethod('patch')) {

            $rules['movie_id'] ='nullable|exists:movies,id';
            $rules['rating'] = 'nullable|integer|between:1,5';
            $rules['review'] = 'nullable|string';
        }
        return $rules;
        
    }
    //**________________________________________________________________________________________________
    public function attributes()
    {
        return [
           
                'movie_id' => 'رقم الفلم',
                'rating' => 'التقيم',
                'review' => 'التعليق',
        ];
    }
    //**________________________________________________________________________________________________

    public function messages()
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'يجب أن يكون حقل :attribute من نوع نصي',
            'integer' => 'يجب أن يكون حقل :attribute من نوع نصي',
            'between'=>'يجب ان يكون حق ال :attribute بين ال 1 و5',
            'exists'=>'يجب ان يكون حقل  :attribute  موجود ضمن ال جدول الكتب'

        ];
    }



}
