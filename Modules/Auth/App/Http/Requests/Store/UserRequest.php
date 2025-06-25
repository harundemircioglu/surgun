<?php

namespace Modules\Auth\App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['nullable', 'string', 'max:10', Rule::unique('users', 'phone')],
            'role' => ['required', Rule::exists('roles', 'id')],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', Rule::exists('permissions', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name must not exceed 255 characters.',

            'surname.string' => 'The surname must be a valid string.',
            'surname.max' => 'The surname must not exceed 255 characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already in use.',

            'phone.string' => 'The phone number must be a valid string.',
            'phone.max' => 'The phone number must not exceed 10 characters.',
            'phone.unique' => 'This phone number is already in use.',

            'role.required' => 'The role field is required.',
            'role.exists' => 'The selected role is invalid.',

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
