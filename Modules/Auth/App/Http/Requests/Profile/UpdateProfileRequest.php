<?php

namespace Modules\Auth\App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
            'phone' => ['nullable', 'string', 'max:10', Rule::unique('users', 'phone')->ignore(auth()->id())],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı zorunludur.',
            'name.string' => 'İsim geçerli bir metin olmalıdır.',
            'name.max' => 'İsim en fazla 255 karakter olabilir.',

            'surname.string' => 'Soyisim geçerli bir metin olmalıdır.',
            'surname.max' => 'Soyisim en fazla 255 karakter olabilir.',

            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanımda.',

            'phone.string' => 'Telefon numarası geçerli bir metin olmalıdır.',
            'phone.max' => 'Telefon numarası en fazla 10 karakter olabilir.',
            'phone.unique' => 'Bu telefon numarası zaten kullanımda.',
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
