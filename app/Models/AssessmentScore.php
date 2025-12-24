<?php

namespace App\Models;

use App\Models\Assessment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssessmentScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'variable',
        'aspect',
        'score',
        'weight',
        'weighted_score',
        'category',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'weight' => 'decimal:2',
            'weighted_score' => 'decimal:2',
        ];
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
