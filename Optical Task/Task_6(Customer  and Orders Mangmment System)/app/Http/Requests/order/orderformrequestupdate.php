<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class orderformrequestupdate extends FormRequest
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
           'quantity' => 'nullable|integer|min:1',
           'order_date' => 'nullable|date',
           'customer_id' => 'nullable|integer|exists:customers,id',
        ];
    }

    /**
     * Get custom attribute names.
     */
    public function attributes()
    {
        return [
            'product_id' => 'منتج',
            'quantity' => 'كمية',
            'order_date' => 'تاريخ الطلب',
            'customer_id' => 'العميل',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages()
    {
        return [
            'required' =>' ان حقل ال attributes مطلوب',
            'integer'=>'ان حق ال attributes يجب ان يكون رقم ',
            'exists' =>' ان حق ال attributesغير موجود ',
            'date' =>' ان حق ال attributes يجب ان يكون تاريخ صالح',

        ];
    }
}
