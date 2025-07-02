<?php

namespace Modules\Plant\App\Http\Requests\Import;

use Illuminate\Foundation\Http\FormRequest;

class AccessionNotebookImportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:xlsx', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Dosya alanı zorunludur.',
            'file.file' => 'Geçerli bir dosya yüklemelisiniz.',
            'file.mimes' => 'Yalnızca .xlsx uzantılı dosyalar kabul edilir.',
            'file.max' => 'Dosya boyutu en fazla 4 MB (4096 KB) olabilir.',
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
