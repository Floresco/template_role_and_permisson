<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends RoleStoreRequest
{
    public function authorize(): bool
    {
        return \Gate::allows('update roles');
    }

}
