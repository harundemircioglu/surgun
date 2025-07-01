<?php

namespace Modules\Plant\App\Exports;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Plant\App\Models\AccesionNotebook;
use Maatwebsite\Excel\Events\AfterExport;

class AccessionNotebookExport implements FromCollection, WithMapping, WithHeadings
{
    use Queueable, Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $search = $this->search;

        $accesionNotebooks = AccesionNotebook::where('status', 1)
            ->when($search, function ($query) use ($search) {
                $query->where('accesion_number', 'LIKE', "%{$search}%")
                    ->orWhere('plant_name', 'LIKE', "%{$search}%");
            })
            ->with(
                [
                    'user',
                    'material',
                    'origin',
                ]
            )
            ->get();

        return $accesionNotebooks;
    }

    public function headings(): array
    {
        return [
            'AKSESYON NUMARASI',
            'BİTKİ ADI',
            'MATERYAL',
            'KÖKEN',
            'LOKASYON',
            'KOORDİNAT',
            'TOPLANMA TARİHİ',
            'TOPLAYICI',
        ];
    }

    public function map($row): array
    {
        return [
            $row->accesion_number,
            $row->plant_name,
            $row->material->name,
            $row->origin->name,
            $row->location,
            $row->coordinate,
            $row->convening_date,
            $row->user->name,
        ];
    }
}
