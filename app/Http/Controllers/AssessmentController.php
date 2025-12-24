<?php

namespace App\Http\Controllers;

use App\Models\Inmate;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Models\ObservationItem;
use App\Models\DailyObservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Assessment::with(['inmate', 'creator'])
            ->whereHas('inmate', function($q) {
                $q->where('prison_id', Auth::user()->prison_id);
            });

        // Filter by month/year
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $query->where('month', $month)->where('year', $year);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $assessments = $query->latest()->paginate(15);

        return view('assessments.index', compact('assessments', 'month', 'year'));
    }

    public function create(Request $request)
    {
        $inmateId = $request->get('inmate_id');
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $inmate = Inmate::findOrFail($inmateId);

        // Check if assessment already exists
        $existing = Assessment::where('inmate_id', $inmateId)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        if ($existing) {
            return redirect()->route('assessments.edit', $existing)
                ->with('info', 'Penilaian sudah ada, silakan edit penilaian yang sudah ada');
        }

        // Get observation items grouped by variable and aspect
        $observations = ObservationItem::active()
            ->orderBy('sort_order')
            ->get()
            ->groupBy('variable');

        return view('assessments.create', compact('inmate', 'month', 'year', 'observations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inmate_id' => 'required|exists:inmates,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020',
            'observations' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            // Create assessment
            $assessment = Assessment::create([
                'inmate_id' => $validated['inmate_id'],
                'prison_id' => Auth::user()->prison_id,
                'month' => $validated['month'],
                'year' => $validated['year'],
                'status' => 'draft',
                'created_by' => Auth::id(),
            ]);

            // Save daily observations
            foreach ($request->observations as $itemId => $days) {
                foreach ($days as $day => $isChecked) {
                    DailyObservation::create([
                        'assessment_id' => $assessment->id,
                        'observation_item_id' => $itemId,
                        'day' => $day,
                        'is_checked' => $isChecked ? true : false,
                    ]);
                }
            }

            // Calculate scores
            $assessment->calculateScores();

            DB::commit();

            return redirect()->route('assessments.show', $assessment)
                ->with('success', 'Penilaian berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Assessment $assessment)
    {
        $this->authorize('view', $assessment);

        $assessment->load(['inmate', 'dailyObservations.observationItem', 'scores', 'signatures']);

        // Group observations by aspect
        $observations = $assessment->dailyObservations
            ->groupBy(function($item) {
                return $item->observationItem->variable;
            });

        return view('assessments.show', compact('assessment', 'observations'));
    }

    public function edit(Assessment $assessment)
    {
        $this->authorize('update', $assessment);

        if (!$assessment->canBeEdited()) {
            return back()->with('error', 'Penilaian tidak dapat diedit');
        }

        $inmate = $assessment->inmate;
        $month = $assessment->month;
        $year = $assessment->year;

        // Get observation items
        $observations = ObservationItem::active()
            ->orderBy('sort_order')
            ->get()
            ->groupBy('variable');

        // Get existing daily observations
        $existingObservations = $assessment->dailyObservations()
            ->get()
            ->mapWithKeys(function($obs) {
                return ["{$obs->observation_item_id}_{$obs->day}" => $obs->is_checked];
            });

        return view('assessments.edit', compact('assessment', 'inmate', 'month', 'year', 'observations', 'existingObservations'));
    }

    public function update(Request $request, Assessment $assessment)
    {
        $this->authorize('update', $assessment);

        if (!$assessment->canBeEdited()) {
            return back()->with('error', 'Penilaian tidak dapat diedit');
        }

        $validated = $request->validate([
            'observations' => 'required|array',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Delete existing observations
            $assessment->dailyObservations()->delete();

            // Save new observations
            foreach ($request->observations as $itemId => $days) {
                foreach ($days as $day => $isChecked) {
                    DailyObservation::create([
                        'assessment_id' => $assessment->id,
                        'observation_item_id' => $itemId,
                        'day' => $day,
                        'is_checked' => $isChecked ? true : false,
                    ]);
                }
            }

            // Update notes
            $assessment->update(['notes' => $request->notes]);

            // Recalculate scores
            $assessment->calculateScores();

            DB::commit();

            return redirect()->route('assessments.show', $assessment)
                ->with('success', 'Penilaian berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function submit(Assessment $assessment)
    {
        $this->authorize('update', $assessment);

        if (!$assessment->canBeSubmitted()) {
            return back()->with('error', 'Penilaian tidak dapat disubmit');
        }

        $assessment->update([
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        return back()->with('success', 'Penilaian berhasil disubmit dan menunggu persetujuan');
    }

    public function approve(Assessment $assessment)
    {
        $this->authorize('approve', $assessment);

        if (!$assessment->canBeApproved()) {
            return back()->with('error', 'Penilaian tidak dapat disetujui');
        }

        $assessment->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Penilaian berhasil disetujui');
    }

    public function reject(Request $request, Assessment $assessment)
    {
        $this->authorize('approve', $assessment);

        if (!$assessment->canBeApproved()) {
            return back()->with('error', 'Penilaian tidak dapat ditolak');
        }

        $assessment->update([
            'status' => 'rejected',
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Penilaian ditolak');
    }

    public function exportPdf(Assessment $assessment)
    {
        $this->authorize('view', $assessment);

        // Load relationships
        $assessment->load([
            'inmate.prison',
            'dailyObservations.observationItem',
            'scores',
            'signatures'
        ]);

        // Generate PDF logic

        return view('assessments.pdf', compact('assessment'));
    }
}
