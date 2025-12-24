@extends('layouts.app')

@section('title', 'Detail Penilaian')
@section('page-title', 'Detail Penilaian')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <a href="{{ route('assessments.index') }}" class="text-blue-600 hover:text-blue-800 text-sm mb-2 inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Detail Penilaian</h1>
                <p class="text-sm text-gray-600 mt-1">Periode: {{ $assessment->period }}</p>
            </div>
            <div class="flex gap-2">
                @if($assessment->canBeEdited())
                <a href="{{ route('assessments.edit', $assessment) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg">
                    Edit
                </a>
                @endif
                @if($assessment->canBeSubmitted())
                <form method="POST" action="{{ route('assessments.submit', $assessment) }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        Submit untuk Approval
                    </button>
                </form>
                @endif
                @if($assessment->canBeApproved() && auth()->user()->canApproveAssessment())
                <form method="POST" action="{{ route('assessments.approve', $assessment) }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                        Approve
                    </button>
                </form>
                @endif
                <a href="{{ route('assessments.pdf', $assessment) }}" target="_blank" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>

        {{-- Inmate Info --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-gray-50 p-4 rounded-lg">
            <div>
                <p class="text-xs text-gray-500">Nama Narapidana</p>
                <p class="font-semibold text-gray-800">{{ $assessment->inmate->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">No. Register</p>
                <p class="font-semibold text-gray-800">{{ $assessment->inmate->registration_number }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">Tindak Pidana</p>
                <p class="font-semibold text-gray-800">{{ $assessment->inmate->crime_type }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">Status Penilaian</p>
                <span class="px-2 py-1 text-xs rounded-full
                    @if($assessment->status === 'approved') bg-green-100 text-green-800
                    @elseif($assessment->status === 'submitted') bg-yellow-100 text-yellow-800
                    @elseif($assessment->status === 'rejected') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($assessment->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Scores Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm text-gray-600 mb-2">Kepribadian</h3>
            <p class="text-3xl font-bold text-blue-600">{{ number_format($assessment->score_kepribadian ?? 0, 2) }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $assessment->getScoreCategory($assessment->score_kepribadian ?? 0) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm text-gray-600 mb-2">Kemandirian</h3>
            <p class="text-3xl font-bold text-green-600">{{ number_format($assessment->score_kemandirian ?? 0, 2) }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $assessment->getScoreCategory($assessment->score_kemandirian ?? 0) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm text-gray-600 mb-2">Sikap</h3>
            <p class="text-3xl font-bold text-purple-600">{{ number_format($assessment->score_sikap ?? 0, 2) }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $assessment->getScoreCategory($assessment->score_sikap ?? 0) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-sm text-gray-600 mb-2">Mental</h3>
            <p class="text-3xl font-bold text-orange-600">{{ number_format($assessment->score_mental ?? 0, 2) }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $assessment->getScoreCategory($assessment->score_mental ?? 0) }}</p>
        </div>
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg shadow p-6 text-white">
            <h3 class="text-sm mb-2">Total Skor</h3>
            <p class="text-4xl font-bold">{{ number_format($assessment->total_score ?? 0, 2) }}</p>
            <p class="text-xs mt-1">{{ $assessment->getScoreCategory($assessment->total_score ?? 0) }}</p>
        </div>
    </div>

    {{-- Detailed Observations --}}
    @foreach($observations as $variable => $items)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4">
            <h3 class="font-bold text-lg">{{ ucwords(str_replace('_', ' ', $variable)) }}</h3>
        </div>

        @foreach($items->groupBy(function($item) { return $item->observationItem->aspect; }) as $aspect => $aspectItems)
        <div class="border-b border-gray-200 last:border-b-0">
            <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                <h4 class="font-semibold text-gray-800">{{ $aspect }}</h4>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    @foreach($aspectItems->groupBy('observation_item_id') as $itemId => $observations)
                        @php
                            $item = $observations->first()->observationItem;
                            $checkedCount = $observations->where('is_checked', true)->count();
                            $percentage = ($checkedCount / $item->monthly_frequency) * 100;
                        @endphp
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">{{ $item->item_name }}</p>
                                <p class="text-xs text-gray-500">Frekuensi: {{ $checkedCount }}/{{ $item->monthly_frequency }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold
                                    @if($percentage >= 80) text-green-600
                                    @elseif($percentage >= 60) text-blue-600
                                    @elseif($percentage >= 40) text-yellow-600
                                    @else text-red-600
                                    @endif">
                                    {{ number_format($percentage, 2) }}%
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach

    {{-- Notes --}}
    @if($assessment->notes)
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Catatan</h3>
        <p class="text-gray-700">{{ $assessment->notes }}</p>
    </div>
    @endif

    {{-- Signatures --}}
    @if($assessment->signatures->count() > 0)
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tanda Tangan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($assessment->signatures as $signature)
            <div class="border border-gray-200 rounded p-4">
                <p class="text-sm font-medium text-gray-800">{{ $signature->name }}</p>
                <p class="text-xs text-gray-500">{{ $signature->role }}</p>
                <p class="text-xs text-gray-500">NIP: {{ $signature->nip }}</p>
                <p class="text-xs text-gray-400 mt-2">{{ $signature->signed_at->format('d F Y H:i') }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
