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
        return [
            'book_id' => 'required|exists:books,id',
            
        ];
    }
}
