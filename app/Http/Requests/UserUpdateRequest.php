<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserUpdateRequest extends UserStoreRequest
{

    public function rules(): array
    {
        $rules = [
            'action' => ['required'],
            'password' => ['nullable'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function authorize(): bool
    {
        return \Gate::allows('update users');
    }
}
