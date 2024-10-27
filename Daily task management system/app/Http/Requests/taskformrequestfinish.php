<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class taskformrequestfinish extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        return redirect()->back()->with('error', $validator->errors()->first());
    }
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'result'=>'string|max:200|min:10',
        ];
    }
    public function attributes(): array
    {
        return [
            'result' => ' Result',

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
            'result.min' => 'The :attribute  must be at least 5 characters.',
            'result.max' => 'The :attribute must be at least :max characters.',
        ];
    }

}
