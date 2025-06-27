<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Plant\App\Http\Requests\Create\SeedCabinetRequest;
use Modules\Plant\App\Models\SeedCabinet;

class SeedCabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search ?? null;

        $seedCabinets = SeedCabinet::where('status', 1)
            ->when($search, function ($query) use ($search) {
                $query->where('code', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->paginate(20);

        return view('plant::seedCabinet.index', compact('seedCabinets'));
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
    public function store(SeedCabinetRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            SeedCabinet::create($data);
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
    public function update(\Modules\Plant\App\Http\Requests\Update\SeedCabinetRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $seedCabinet = SeedCabinet::find($id);

        if (!$seedCabinet) {
            return redirect()->back()->with(['error' => 'Veri bulunamadı.']);
        }

        DB::transaction(function () use ($seedCabinet, $data) {
            $seedCabinet->update($data);
        });

        return redirect()->back()->with(['success' => 'Güncelleme işlemi başarılı']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seedCabinet = SeedCabinet::find($id);

        if (!$seedCabinet) {
            return redirect()->back()->with(['error' => 'Veri bulunamadı']);
        }

        DB::transaction(function () use ($seedCabinet) {
            $seedCabinet->delete();
        });

        return redirect()->back()->with(['success' => 'Silme işlemi başarılı']);
    }
}
