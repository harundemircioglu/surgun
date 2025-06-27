<?php

namespace Modules\Plant\App\Http\Requests\Create;

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
            'accesion_notebook_id.required' => 'Erişim defteri alanı zorunludur.',
            'accesion_notebook_id.exists' => 'Seçilen erişim defteri geçersiz.',

            'observation_date.required' => 'Gözlem tarihi alanı zorunludur.',
            'observation_date.date' => 'Gözlem tarihi geçerli bir tarih olmalıdır.',

            'garden_location_id.required' => 'Bahçe konumu alanı zorunludur.',
            'garden_location_id.exists' => 'Seçilen bahçe konumu geçersiz.',

            'plant_status.required' => 'Bitki durumu alanı zorunludur.',
            'plant_status.integer' => 'Bitki durumu bir tam sayı olmalıdır.',
            'plant_status.in' => 'Seçilen bitki durumu geçersiz. İzin verilen değerler 1, 2, 3 veya 4\'tür.',

            'vegetation_status.required' => 'Vejetasyon durumu alanı zorunludur.',
            'vegetation_status.string' => 'Vejetasyon durumu geçerli bir metin olmalıdır.',
            'vegetation_status.max' => 'Vejetasyon durumu 255 karakteri geçmemelidir.',

            'observation.required' => 'Gözlem alanı zorunludur.',
            'observation.string' => 'Gözlem geçerli bir metin olmalıdır.',
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
