@extends('layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan & Dokumentasi')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Laporan & Dokumentasi</h1>
        <p class="text-sm text-gray-600 mt-1">Akses berbagai jenis laporan pembinaan narapidana</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Laporan Bulanan --}}
        <a href="{{ route('reports.monthly') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer group">
            <div class="bg-blue-100 w-16 h-16 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-200 transition-colors">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="font-bold text-lg mb-2 text-gray-800">Laporan Bulanan</h3>
            <p class="text-sm text-gray-600 mb-4">Generate laporan penilaian per bulan dengan detail skor per narapidana</p>
            <div class="flex items-center text-blue-600 text-sm font-medium">
                Buat Laporan
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>

        {{-- Laporan Statistik --}}
        <a href="{{ route('reports.statistics') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer group">
            <div class="bg-green-100 w-16 h-16 rounded-lg flex items-center justify-center mb-4 group-hover:bg-green-200 transition-colors">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="font-bold text-lg mb-2 text-gray-800">Laporan Statistik</h3>
            <p class="text-sm text-gray-600 mb-4">Analisis data pembinaan dengan grafik dan tren per periode</p>
            <div class="flex items-center text-green-600 text-sm font-medium">
                Lihat Statistik
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>

        {{-- Rekomendasi --}}
        <a href="{{ route('reports.recommendations') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer group">
            <div class="bg-purple-100 w-16 h-16 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-200 transition-colors">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
            <h3 class="font-bold text-lg mb-2 text-gray-800">Rekomendasi Hak Narapidana</h3>
            <p class="text-sm text-gray-600 mb-4">Daftar narapidana yang memenuhi syarat untuk pemberian hak</p>
            <div class="flex items-center text-purple-600 text-sm font-medium">
                Lihat Rekomendasi
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
    </div>

    {{-- Recent Reports --}}
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Laporan Terbaru</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @php
                    $recentReports = [
                        ['title' => 'Laporan Pembinaan ' . now()->locale('id')->isoFormat('MMMM YYYY'), 'date' => now()->format('d F Y'), 'type' => 'PDF', 'size' => '2.5 MB'],
                        ['title' => 'Laporan Pembinaan ' . now()->subMonth()->locale('id')->isoFormat('MMMM YYYY'), 'date' => now()->subMonth()->format('d F Y'), 'type' => 'PDF', 'size' => '2.3 MB'],
                        ['title' => 'Statistik Triwulan ' . now()->quarter . ' ' . now()->year, 'date' => now()->format('d F Y'), 'type' => 'Excel', 'size' => '1.8 MB'],
                    ];
                @endphp
                @foreach($recentReports as $report)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <div class="flex items-center gap-4">
                        <div class="bg-gray-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $report['title'] }}</h4>
                            <p class="text-sm text-gray-500">{{ $report['date'] }} • {{ $report['type'] }} • {{ $report['size'] }}</p>
                        </div>
                    </div>
                    <button class="px-4 py-2 text-blue-600 hover:text-blue-800 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
