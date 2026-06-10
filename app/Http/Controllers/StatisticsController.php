<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        $petsPerMonth = Pet::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $monthLabels = $petsPerMonth->map(fn($row) =>
            Carbon::create($row->year, $row->month)->format('M Y')
        );
        $monthData = $petsPerMonth->pluck('total');

        $animalTypes = Pet::select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->orderByDesc('total')
            ->get();

        $topDiagnoses = Report::select('diagnosis', DB::raw('COUNT(*) as total'))
            ->whereNotNull('diagnosis')
            ->groupBy('diagnosis')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $reportStatus = Report::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        $summary = [
            'total_pets'     => Pet::count(),
            'this_month'     => Pet::whereMonth('created_at', now()->month)->count(),
            'total_reports'  => Report::count(),
            'done_reports'   => Report::where('status', 'done')->count(),
        ];

        return view('statistics.index', compact(
            'monthLabels', 'monthData',
            'animalTypes', 'topDiagnoses',
            'reportStatus', 'summary'
        ));
    }
}
