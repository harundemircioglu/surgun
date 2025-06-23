<?php

namespace Modules\Plant\App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlantStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'accesion_notebook_id' => ['required', Rule::exists('accesion_notebooks', 'id')],
            'observation_date' => ['required', 'date'],
            'garden_location_id' => ['required', Rule::exists('garden_locations', 'id')],
            'plant_status' => ['required', 'integer', 'in:1,2,3,4'],
            'vegetation_status' => ['required', 'string', 'max:255'],
            'observation' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'accesion_notebook_id.required' => 'The accession notebook field is required.',
            'accesion_notebook_id.exists' => 'The selected accession notebook is invalid.',

            'observation_date.required' => 'The observation date field is required.',
            'observation_date.date' => 'The observation date must be a valid date.',

            'garden_location_id.required' => 'The garden location field is required.',
            'garden_location_id.exists' => 'The selected garden location is invalid.',

            'plant_status.required' => 'The plant status field is required.',
            'plant_status.integer' => 'The plant status must be an integer.',
            'plant_status.in' => 'The selected plant status is invalid. Allowed values are 1, 2, 3, or 4.',

            'vegetation_status.required' => 'The vegetation status field is required.',
            'vegetation_status.string' => 'The vegetation status must be a valid string.',
            'vegetation_status.max' => 'The vegetation status must not exceed 255 characters.',

            'observation.required' => 'The observation field is required.',
            'observation.string' => 'The observation must be a valid string.',
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
