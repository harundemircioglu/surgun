<?php

namespace Modules\Plant\App\Http\Requests\Update;

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
            'code' => ['required', 'string', 'max:255', Rule::unique('seed_cabinets', 'code')->ignore($this->id)],
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a valid string.',
            'code.max' => 'The code must not exceed 255 characters.',
            'code.unique' => 'The code has already been taken.',

            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a valid string.',
            'description.max' => 'The description must not exceed 255 characters.',
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
