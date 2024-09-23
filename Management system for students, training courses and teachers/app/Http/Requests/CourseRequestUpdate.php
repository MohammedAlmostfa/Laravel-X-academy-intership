<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CourseRequestUpdate extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }
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
            'name' => 'nullable|string',
            'start_date' => 'nullable|date|after:tomorrow',
            'description' => 'nullable|string',
            'instructor_id'=>'nullable|integer|exists:instructors,id',
        ];
    }
    public function attributes()
    {
        return [
            'name' => ' اسم الدورة',
            'start_date' => 'تاريخ البداية',
            'description' => ' الوصف',
             'instructor_id'=>'المدرس'
        ];
    }
    public function messages()
    {

        return [
             'string' => 'ان حقل :attribute يجب ان يكون من نوع نصي',
             'required' => 'ان حقل :attribute مطلوب',
             'date' => 'ان حقل :attribute يجب ان يكون تاريخ صالح',
            'after'=>' بجيب ان يكون حقل ال :attribute بعد اليوم',
 'exists'=>'ان حق ال :attributes يجب ان يكون موحود'
        ];
    }
}
