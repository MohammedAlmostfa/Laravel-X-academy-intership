<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5|max:25',
            'description' => 'required|string|min:25|max:100',
            'priority' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'nullable|string',
            'assigned_to' => 'required|integer|exists:users,id',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'العنوان',
            'description' => 'الوصف',
            'priority' => 'المستوى',
            'due_date' => 'تاريخ التسليم',
            'status' => 'الحالة',
            'assigned_to' => 'مسندة الى',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'حقل :attribute من نوع نصي',
            'min' => 'يجب أن يكون :attribute أكبر من :min حروف',
            'max' => 'يجب أن يكون :attribute أقل من :max حروف',
            'date' => 'حقل :attribute يجب أن يكون تاريخًا صالحًا',
            'integer' => 'حقل :attribute يجب أن يكون رقمًا صحيحًا',
            'exists' => 'حقل :attribute غير موجود في قاعدة البيانات',
        ];
    }
}
