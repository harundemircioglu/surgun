<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Plant\App\Http\Requests\Create\AccessionNotebookRequest;
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
        $accesionNotebooks = AccesionNotebook::where('status', 1)
            ->with(
                [
                    'user',
                    'material',
                    'origin',
                ]
            )
            ->paginate(20);

        $plantMaterials = PlantMaterial::where('status', 1)->get();

        $plantOrigins = PlantOrigin::where('status', 1)->get();

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

        return redirect()->back()->with(['success' => 'Accession Notebook created successfully']);
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
            return redirect()->back()->with(['error' => 'Accession Notebook not found']);
        }

        DB::transaction(function () use ($accesionNotebook, $data) {
            $accesionNotebook->update($data);
        });

        return redirect()->back()->with(['success' => 'Accession Notebook updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $accesionNotebook = AccesionNotebook::find($id);

        if (!$accesionNotebook) {
            return redirect()->back()->with(['error' => 'Accession Notebook not found']);
        }

        DB::transaction(function () use ($accesionNotebook) {
            $accesionNotebook->delete();
        });

        return redirect()->back()->with(['success' => 'Accession Notebook deleted successfully']);
    }
}
