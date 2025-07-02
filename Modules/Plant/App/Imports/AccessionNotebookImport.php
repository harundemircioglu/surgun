<?php

namespace Modules\Plant\App\Imports;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Modules\Plant\App\Models\AccesionNotebook;
use Modules\Plant\App\Models\PlantMaterial;
use Modules\Plant\App\Models\PlantOrigin;
class AccessionNotebookImport implements ToModel, WithChunkReading, ShouldQueue, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use Queueable, Importable, SkipsFailures, SkipsErrors;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function model(array $row)
    {
        $material = PlantMaterial::where('name', $row['materyal'])->first();
        $origin = PlantOrigin::where('name', $row['koken'])->first();
        $date = Carbon::parse($row['toplanma_tarihi'])->format('Y-m-d') ?? now()->toDateString();

        return new AccesionNotebook([
            'accesion_number' => Carbon::now()->format('Y') . '-' . uniqid(),
            'plant_name' => $row['bitki_adi'],
            'plant_material_id' => $material->id,
            'plant_origin_id' => $origin->id,
            'location' => $row['lokasyon'],
            'coordinate' => $row['koordinat'],
            'convening_date' => $date,
            'user_id' => $this->user->id,
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            'bitki_adi' => ['required', Rule::unique('accesion_notebooks', 'plant_name')],
            'materyal' => ['required', Rule::exists('plant_materials', 'name')],
            'koken' => ['required', Rule::exists('plant_origins', 'name')],
            'lokasyon' => ['required', 'string'],
            'koordinat' => ['required', 'string'],
            'toplanma_tarihi' => ['required'],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            'bitki_adi' => 'Bitki Adı',
            'materyal' => 'Materyal',
            'koken' => 'Köken',
            'lokasyon' => 'Lokasyon',
            'koordinat' => 'Koordinat',
            'toplanma_tarihi' => 'Toplanma Tarihi',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'bitki_adi.required' => ':attribute alanı zorunludur.',
            'bitki_adi.unique' => ':attribute zaten sistemde mevcut.',

            'materyal.required' => ':attribute alanı zorunludur.',
            'materyal.exists' => 'Seçilen :attribute veritabanında bulunamadı.',

            'koken.required' => ':attribute alanı zorunludur.',
            'koken.exists' => 'Seçilen :attribute veritabanında bulunamadı.',

            'lokasyon.required' => ':attribute alanı zorunludur.',
            'lokasyon.string' => ':attribute metin formatında olmalıdır.',

            'koordinat.required' => ':attribute alanı zorunludur.',
            'koordinat.string' => ':attribute metin formatında olmalıdır.',

            'toplanma_tarihi.required' => ':attribute alanı zorunludur.',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $errors = [];

        foreach ($failures as $failure) {
            $errors[] = [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors(),
            ];

            \Log::warning("Satır: {$failure->row()}, Sütun: {$failure->attribute()}, Hatalar: " . implode(', ', $failure->errors()));
        }

        // ! errors array değil de collection ile mail gönderilmeli
    }

    public function onError(\Throwable $e)
    {
        Log::error("İçe aktarma sırasında bir hata oluştu: " . $e->getMessage());
    }
}
