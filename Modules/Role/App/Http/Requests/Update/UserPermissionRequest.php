<?php

namespace Modules\Role\App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', Rule::exists('permissions', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'permissions.required' => 'The permissions field is required.',
            'permissions.array' => 'The permissions must be an array.',
            'permissions.*.required' => 'Each permission is required.',
            'permissions.*.exists' => 'One or more selected permissions are invalid.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
