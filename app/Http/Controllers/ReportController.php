<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function monthly(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $assessments = Assessment::with(['inmate'])
            ->whereHas('inmate', function($q) {
                $q->where('prison_id', Auth::user()->prison_id);
            })
            ->where('month', $month)
            ->where('year', $year)
            ->where('status', 'approved')
            ->get();

        $stats = [
            'total_assessed' => $assessments->count(),
            'avg_total_score' => $assessments->avg('total_score'),
            'avg_kepribadian' => $assessments->avg('score_kepribadian'),
            'avg_kemandirian' => $assessments->avg('score_kemandirian'),
            'avg_sikap' => $assessments->avg('score_sikap'),
            'avg_mental' => $assessments->avg('score_mental'),
        ];

        return view('reports.monthly', compact('assessments', 'stats', 'month', 'year'));
    }

    public function statistics(Request $request)
    {
        $year = $request->get('year', now()->year);

        // Get monthly averages
        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $avg = Assessment::whereHas('inmate', function($q) {
                    $q->where('prison_id', Auth::user()->prison_id);
                })
                ->where('month', $month)
                ->where('year', $year)
                ->where('status', 'approved')
                ->avg('total_score');

            $monthlyData[] = round($avg ?? 0, 2);
        }

        // Get distribution by category
        $distribution = [
            'sangat_baik' => Assessment::whereHas('inmate', function($q) {
                    $q->where('prison_id', Auth::user()->prison_id);
                })
                ->where('year', $year)
                ->where('total_score', '>=', 81)
                ->count(),

            'baik' => Assessment::whereHas('inmate', function($q) {
                    $q->where('prison_id', Auth::user()->prison_id);
                })
                ->where('year', $year)
                ->whereBetween('total_score', [61, 80])
                ->count(),

            'cukup' => Assessment::whereHas('inmate', function($q) {
                    $q->where('prison_id', Auth::user()->prison_id);
                })
                ->where('year', $year)
                ->whereBetween('total_score', [41, 60])
                ->count(),

            'kurang' => Assessment::whereHas('inmate', function($q) {
                    $q->where('prison_id', Auth::user()->prison_id);
                })
                ->where('year', $year)
                ->where('total_score', '<', 41)
                ->count(),
        ];

        return view('reports.statistics', compact('monthlyData', 'distribution', 'year'));
    }

    public function recommendations()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $eligibleInmates = Assessment::with(['inmate'])
            ->whereHas('inmate', function($q) {
                $q->where('prison_id', operator: Auth::user()->prison_id);
            })
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->where('status', 'approved')
            ->where('total_score', '>=', 75)
            ->get();

        return view('reports.recommendations', compact('eligibleInmates'));
    }
}
