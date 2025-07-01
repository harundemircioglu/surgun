<?php

namespace Modules\Plant\App\Http\Requests\Export;

use Illuminate\Foundation\Http\FormRequest;

class AccessionNotebookExportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => 'Arama ifadesi geçerli bir metin olmalıdır.',
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
