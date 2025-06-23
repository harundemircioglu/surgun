<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Plant\App\Http\Requests\Create\AccessionNotebookRequest;
use Modules\Plant\App\Models\AccesionNotebook;

class AccessionNotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('plant::index');
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
        $data['accesion_number'] = now()->toDateString() . '-' . uniqid();
        AccesionNotebook::create($data);

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

        $accesionNotebook->update($data);

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

        $accesionNotebook->delete();

        return redirect()->back()->with(['success' => 'Accession Notebook deleted successfully']);
    }
}
