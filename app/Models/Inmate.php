<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inmate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'registration_number',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'religion',
        'education_level',
        'last_job',
        'crime_type',
        'sentence_length_months',
        'remaining_sentence_months',
        'recidivism_count',
        'health_notes',
        'training_attended',
        'work_program',
        'prison_id',
        'status',
        'entry_date',
        'release_date',
    ];

    protected $dates = ['deleted_at'];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'entry_date' => 'date',
            'release_date' => 'date',
            'recidivism_count' => 'integer',
            'sentence_length_months' => 'integer',
            'remaining_sentence_months' => 'integer',
        ];
    }

    public function prison()
    {
        return $this->belongsTo(Prison::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function latestAssessment()
    {
        return $this->hasOne(Assessment::class)->latestOfMany();
    }

    // Accessor untuk umur
    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    // Accessor untuk full name dengan bin/binti
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    // Check apakah sudah dinilai bulan ini
    public function hasAssessmentForMonth($month, $year)
    {
        return $this->assessments()
            ->where('month', $month)
            ->where('year', $year)
            ->exists();
    }

    // Get assessment status
    public function getAssessmentStatus()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $assessment = $this->assessments()
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();

        if (!$assessment) {
            return 'Belum Dinilai';
        }

        if ($assessment->status === 'approved') {
            return 'Dinilai';
        }

        if ($assessment->total_score < 60) {
            return 'Perlu Perhatian';
        }

        return 'Dinilai';
    }
}
