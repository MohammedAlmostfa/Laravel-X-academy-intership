<?php

namespace App\Http\Requests\customer;

use Illuminate\Foundation\Http\FormRequest;

class customernrequestget extends FormRequest
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
            'orderstatus'=>'string',
            'order_date'=>'date',
        ];
    }
}
