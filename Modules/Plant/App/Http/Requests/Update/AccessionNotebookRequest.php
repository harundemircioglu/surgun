<?php

namespace Modules\Plant\App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccessionNotebookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'plant_name' => ['required', 'string', 'max:255'],
            'plant_material_id' => ['required', Rule::exists('plant_materials', 'id')],
            'plant_origin_id' => ['required', Rule::exists('plant_origins', 'id')],
            'location' => ['required', 'string', 'max:255'],
            'coordinate' => ['required', 'string', 'max:255'],
            'convening_date' => ['required', 'date'],
            'user_id' => ['required', Rule::exists('users', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'plant_name.required' => 'The plant name field is required.',
            'plant_name.string' => 'The plant name must be a valid string.',
            'plant_name.max' => 'The plant name must not exceed 255 characters.',

            'plant_material_id.required' => 'The plant material field is required.',
            'plant_material_id.exists' => 'The selected plant material is invalid.',

            'plant_origin_id.required' => 'The plant origin field is required.',
            'plant_origin_id.exists' => 'The selected plant origin is invalid.',

            'location.required' => 'The location field is required.',
            'location.string' => 'The location must be a valid string.',
            'location.max' => 'The location must not exceed 255 characters.',

            'coordinate.required' => 'The coordinate field is required.',
            'coordinate.string' => 'The coordinate must be a valid string.',
            'coordinate.max' => 'The coordinate must not exceed 255 characters.',

            'convening_date.required' => 'The convening date field is required.',
            'convening_date.date' => 'The convening date must be a valid date.',

            'user_id.required' => 'The user field is required.',
            'user_id.exists' => 'The selected user is invalid.',
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
