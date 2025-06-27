<?php

namespace Modules\Plant\App\Http\Requests\Create;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeedCabinetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', Rule::unique('seed_cabinets', 'code')],
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kod alanı zorunludur.',
            'code.string' => 'Kod geçerli bir metin olmalıdır.',
            'code.max' => 'Kod 255 karakteri geçmemelidir.',
            'code.unique' => 'Bu kod zaten kullanılmış.',

            'description.required' => 'Açıklama alanı zorunludur.',
            'description.string' => 'Açıklama geçerli bir metin olmalıdır.',
            'description.max' => 'Açıklama 255 karakteri geçmemelidir.',
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
