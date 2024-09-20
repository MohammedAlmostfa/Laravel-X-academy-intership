<?php

namespace App\Http\Requests;

use App\Http\Requests\Service\UserRequestService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UserFormRequestUpdate extends FormRequest
{
    protected $UserRequestService;
    public function __construct(UserRequestService $userRequestService)
    {
        $this->UserRequestService = $userRequestService;
    }



    public function failedValidation(Validator $validator)
    {
        $this->UserRequestService->failedValidation($validator);
    }



    public function attributes()
    {
        return $this->UserRequestService->attributes();
    }



    public function messages()
    {
        return $this->UserRequestService->messages();
    }



    public function authorize(): bool
    {
        return true;
    }




    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'email' => 'nullable|string|email|unique:users',
            'password' => 'nullable|string',
        ];
    }


}
