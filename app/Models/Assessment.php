<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'inmate_id',
        'prison_id',
        'month',
        'year',
        'status',
        'notes',
        'created_by',
        'approved_by',
        'submitted_at',
        'approved_at',
        'score_kepribadian',
        'score_kemandirian',
        'score_sikap',
        'score_mental',
        'total_score',
    ];
protected $dates = ['deleted_at'];
    protected function casts(): array
    {
        return [
            'month' => 'integer',
            'year' => 'integer',
            'submitted_at' => 'datetime',
            'approved_at' => 'datetime',
            'score_kepribadian' => 'decimal:2',
            'score_kemandirian' => 'decimal:2',
            'score_sikap' => 'decimal:2',
            'score_mental' => 'decimal:2',
            'total_score' => 'decimal:2',
        ];
    }

    public function inmate()
    {
        return $this->belongsTo(Inmate::class);
    }

    public function prison()
    {
        return $this->belongsTo(Prison::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function dailyObservations()
    {
        return $this->hasMany(DailyObservation::class);
    }

    public function scores()
    {
        return $this->hasMany(AssessmentScore::class);
    }

    public function commitmentStatements()
    {
        return $this->hasMany(CommitmentStatement::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }

    // Get month name
    public function getMonthNameAttribute()
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        return $months[$this->month] ?? '';
    }

    // Get period string
    public function getPeriodAttribute()
    {
        return $this->month_name . ' ' . $this->year;
    }

    // Calculate total score
    public function calculateScores()
    {
        $scores = [
            'kepribadian' => 0,
            'kemandirian' => 0,
            'sikap' => 0,
            'mental' => 0,
        ];

        // Group observations by aspect
        $aspects = $this->dailyObservations()
            ->with('observationItem')
            ->get()
            ->groupBy(function($item) {
                return $item->observationItem->variable;
            });

        foreach ($aspects as $variable => $observations) {
            $variableScore = 0;

            $byAspect = $observations->groupBy(function($item) {
                return $item->observationItem->aspect;
            });

            foreach ($byAspect as $aspect => $items) {
                $aspectScore = 0;
                $aspectWeight = $items->first()->observationItem->aspect_weight;

                foreach ($items as $observation) {
                    $item = $observation->observationItem;
                    $checkedCount = $this->dailyObservations()
                        ->where('observation_item_id', $item->id)
                        ->where('is_checked', true)
                        ->count();

                    $itemScore = ($checkedCount / $item->monthly_frequency) * 100;
                    $aspectScore += $itemScore * $item->item_weight;
                }

                $variableScore += ($aspectScore * $aspectWeight);
            }

            $scores[$variable] = $variableScore;
        }

        $this->update([
            'score_kepribadian' => $scores['kepribadian'] ?? 0,
            'score_kemandirian' => $scores['kemandirian'] ?? 0,
            'score_sikap' => $scores['sikap'] ?? 0,
            'score_mental' => $scores['mental'] ?? 0,
            'total_score' => array_sum($scores) / 4,
        ]);

        return $this;
    }

    // Get score category
    public function getScoreCategory($score)
    {
        if ($score >= 81) return 'Sangat Baik';
        if ($score >= 61) return 'Baik';
        if ($score >= 41) return 'Cukup Baik';
        if ($score >= 21) return 'Tidak Baik';
        return 'Sangat Tidak Baik';
    }

    // Check if can be edited
    public function canBeEdited()
    {
        return in_array($this->status, ['draft', 'rejected']);
    }

    // Check if can be submitted
    public function canBeSubmitted()
    {
        return $this->status === 'draft';
    }

    // Check if can be approved
    public function canBeApproved()
    {
        return $this->status === 'submitted';
    }
}
