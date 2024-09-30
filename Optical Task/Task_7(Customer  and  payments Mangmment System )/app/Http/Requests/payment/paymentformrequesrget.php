<?php


namespace App\Http\Requests\payment;

use Illuminate\Foundation\Http\FormRequest;

class paymentformrequesrget extends FormRequest
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


           'payment_date' => 'nullable|date',

        'status'=>'nullable|string',

        ];

    }

    /**
     * Get custom attribute names.
     */
    public function attributes()
    {
        return [
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


            'exists' =>' ان حق ال attributesغير موجود ',
            'date' =>' ان حق ال attributes يجب ان يكون تاريخ صالح',

        ];
    }
}
