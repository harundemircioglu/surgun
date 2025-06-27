<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Plant\App\Http\Requests\Create\PlantStatusRequest;
use Modules\Plant\App\Models\AccesionNotebook;
use Modules\Plant\App\Models\GardenLocation;
use Modules\Plant\App\Models\PlantStatus;

class PlantStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search ?? null;

        $plantStatuses = PlantStatus::where('status', 1)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('accesionNotebook', function ($query) use ($search) {
                    $query->where('accesion_number', 'LIKE', "%{$search}%")
                        ->orWhere('plant_name', 'LIKE', "%{$search}%");
                })->orWhereHas('gardeLocation', function ($query) use ($search) {
                    $query->where('code', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            })
            ->with([
                'accesionNotebook',
                'gardeLocation',
            ])
            ->paginate(10);

        $accesionNotebooks = AccesionNotebook::select(['id', 'plant_name'])
            ->where('status', 1)
            ->get();

        $gardenLocations = GardenLocation::select(['id', 'code'])
            ->where('status', 1)
            ->get();

        return view('plant::plantStatus.index', compact('plantStatuses', 'accesionNotebooks', 'gardenLocations'));
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
    public function store(PlantStatusRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            PlantStatus::create($data);
        });

        return back()->with(['success' => 'Plant status created successfully.']);
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
    public function update(\Modules\Plant\App\Http\Requests\Update\PlantStatusRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $plantStatus = PlantStatus::find($id);

        if (!$plantStatus) {
            return back()->with(['error' => 'Plant status not found.']);
        }

        DB::transaction(function () use ($plantStatus, $data) {
            $plantStatus->update($data);
        });

        return back()->with(['success' => 'Plant status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plantStatus = PlantStatus::find($id);

        if (!$plantStatus) {
            return back()->with(['error' => 'Plant status not found.']);
        }

        DB::transaction(function () use ($plantStatus) {
            $plantStatus->delete();
        });

        return back()->with(['success' => 'Plant status deleted successfully.']);
    }
}
