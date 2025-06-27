<?php

namespace Modules\Plant\App\Http\Requests\Create;

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
        ];
    }

    public function messages(): array
    {
        return [
            'plant_name.required' => 'Bitki adı alanı zorunludur.',
            'plant_name.string' => 'Bitki adı geçerli bir metin olmalıdır.',
            'plant_name.max' => 'Bitki adı 255 karakteri geçmemelidir.',

            'plant_material_id.required' => 'Bitki materyali alanı zorunludur.',
            'plant_material_id.exists' => 'Seçilen bitki materyali geçersiz.',

            'plant_origin_id.required' => 'Bitki menşei alanı zorunludur.',
            'plant_origin_id.exists' => 'Seçilen bitki menşei geçersiz.',

            'location.required' => 'Konum alanı zorunludur.',
            'location.string' => 'Konum geçerli bir metin olmalıdır.',
            'location.max' => 'Konum 255 karakteri geçmemelidir.',

            'coordinate.required' => 'Koordinat alanı zorunludur.',
            'coordinate.string' => 'Koordinat geçerli bir metin olmalıdır.',
            'coordinate.max' => 'Koordinat 255 karakteri geçmemelidir.',

            'convening_date.required' => 'Toplanma tarihi alanı zorunludur.',
            'convening_date.date' => 'Toplanma tarihi geçerli bir tarih olmalıdır.',
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
