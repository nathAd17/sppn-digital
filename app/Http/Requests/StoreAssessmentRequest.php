<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Assessment::class);
    }

    public function rules(): array
    {
        return [
            'inmate_id' => 'required|exists:inmates,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'observations' => 'required|array',
            'observations.*' => 'required|array',
            'observations.*.*' => 'boolean',
            'notes' => 'nullable|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'inmate_id.required' => 'Narapidana wajib dipilih',
            'inmate_id.exists' => 'Narapidana tidak ditemukan',
            'month.required' => 'Bulan penilaian wajib diisi',
            'month.between' => 'Bulan harus antara 1-12',
            'year.required' => 'Tahun penilaian wajib diisi',
            'observations.required' => 'Data observasi wajib diisi',
        ];
    }

    /**
     * Custom validation - check if assessment already exists
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $exists = \App\Models\Assessment::where('inmate_id', $this->inmate_id)
                ->where('month', $this->month)
                ->where('year', $this->year)
                ->exists();

            if ($exists) {
                $validator->errors()->add('inmate_id', 'Penilaian untuk bulan ini sudah ada');
            }
        });
    }
}
