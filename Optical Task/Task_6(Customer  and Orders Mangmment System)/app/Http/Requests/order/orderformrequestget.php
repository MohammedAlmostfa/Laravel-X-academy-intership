<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class orderformrequestget extends FormRequest
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
            'product_id' => 'nullable|integer|exists:products,id',
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => 'منتج',

        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages()
    {
        return [
            'required' =>' ان حقل ال attributes مطلوب',
            'exists' =>' ان حق ال attributesغير موجود ',

        ];
    }
}
