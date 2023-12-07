<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:4'],
            'description' => ['required', 'min:4'],
            'permissions' => ['required','array'],
            'permissions.*' => ['required','string']
        ];
    }

    public function authorize(): bool
    {
        return \Gate::allows('create roles');
    }
}
