<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class SpecialtyRequestCreate extends FormRequest
{


    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'SpecialtyName' => ucfirst($this->SpecialtyName),
        ]);
    }

    public function attributes()
    {
        return [
            'SpecialtyName' => 'اسم الاختصاص',
        ];
    }

    public function messages()
    {
        return [
            'SpecialtyName.required' => 'ان حقل :attribute مطلوب',
            'SpecialtyName.string' => 'ان حقل :attribute يجب ان يكون من نوع نصي',
            'SpecialtyName.unique' => 'ان حقل :attribute موجود مسبقا',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
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
            'SpecialtyName' => 'required|string|unique:specialties,SpecialtyName',
        ];
    }
}
