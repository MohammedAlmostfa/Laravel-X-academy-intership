<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowRecordFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'book_id'=>'الكتاب',
            'user_id'=>'المستخدم',
           
        ];

    }

    public function messages()
    {
        return [
            'required' => 'حقل :attribute مطلوب',
        

        ];
    }
}
