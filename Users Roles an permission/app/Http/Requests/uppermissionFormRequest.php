<?php

namespace App\Http\Requests;

use App\Http\Requests\Service\PermissionRequestService;
use App\Http\Requests\Service\RoleRequestService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class uppermissionFormRequest extends FormRequest
{
    protected $permissionRequestService;

    public function __construct(PermissionRequestService $permissionRequestService)
    {
        $this->permissionRequestService = $permissionRequestService;
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
        return $this->permissionRequestService->attributes();
    }

    protected function failedValidation(Validator $validator)
    {
        $this->permissionRequestService->failedValidation($validator);
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
        return $this->permissionRequestService->messages();
    }
}
