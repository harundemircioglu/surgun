<?php

namespace Modules\Auth\App\Http\Requests\Update;

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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->id)],
            'phone' => ['nullable', 'string', 'max:10', Rule::unique('users', 'phone')->ignore($this->id)],
            'role' => ['required', Rule::exists('roles', 'id')],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', Rule::exists('permissions', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı zorunludur.',
            'name.string' => 'İsim geçerli bir metin olmalıdır.',
            'name.max' => 'İsim 255 karakteri geçmemelidir.',

            'surname.string' => 'Soyisim geçerli bir metin olmalıdır.',
            'surname.max' => 'Soyisim 255 karakteri geçmemelidir.',

            'email.required' => 'Email alanı zorunludur.',
            'email.email' => 'Lütfen geçerli bir email adresi girin.',
            'email.unique' => 'Bu email zaten kullanılıyor.',

            'phone.string' => 'Telefon numarası geçerli bir metin olmalıdır.',
            'phone.max' => 'Telefon numarası 10 karakteri geçmemelidir.',
            'phone.unique' => 'Bu telefon numarası zaten kullanılıyor.',

            'role.required' => 'Rol alanı zorunludur.',
            'role.exists' => 'Seçilen rol geçersizdir.',

            'permissions.required' => 'Yetkiler alanı zorunludur.',
            'permissions.array' => 'Yetkiler bir dizi olmalıdır.',
            'permissions.*.required' => 'Her yetki zorunludur.',
            'permissions.*.exists' => 'Seçilen yetkilerden biri veya birkaçı geçersizdir.',
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
