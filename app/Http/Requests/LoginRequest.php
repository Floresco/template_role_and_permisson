<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', "min:4"],
            'remember_token' => ['nullable'],
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        if ($this->get('remember_token') === 'yes'){
            $this->merge(['remember_token' => true]);
        }
    }

    public function authorize(): bool
    {
        return true;
    }
}
