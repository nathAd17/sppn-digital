@extends('layouts.app')

@section('title', 'Data Narapidana')
@section('page-title', 'Data Narapidana')

@section('content')
<div class="space-y-6">
    {{-- Header & Actions --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Data Narapidana</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola data narapidana di {{ auth()->user()->prison->name }}</p>
        </div>
        @can('create', App\Models\Inmate::class)
        <a href="{{ route('inmates.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Narapidana
        </a>
        @endcan
    </div>

    {{-- Search and Filter --}}
    <div class="bg-white rounded-lg shadow p-4">
        <form method="GET" action="{{ route('inmates.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau nomor register..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
            <select name="crime_type" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Tindak Pidana</option>
                <option value="Narkotika" {{ request('crime_type') == 'Narkotika' ? 'selected' : '' }}>Narkotika</option>
                <option value="Pencurian" {{ request('crime_type') == 'Pencurian' ? 'selected' : '' }}>Pencurian</option>
                <option value="Penganiayaan" {{ request('crime_type') == 'Penganiayaan' ? 'selected' : '' }}>Penganiayaan</option>
                <option value="Penipuan" {{ request('crime_type') == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                <option value="Perlindungan Anak" {{ request('crime_type') == 'Perlindungan Anak' ? 'selected' : '' }}>Perlindungan Anak</option>
            </select>
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                Cari
            </button>
            @if(request()->has('search') || request()->has('crime_type'))
            <a href="{{ route('inmates.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                Reset
            </a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full" id="data-table">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Register</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindak Pidana</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sisa Pidana</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Penilaian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($inmates as $inmate)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $inmate->registration_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $inmate->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $inmate->age }} tahun</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $inmate->crime_type }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $inmate->remaining_sentence_months }} bulan</td>
                        <td class="px-6 py-4">
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
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('inmates.show', $inmate) }}" class="text-blue-600 hover:text-blue-800" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                @can('update', $inmate)
                                <a href="{{ route('inmates.edit', $inmate) }}" class="text-yellow-600 hover:text-yellow-800" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                @endcan
                                <a href="{{ route('assessments.create', ['inmate_id' => $inmate->id]) }}" class="text-green-600 hover:text-green-800" title="Buat Penilaian">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            Tidak ada data narapidana
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($inmates->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $inmates->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
