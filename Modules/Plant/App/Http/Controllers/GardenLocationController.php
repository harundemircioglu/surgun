<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Plant\App\Http\Requests\Create\GardenLocationRequest;
use Modules\Plant\App\Models\GardenLocation;

class GardenLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search ?? null;

        $gardenLocations = GardenLocation::where('status', 1)
            ->when($search, function ($query) use ($search) {
                $query->where('code', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->paginate(20);

        return view('plant::gardenLocation.index', compact('gardenLocations'));
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
    public function store(GardenLocationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            GardenLocation::create($data);
        });

        return redirect()->back()->with(['success' => 'Garden Location created successfully']);
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
    public function update(\Modules\Plant\App\Http\Requests\Update\GardenLocationRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $gardenLocation = GardenLocation::find($id);

        if (!$gardenLocation) {
            return redirect()->back()->with(['error' => 'Garden Location not found']);
        }

        DB::transaction(function () use ($gardenLocation, $data) {
            $gardenLocation->update($data);
        });

        return redirect()->back()->with(['success' => 'Garden Location updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gardenLocation = GardenLocation::find($id);

        if (!$gardenLocation) {
            return redirect()->back()->with(['error' => 'Garden Location not found']);
        }

        DB::transaction(function () use ($gardenLocation) {
            $gardenLocation->delete();
        });

        return redirect()->back()->with(['success' => 'Garden Location deleted successfully']);
    }
}
