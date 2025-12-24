@extends('layouts.app')

@section('title', 'Detail Narapidana')
@section('page-title', 'Detail Narapidana')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('inmates.index') }}" class="text-blue-600 hover:text-blue-800 text-sm mb-2 inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-3xl font-bold text-gray-800">{{ $inmate->name }}</h1>
            <p class="text-sm text-gray-600 mt-1">{{ $inmate->registration_number }}</p>
        </div>
        <div class="flex gap-2">
            @can('update', $inmate)
            <a href="{{ route('inmates.edit', $inmate) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Data
            </a>
            @endcan
            <a href="{{ route('assessments.create', ['inmate_id' => $inmate->id]) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Penilaian
            </a>
        </div>
    </div>

    {{-- Profile Info --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Data Identitas --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Data Identitas
            </h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs text-gray-500">Tempat, Tanggal Lahir</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->place_of_birth }}, {{ $inmate->date_of_birth->format('d F Y') }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Usia</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->age }} tahun</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Jenis Kelamin</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->gender }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Agama</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->religion }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Pendidikan Terakhir</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->education_level ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Pekerjaan Terakhir</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->last_job ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Data Hukum --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                </svg>
                Data Hukum
            </h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs text-gray-500">Tindak Pidana</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->crime_type }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Tanggal Masuk</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->entry_date->format('d F Y') }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Lama Pidana</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->sentence_length_months }} bulan</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Sisa Pidana</dt>
                    <dd class="text-sm font-medium text-red-600 text-lg">{{ $inmate->remaining_sentence_months }} bulan</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Residivisme</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->recidivism_count }}x</dd>
                </div>
            </dl>
        </div>

        {{-- Data Pembinaan --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Data Pembinaan
            </h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs text-gray-500">Pelatihan yang Diikuti</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->training_attended ?? 'Tidak Ada' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Program Kerja</dt>
                    <dd class="text-sm font-medium text-gray-800">{{ $inmate->work_program ?? 'Tidak Ada' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-500">Status Penilaian</dt>
                    <dd>
                        @php
                            $status = $inmate->getAssessmentStatus();
                        @endphp
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($status === 'Dinilai') bg-green-100 text-green-800
                            @elseif($status === 'Belum Dinilai') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $status }}
                        </span>
                    </dd>
                </div>
                @if($inmate->latestAssessment)
                <div>
                    <dt class="text-xs text-gray-500">Skor Terakhir</dt>
                    <dd class="text-2xl font-bold text-blue-600">{{ number_format($inmate->latestAssessment->total_score, 2) }}</dd>
                </div>
                @endif
                @if($inmate->health_notes)
                <div>
                    <dt class="text-xs text-gray-500">Catatan Kesehatan</dt>
                    <dd class="text-sm text-gray-800">{{ $inmate->health_notes }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>

    {{-- Riwayat Penilaian --}}
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">Riwayat Penilaian</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kepribadian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kemandirian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sikap</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mental</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($assessments as $assessment)
                    <tr class="hover:bg-gray-50">
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
                        <td class="px-6 py-4 text-sm text-gray-800">{{ number_format($assessment->score_kepribadian ?? 0, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ number_format($assessment->score_kemandirian ?? 0, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ number_format($assessment->score_sikap ?? 0, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ number_format($assessment->score_mental ?? 0, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-blue-600">{{ number_format($assessment->total_score ?? 0, 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('assessments.show', $assessment) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                            Belum ada riwayat penilaian
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($assessments->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $assessments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
