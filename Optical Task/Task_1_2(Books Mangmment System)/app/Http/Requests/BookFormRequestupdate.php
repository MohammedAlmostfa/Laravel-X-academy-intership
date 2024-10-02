<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFormRequestupdate extends FormRequest
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
            'title' => 'nullable|string|unique:books,title',
            'status' => 'nullable|string|exists:authors,id',
            'published_at' => 'nullable|date',
            'is_active' => 'string',
            'category_id' => 'nullable|integer|exists:categories,id',
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
            'title' => 'اسم الكتاب',
            'author' => 'المؤلف',
            'published_at' => 'تاريخ النشر',
            'is_active' => 'حالة الكتاب',
            'category_id' => 'الفئة',
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
            'required' => 'ان حقل :attribute مطلوب',
            'string' => 'ان حقل :attribute يجب أن يكون نصيًا',
            'date' => 'ان حقل :attribute يجب أن يكون تاريخًا',
            'unique' => 'ان حقل :attribute موجود من قبل',
            'exists' => 'ان حقل :attribute غير موجود',
            'integer' => 'ان حقل :attribute يجب أن يكون رقميًا',
        ];
    }
}
