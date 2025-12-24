<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommitmentStatement extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'type',
        'is_signed',
        'signed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'is_signed' => 'boolean',
            'signed_at' => 'datetime',
        ];
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
