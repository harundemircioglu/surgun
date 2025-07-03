<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Plant\App\Models\AccesionNotebook;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard::charts');
    }

    public function getAccessionNotebookData(Request $request)
    {
        $request->validate([
            'period' => ['required', 'integer', 'in:1,2,3,4,5'],
        ]);

        $period = $request->period;

        $today = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        if ($period == 1) {
            $startDate = $today->copy()->subDay()->startOfDay();
            $endDate = $today->copy()->subDay()->endOfDay();
        } elseif ($period == 2) {
            $startDate = $today->copy()->startOfDay();
            $endDate = $today->copy()->endOfDay();
        } elseif ($period == 3) {
            $startDate = $today->copy()->subWeek()->startOfDay();
        } elseif ($period == 4) {
            $startDate = $today->copy()->subMonth()->startOfDay();
        } else {
            $startDate = $today->copy()->subMonths(3)->startOfDay();
        }

        $grouped = AccesionNotebook::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 1)
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });

        $period = CarbonPeriod::create($startDate, $endDate);
        $labels = [];
        $data = [];

        foreach ($period as $date) {
            $dateStr = $date->format('Y-m-d');
            $labels[] = $dateStr;
            $data[] = isset($grouped[$dateStr]) ? $grouped[$dateStr]->count() : 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
