<?php

namespace Modules\Auth\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi girin.',
            'email.exists' => 'Girilen e-posta sistemimizde kayıtlı değil.',

            'password.required' => 'Şifre alanı zorunludur.',
            'password.string' => 'Şifre geçerli bir metin olmalıdır.',
        ];
    }
}
