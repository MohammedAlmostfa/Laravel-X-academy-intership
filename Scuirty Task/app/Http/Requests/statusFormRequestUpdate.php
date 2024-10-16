<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusFormRequestUpdate extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => 'required|string',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'status' => 'حالة التاسك',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'status.required' => 'حقل حالة التاسك مطلوب.',
            'status.string' => 'حقل حالة التاسك يجب أن يكون نصي.',
        ];
    }
}
