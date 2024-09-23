<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class MovieFromRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator->errors(), 422));
    }

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
        if ($this->isMethod('get')) {
            return[
            'per_page' => ['nullable','integer'],
            'genre' => ['nullable','string'],
            'director' => ['nullable','string'],
            'sort_dir' => ['nullable','string'],

            ];
        } elseif ($this->isMethod('post')) {
            return [
                'title' => 'required',
                    'director' =>'required|string',
                    'genre' => 'required|string',
                    'release_year' => 'required|integer',
                    'description' => 'required|string',
            ];
        } elseif ($this->isMethod('put')) {
            return [
                            'title' => 'nullable',
                                'director' =>'nullable|string',
                                'genre' => 'nullable|string',
                                'release_year' => 'nullable|integer',
                                '' => 'nullable|string',
                        ];





        }

    }
}
