<?php

namespace Modules\Plant\App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeedBankRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'accesion_notebook_id' => ['required', Rule::exists('accesion_notebooks', 'id')],
            'quantity' => ['required', 'json'],
            'seed_cabinet_id' => ['required', Rule::exists('seed_cabinets', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'accesion_notebook_id.required' => 'Kayıt defteri alanı zorunludur.',
            'accesion_notebook_id.exists' => 'Seçilen kayıt defteri geçersiz.',

            'quantity.required' => 'Miktar alanı zorunludur.',
            'quantity.json' => 'Miktar geçerli bir JSON dizgesi olmalıdır.',

            'seed_cabinet_id.required' => 'Tohum dolabı alanı zorunludur.',
            'seed_cabinet_id.exists' => 'Seçilen tohum dolabı geçersiz.',
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
