<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'role_id' => ['required', Rule::exists('roles','id')],
            'password' => ['required']
        ];
    }

    public function authorize(): bool
    {
        return \Gate::allows('create users');
    }
}
