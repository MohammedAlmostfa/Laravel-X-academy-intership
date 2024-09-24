<?php

namespace App\Http\Requests\prouduct;

use Illuminate\Foundation\Http\FormRequest;

class productformrequestupdate extends FormRequest
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
        'name'=>'string|nullable|min:5|max:25',
        'description'=>'nullable|min:5|max:255',
        'price'=>'nullable|integer|max:200000',
        ];
    }
    public function attributes()
    {
        return[
            'name'=>'اسم المنتج',
            'description'=>'وصف عن المنتج',
            'price'=>'سعر المنتج',];
    }
    public function messages()
    {
        return [
            'required' => 'ان :attribute مطلوب',
            'string' => 'ان :attribute من نوع نص',
            'min' => 'ان :attribute يجب ان يكون اكبر من :min',
            'max' => 'ان :attribute يجب ان يكون اصغر من :max',
            'integer' => 'ان :attribute من نوع رقم',
        ];
    }



}
