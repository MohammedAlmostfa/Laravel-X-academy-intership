<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;

class BorrowRecordFormRequest extends FormRequest
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
        $rules = [];

        if ($this->isMethod('post')) {
           
            $rules['book_id'] =  'required|exists:books,id';
        
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['book_id'] = ' required|exists:books,id';
            $rules['due_date'] = 'required|date';

        }
        return $rules;


    }


    public function attributes()
    {
        return [
           
                'book_id' => 'رقم الكتاب',
                'due_date'=> 'تاريخ الاعادو',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'يجب أن يكون حقل :attribute من نوع نصي',
            'data' => 'يجب أن يكون حقل :attribute تاريخ صالح  ',
           
            'exists'=>'يجب ان يكون حقل  :attribute  موجود ضمن ال جدول الكتب'

        ];
    }
}
