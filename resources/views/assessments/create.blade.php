@extends('layouts.app')

@section('title', 'Buat Penilaian')
@section('page-title', 'Buat Penilaian Baru')

@section('content')
<form action="{{ route('assessments.store') }}" method="POST" id="assessment-form">
    @csrf

    <input type="hidden" name="inmate_id" value="{{ $inmate->id }}">
    <input type="hidden" name="month" value="{{ $month }}">
    <input type="hidden" name="year" value="{{ $year }}">

    {{-- Header Info --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-lg">
            <div>
                <p class="text-xs text-gray-500">Nama Narapidana</p>
                <p class="font-semibold text-gray-800">{{ $inmate->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">No. Register</p>
                <p class="font-semibold text-gray-800">{{ $inmate->registration_number }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">Periode Penilaian</p>
                <p class="font-semibold text-gray-800">
                    {{ \Carbon\Carbon::create($year, $month)->locale('id')->isoFormat('MMMM YYYY') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Assessment Form --}}
    @foreach($observations as $variable => $categories)
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="bg-blue-600 text-white px-6 py-4">
                <h3 class="font-bold text-lg">{{ ucwords(str_replace('_', ' ', $variable)) }}</h3>
            </div>

            @foreach($categories->groupBy('aspect') as $aspect => $items)
            <div class="border-b border-gray-200 last:border-b-0">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h4 class="font-semibold text-gray-800">{{ $aspect }}</h4>
                    <p class="text-xs text-gray-500">Bobot: {{ $items->first()->aspect_weight }}</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 w-64">Item Observasi</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">Frek.</th>
                                @for($day = 1; $day <= 31; $day++)
                                <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 w-8">{{ $day }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $item->item_name }}</td>
                                <td class="px-4 py-3 text-center text-sm font-medium text-gray-800">{{ $item->monthly_frequency }}</td>
                                @for($day = 1; $day <= 31; $day++)
                                <td class="px-2 py-3 text-center">
                                    <input
                                        type="checkbox"
                                        name="observations[{{ $item->id }}][{{ $day }}]"
                                        value="1"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer observation-check"
                                        data-item="{{ $item->id }}"
                                        data-frequency="{{ $item->monthly_frequency }}"
                                    >
                                </td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    @endforeach

    {{-- Actions --}}
    <div class="flex justify-end gap-4 mb-8">
        <a href="{{ route('inmates.show', $inmate) }}" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
            Batal
        </a>
        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
            Simpan Penilaian
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
// Auto-save to localStorage (optional)
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.observation-check');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Add visual feedback or auto-save logic here
            console.log('Checkbox changed:', this.name, this.checked);
        });
    });

    // Confirm before leaving if form has data
    let formChanged = false;
    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => formChanged = true);
    });

    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Remove warning when form is submitted
    document.getElementById('assessment-form').addEventListener('submit', function() {
        formChanged = false;
    });
});
</script>
@endpush
