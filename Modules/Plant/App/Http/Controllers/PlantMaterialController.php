<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Plant\App\Http\Requests\Create\PlantMaterialRequest;
use Modules\Plant\App\Models\PlantMaterial;

class PlantMaterialController extends Controller
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
    public function store(PlantMaterialRequest $request): RedirectResponse
    {
        $data = $request->validated();
        PlantMaterial::create($data);

        return back()->with(['success' => 'Plant material created successfully.']);
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
    public function update(\Modules\Plant\App\Http\Requests\Update\PlantMaterialRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $plantMaterial = PlantMaterial::find($id);

        if (!$plantMaterial) {
            return back()->with(['error' => 'Plant material not found.']);
        }

        $plantMaterial->update($data);

        return back()->with(['success' => 'Plant material updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plantMaterial = PlantMaterial::find($id);

        if (!$plantMaterial) {
            return back()->with(['error' => 'Plant material not found.']);
        }

        $plantMaterial->delete();

        return back()->with(['success' => 'Plant material deleted successfully.']);
    }
}
