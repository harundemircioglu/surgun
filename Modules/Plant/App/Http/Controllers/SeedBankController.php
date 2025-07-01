<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Plant\App\Http\Requests\Create\SeedBankRequest;
use Modules\Plant\App\Models\AccesionNotebook;
use Modules\Plant\App\Models\SeedBank;
use Modules\Plant\App\Models\SeedCabinet;

class SeedBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search ?? null;

        $seedBanks = SeedBank::where('status', 1)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('accessionNotebook', function ($q) use ($search) {
                    $q->where('plant_name', 'LIKE', "%{$search}%");
                })
                    ->orWhereHas('seedCabinet', function ($q) use ($search) {
                        $q->where('code', 'LIKE', "%{$search}%");
                    });
            })
            ->with(
                [
                    'accessionNotebook',
                    'seedCabinet',
                ]
            )
            ->paginate(20);

        $accesionNotebooks = AccesionNotebook::select(['id', 'plant_name'])
            ->where('status', 1)
            ->get();

        $seedCabinets = SeedCabinet::select(['id', 'code'])
            ->where('status', 1)
            ->get();

        return view('plant::seedBank.index', compact('seedBanks', 'accesionNotebooks', 'seedCabinets'));
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
    public function store(SeedBankRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            SeedBank::create($data);
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
    public function update(\Modules\Plant\App\Http\Requests\Update\SeedBankRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $seedBank = SeedBank::find($id);

        if (!$seedBank) {
            return redirect()->back()->with(['error' => 'Veri bulunamadı']);
        }

        DB::transaction(function () use ($seedBank, $data) {
            $seedBank->update($data);
        });

        return redirect()->back()->with(['success' => 'Güncelleme işlemi başarılı']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seedBank = SeedBank::find($id);

        if (!$seedBank) {
            return redirect()->back()->with(['error' => 'Veri bulunamadı']);
        }

        DB::transaction(function () use ($seedBank) {
            $seedBank->delete();
        });

        return redirect()->back()->with(['success' => 'Silme işlemi başarılı']);
    }
}
