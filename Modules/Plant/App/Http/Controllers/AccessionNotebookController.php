<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Plant\App\Emails\AccessionNotebookAfterExport;
use Modules\Plant\App\Emails\AccessionNotebookAfterImport;
use Modules\Plant\App\Exports\AccessionNotebookExport;
use Modules\Plant\App\Http\Requests\Create\AccessionNotebookRequest;
use Modules\Plant\App\Http\Requests\Export\AccessionNotebookExportRequest;
use Modules\Plant\App\Http\Requests\Import\AccessionNotebookImportRequest;
use Modules\Plant\App\Imports\AccessionNotebookImport;
use Modules\Plant\App\Models\AccesionNotebook;
use Modules\Plant\App\Models\PlantMaterial;
use Modules\Plant\App\Models\PlantOrigin;

class AccessionNotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search ?? null;

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
            ->paginate(20);

        $plantMaterials = PlantMaterial::select(['id', 'name'])
            ->where('status', 1)
            ->get();

        $plantOrigins = PlantOrigin::select(['id', 'name'])
            ->where('status', 1)
            ->get();

        return view('plant::accesionNotebook.index', compact('accesionNotebooks', 'plantMaterials', 'plantOrigins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plant::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccessionNotebookRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['accesion_number'] = Carbon::now()->format('Y') . '-' . uniqid();
        $data['user_id'] = auth()->id();

        DB::transaction(function () use ($data) {
            AccesionNotebook::create($data);
        });

        return redirect()->back()->with(['success' => 'Ekleme işlemi başarılı']);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('plant::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('plant::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Modules\Plant\App\Http\Requests\Update\AccessionNotebookRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $accesionNotebook = AccesionNotebook::find($id);

        if (!$accesionNotebook) {
            return redirect()->back()->with(['error' => 'Veri bulunamadı']);
        }

        DB::transaction(function () use ($accesionNotebook, $data) {
            $accesionNotebook->update($data);
        });

        return redirect()->back()->with(['success' => 'Güncelleme işlemi başarılı']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $accesionNotebook = AccesionNotebook::find($id);

        if (!$accesionNotebook) {
            return redirect()->back()->with(['error' => 'Veri bulunamadı']);
        }

        DB::transaction(function () use ($accesionNotebook) {
            $accesionNotebook->delete();
        });

        return redirect()->back()->with(['success' => 'Silme işlemi başarılı']);
    }

    public function export(AccessionNotebookExportRequest $request)
    {
        $search = $request->search ?? null;

        $user = auth()->user();

        $filename = 'accession_notebook_' . $user->id . '_' . now()->format('Ymd_His') . '.xlsx';

        $filePath = 'storage/' . $filename;

        try {
            (new AccessionNotebookExport($search))->queue($filename, 'public');
        } catch (\Throwable $th) {
            Log::info($th);
            return back()->with('error', 'Dışa aktarma işleminde hata oluştu!');
        }

        return back()->with('success', 'Dışa aktarma sıraya eklendi.');
    }

    public function import(AccessionNotebookImportRequest $request)
    {
        $file = $request->file('file');

        $user = auth()->user();

        try {
            (new AccessionNotebookImport($user))->queue($file);
        } catch (\Throwable $th) {
            Log::info($th);
            return back()->with('error', 'İçe aktarma işleminde hata oluştu!');
        }

        return back()->with('success', 'İçe aktarma sıraya eklendi.');
    }
}
