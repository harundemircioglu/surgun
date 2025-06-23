<?php

namespace Modules\Plant\App\Http\Requests\Create;

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
            'code' => ['required', 'string', 'max:255', Rule::unique('garden_locations', 'code')],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a valid string.',
            'description.max' => 'The description must not exceed 255 characters.',

            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a valid string.',
            'code.max' => 'The code must not exceed 255 characters.',
            'code.unique' => 'The code has already been taken.',
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
