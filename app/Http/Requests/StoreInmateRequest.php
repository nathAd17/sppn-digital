<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInmateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Inmate::class);
    }

    public function rules(): array
    {
        return [
            'registration_number' => 'required|unique:inmates|max:50',
            'name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'religion' => 'required|string|max:50',
            'education_level' => 'nullable|string|max:100',
            'last_job' => 'nullable|string|max:255',
            'crime_type' => 'required|string|max:255',
            'sentence_length_months' => 'required|integer|min:1|max:1200',
            'remaining_sentence_months' => 'required|integer|min:0',
            'recidivism_count' => 'nullable|integer|min:0|max:10',
            'health_notes' => 'nullable|string|max:1000',
            'training_attended' => 'nullable|string|max:255',
            'work_program' => 'nullable|string|max:255',
            'entry_date' => 'required|date|before_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'registration_number.required' => 'Nomor registrasi wajib diisi',
            'registration_number.unique' => 'Nomor registrasi sudah digunakan',
            'name.required' => 'Nama narapidana wajib diisi',
            'date_of_birth.before' => 'Tanggal lahir harus sebelum hari ini',
            'sentence_length_months.min' => 'Lama pidana minimal 1 bulan',
            'entry_date.before_or_equal' => 'Tanggal masuk tidak boleh di masa depan',
        ];
    }
}
