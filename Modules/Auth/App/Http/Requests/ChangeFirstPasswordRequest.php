<?php

namespace Modules\Auth\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeFirstPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Şifre alanı zorunludur.',
            'password.string' => 'Şifre geçerli bir metin olmalıdır.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Şifre doğrulaması eşleşmiyor.',
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
