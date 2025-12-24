<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInmateRequest extends FormRequest
{
 public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('inmate'));
    }

    public function rules(): array
    {
        $inmateId = $this->route('inmate')->id;

        return [
            'registration_number' => [
                'required',
                'max:50',
                Rule::unique('inmates')->ignore($inmateId)
            ],
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
            'health_notes' => 'nullable|string|max:1000',
        ];
    }
}
