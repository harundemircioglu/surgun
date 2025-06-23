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
            'accesion_notebook_id.required' => 'The accession notebook field is required.',
            'accesion_notebook_id.exists' => 'The selected accession notebook is invalid.',

            'quantity.required' => 'The quantity field is required.',
            'quantity.json' => 'The quantity must be a valid JSON string.',

            'seed_cabinet_id.required' => 'The seed cabinet field is required.',
            'seed_cabinet_id.exists' => 'The selected seed cabinet is invalid.',
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
