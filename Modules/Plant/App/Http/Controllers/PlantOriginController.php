<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Plant\App\Http\Requests\Create\PlantOriginRequest;
use Modules\Plant\App\Models\PlantOrigin;

class PlantOriginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search ?? null;

        $plantOrigins = PlantOrigin::where('status', 1)
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->paginate(20);

        return view('plant::plantOrigin.index', compact('plantOrigins'));
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
    public function store(PlantOriginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            PlantOrigin::create($data);
        });

        return back()->with(['success' => 'Ekleme işlemi başarılı']);
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
    public function update(\Modules\Plant\App\Http\Requests\Update\PlantOriginRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $plantOrigin = PlantOrigin::find($id);

        if (!$plantOrigin) {
            return back()->with(['error' => 'Veri bulunamadı']);
        }

        DB::transaction(function () use ($plantOrigin, $data) {
            $plantOrigin->update($data);
        });

        return back()->with(['success' => 'Güncelleme işlemi başarılı']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plantOrigin = PlantOrigin::find($id);

        if (!$plantOrigin) {
            return back()->with(['error' => 'Veri bulunamadı']);
        }

        DB::transaction(function () use ($plantOrigin) {
            $plantOrigin->delete();
        });

        return back()->with(['success' => 'Silme işlemi bulunamadı']);
    }
}
