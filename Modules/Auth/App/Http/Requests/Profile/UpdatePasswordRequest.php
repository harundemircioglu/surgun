<?php

namespace Modules\Auth\App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Mevcut şifre alanı zorunludur.',
            'current_password.current_password' => 'Mevcut şifre hatalı.',

            'password.required' => 'Yeni şifre alanı zorunludur.',
            'password.string' => 'Yeni şifre geçerli bir metin olmalıdır.',
            'password.min' => 'Yeni şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Yeni şifre doğrulaması eşleşmiyor.',
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
