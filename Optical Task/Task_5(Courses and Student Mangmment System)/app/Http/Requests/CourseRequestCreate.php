<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CourseRequestCreate extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Correct the date format
        $this->merge([
            'start_date' => date('Y-m-d', strtotime($this->input('start_date'))),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'start_date' => 'required|date|after:tomorrow',
            'description' => 'required|string',
            'instructor_id'=>'required|integer|exists:instructors,id',
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
            'name' => 'اسم الدورة',
            'start_date' => 'تاريخ البداية',
            'description' => 'الوصف',
            'instructor_id'=>'المدرس'
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
            'required' => 'ان حقل :attribute مطلوب',
            'date' => 'ان حقل :attribute يجب ان يكون تاريخ صالح',
            'after' => 'يجب ان يكون حقل :attribute بعد اليوم',
            'exists'=>'ان حق ال :attributes يجب ان يكون موحود'
        ];
    }
}
