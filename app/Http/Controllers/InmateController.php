<?php

namespace App\Http\Controllers;

use App\Models\Inmate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InmateController extends Controller
{
    public function index(Request $request)
    {
        $query = Inmate::where('prison_id', Auth::user()->prison_id)
            ->where('status', 'active');

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%");
            });
        }

        // Filter by crime type
        if ($request->has('crime_type') && $request->crime_type != '') {
            $query->where('crime_type', $request->crime_type);
        }

        // Filter by status
        if ($request->has('assessment_status') && $request->assessment_status != '') {
            $status = $request->assessment_status;
            $query->whereHas('assessments', function($q) use ($status) {
                $q->where('month', now()->month)
                  ->where('year', now()->year)
                  ->where('status', $status);
            });
        }

        $inmates = $query->with('latestAssessment')->paginate(15);

        return view('inmates.index', compact('inmates'));
    }

    public function create()
    {
        return view('inmates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|unique:inmates',
            'name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'religion' => 'required|string',
            'education_level' => 'nullable|string',
            'last_job' => 'nullable|string',
            'crime_type' => 'required|string',
            'sentence_length_months' => 'required|integer|min:1',
            'remaining_sentence_months' => 'required|integer|min:0',
            'entry_date' => 'required|date',
            'health_notes' => 'nullable|string',
        ]);

        $validated['prison_id'] = Auth::user()->prison_id;
        $validated['status'] = 'active';

        Inmate::create($validated);

        return redirect()->route('inmates.index')
            ->with('success', 'Data narapidana berhasil ditambahkan');
    }

    public function show(Inmate $inmate)
    {
        $this->authorize('view', $inmate);

        $assessments = $inmate->assessments()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(12);

        return view('inmates.show', compact('inmate', 'assessments'));
    }

    public function edit(Inmate $inmate)
    {
        $this->authorize('update', $inmate);

        return view('inmates.edit', compact('inmate'));
    }

    public function update(Request $request, Inmate $inmate)
    {
        $this->authorize('update', $inmate);

        $validated = $request->validate([
            'registration_number' => 'required|string|max:15',
            'name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'religion' => 'required|string',
            'education_level' => 'nullable|string',
            'last_job' => 'nullable|string',
            'crime_type' => 'required|string',
            'sentence_length_months' => 'required|integer|min:1',
            'remaining_sentence_months' => 'required|integer|min:0',
            'health_notes' => 'nullable|string',
        ]);

        $inmate->update($validated);

        return redirect()->route('inmates.show', $inmate->id)
            ->with('success', 'Data narapidana berhasil diperbarui');
    }

    public function destroy(Inmate $inmate)
    {
        $this->authorize('delete', $inmate);

        $inmate->delete();

        return redirect()->route('inmates.index')
            ->with('success', 'Data narapidana berhasil dihapus');
    }
}
