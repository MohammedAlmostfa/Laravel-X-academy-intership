<?php

namespace App\Http\Requests;

use App\Http\Requests\Service\RoleRequestService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class upRoleFormRequest extends FormRequest
{
    protected $roleRequestService;

    public function __construct(RoleRequestService $roleRequestService)
    {
        $this->roleRequestService = $roleRequestService;
    }

    protected function prepareForValidation()
    {
        if(!empty($this->name)) {
            $this->merge([
                'name' => ucfirst($this->name),
            ]);
        }
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
            'name' => 'nullable|string|unique:roles,name',
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return $this->roleRequestService->messages();
    }
}
