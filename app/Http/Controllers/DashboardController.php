<?php

namespace App\Http\Controllers;

use App\Models\Inmate;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Stats
        $stats = [
            'total_inmates' => Inmate::where('prison_id', $user->prison_id)
                ->where('status', 'active')
                ->count(),

            'assessed_this_month' => Assessment::whereHas('inmate', function($q) use ($user) {
                    $q->where('prison_id', $user->prison_id);
                })
                ->where('month', $currentMonth)
                ->where('year', $currentYear)
                ->where('status', '!=', 'draft')
                ->count(),

            'needs_attention' => Assessment::whereHas('inmate', function($q) use ($user) {
                    $q->where('prison_id', $user->prison_id);
                })
                ->where('month', $currentMonth)
                ->where('year', $currentYear)
                ->where('total_score', '<', 60)
                ->count(),

            'avg_score' => Assessment::whereHas('inmate', function($q) use ($user) {
                    $q->where('prison_id', $user->prison_id);
                })
                ->where('month', $currentMonth)
                ->where('year', $currentYear)
                ->avg('total_score') ?? 0,
        ];

        // Recent assessments
        $recent_assessments = Assessment::with(['inmate', 'creator'])
            ->whereHas('inmate', function($q) use ($user) {
                $q->where('prison_id', $user->prison_id);
            })
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->latest()
            ->take(10)
            ->get();

        // Chart data - scores by variable
        $chart_data = [
            'labels' => ['Kepribadian', 'Kemandirian', 'Sikap', 'Mental'],
            'datasets' => [
                [
                    'label' => 'Rata-rata Skor',
                    'data' => [
                        Assessment::whereHas('inmate', function($q) use ($user) {
                            $q->where('prison_id', $user->prison_id);
                        })
                        ->where('month', $currentMonth)
                        ->where('year', $currentYear)
                        ->avg('score_kepribadian') ?? 0,

                        Assessment::whereHas('inmate', function($q) use ($user) {
                            $q->where('prison_id', $user->prison_id);
                        })
                        ->where('month', $currentMonth)
                        ->where('year', $currentYear)
                        ->avg('score_kemandirian') ?? 0,

                        Assessment::whereHas('inmate', function($q) use ($user) {
                            $q->where('prison_id', $user->prison_id);
                        })
                        ->where('month', $currentMonth)
                        ->where('year', $currentYear)
                        ->avg('score_sikap') ?? 0,

                        Assessment::whereHas('inmate', function($q) use ($user) {
                            $q->where('prison_id', $user->prison_id);
                        })
                        ->where('month', $currentMonth)
                        ->where('year', $currentYear)
                        ->avg('score_mental') ?? 0,
                    ]
                ]
            ]
        ];

        return view('dashboard', compact('stats', 'recent_assessments', 'chart_data'));
    }
}
