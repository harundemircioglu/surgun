<?php

namespace Modules\Plant\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Plant\App\Http\Requests\Create\SeedBankRequest;
use Modules\Plant\App\Models\SeedBank;

class SeedBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seedBanks = SeedBank::where('status', 1)
            ->with(
                [
                    'accessionNotebook',
                    'seedCabinet',
                ]
            )
            ->paginate(20);

        return view('plant::seedBank.index', compact('seedBanks'));
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
        SeedBank::create($data);

        return redirect()->back()->with(['success' => 'Seed Bank created successfully']);
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
            return redirect()->back()->with(['error' => 'Seed Bank not found']);
        }

        $seedBank->update($data);

        return redirect()->back()->with(['success' => 'Seed Bank updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seedBank = SeedBank::find($id);

        if (!$seedBank) {
            return redirect()->back()->with(['error' => 'Seed Bank not found']);
        }

        $seedBank->delete();

        return redirect()->back()->with(['success' => 'Seed Bank deleted successfully']);
    }
}
