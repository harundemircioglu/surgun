<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Auth\App\Models\User;
use Modules\Plant\App\Models\PlantMaterial;
use Modules\Plant\App\Models\PlantStatus;
use Modules\Plant\App\Models\SeedBank;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', [2, 3])->count();
        $materials = PlantMaterial::where('status', 1)->count();
        $seedBanks = SeedBank::where('status', 1)->count();
        $plantStatuses = PlantStatus::where('status', 1)->count();

        return view('dashboard::index', compact('users', 'materials', 'seedBanks', 'plantStatuses'));
    }
}
