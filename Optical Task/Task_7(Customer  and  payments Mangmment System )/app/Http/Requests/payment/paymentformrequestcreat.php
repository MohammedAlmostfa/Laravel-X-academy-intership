<?php

namespace App\Http\Requests\payment;

use Illuminate\Foundation\Http\FormRequest;

class paymentformrequestcreat extends FormRequest
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

           'amount' => 'required|integer|min:1',
           'payment_date' => 'required|date',
           'customer_id' => 'required|integer|exists:customers,id',
        'status'=>'nullable|string',

        ];

    }

    /**
     * Get custom attribute names.
     */
    public function attributes()
    {
        return [
            ' amount'=>'الدفهة',
           'payment_date' =>' تاريخ الدفع',
             'status'=>'حالة الدفعة',
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
