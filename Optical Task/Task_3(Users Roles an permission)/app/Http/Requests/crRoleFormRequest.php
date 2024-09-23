<?php

namespace App\Http\Requests;

use App\Http\Requests\Service\RoleRequestService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class crRoleFormRequest extends FormRequest
{
    protected $roleRequestService;

    public function __construct(RoleRequestService $roleRequestService)
    {
        $this->roleRequestService = $roleRequestService;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => ucfirst($this->name),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return $this->roleRequestService->attributes();
    }

    protected function failedValidation(Validator $validator)
    {
        $this->roleRequestService->failedValidation($validator);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:roles,name',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return $this->roleRequestService->messages();
    }
}
