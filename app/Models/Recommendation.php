<?php

namespace App\Models;

use App\Models\User;
use App\Models\Assessment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recommendation extends Model
{
     use HasFactory;

    protected $fillable = [
        'assessment_id',
        'recommendation_text',
        'eligible_for_rights',
        'recommended_by',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'eligible_for_rights' => 'boolean',
            'approved_at' => 'datetime',
        ];
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function recommender()
    {
        return $this->belongsTo(User::class, 'recommended_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
