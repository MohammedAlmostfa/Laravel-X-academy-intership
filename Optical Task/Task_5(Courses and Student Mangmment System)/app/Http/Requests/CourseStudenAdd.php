<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseStudenAdd extends FormRequest
{
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
           'StudentId'=>'required|integer|exists:students,id',
        ];
    }
    public function attributes()
    {
        return [
           'StudentId'=>'الطالب',
        ];

    }
    public function messages()
    {

        return [

             'required' => 'ان حقل :attribute مطلوب',
 'exists'=>'ان حق ال :attributes يجب ان يكون موحود'
        ];
    }
}
