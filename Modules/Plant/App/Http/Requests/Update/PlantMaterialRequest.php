<?php

namespace Modules\Plant\App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlantMaterialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('plant_materials')->ignore($this->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı zorunludur.',
            'name.string' => 'İsim geçerli bir metin olmalıdır.',
            'name.max' => 'İsim 255 karakteri geçmemelidir.',
            'name.unique' => 'Bu isim zaten kullanılmış.',
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
