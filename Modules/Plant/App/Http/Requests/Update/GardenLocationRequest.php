<?php

namespace Modules\Plant\App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GardenLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', Rule::unique('garden_locations', 'code')->ignore($this->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'Açıklama alanı zorunludur.',
            'description.string' => 'Açıklama geçerli bir metin olmalıdır.',
            'description.max' => 'Açıklama 255 karakteri geçmemelidir.',

            'code.required' => 'Kod alanı zorunludur.',
            'code.string' => 'Kod geçerli bir metin olmalıdır.',
            'code.max' => 'Kod 255 karakteri geçmemelidir.',
            'code.unique' => 'Bu kod zaten kullanılmıştır.',
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
