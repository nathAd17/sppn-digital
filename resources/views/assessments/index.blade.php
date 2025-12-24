@extends('layouts.app')

@section('title', 'Daftar Penilaian')
@section('page-title', 'Daftar Penilaian')

@section('content')
<div class="space-y-6">
    {{-- Header & Filter --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Daftar Penilaian</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola penilaian pembinaan narapidana</p>
        </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-lg shadow p-4">
        <form method="GET" action="{{ route('assessments.index') }}" class="flex flex-col md:flex-row gap-4">
            <select name="month" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @for($m = 1; $m <= 12; $m++)
                    @php
                        $monthName = \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM');
                    @endphp
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ $monthName }}</option>
                @endfor
            </select>

            <select name="year" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>

            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>

            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                Filter
            </button>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Narapidana</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Skor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dinilai Oleh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($assessments as $assessment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div>
                            <div class="text-sm font-medium text-gray-800">{{ $assessment->inmate->name }}</div>
                            <div class="text-xs text-gray-500">{{ $assessment->inmate->registration_number }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $assessment->period }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($assessment->status === 'approved') bg-green-100 text-green-800
                            @elseif($assessment->status === 'submitted') bg-yellow-100 text-yellow-800
                            @elseif($assessment->status === 'rejected') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($assessment->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-blue-600">
                            {{ $assessment->total_score ? number_format($assessment->total_score, 2) : '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $assessment->creator->name }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('assessments.show', $assessment) }}" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            @if($assessment->canBeEdited())
                            <a href="{{ route('assessments.edit', $assessment) }}" class="text-yellow-600 hover:text-yellow-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Tidak ada data penilaian untuk periode ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($assessments->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $assessments->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
