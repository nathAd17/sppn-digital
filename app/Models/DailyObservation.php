<?php

namespace App\Models;

use App\Models\Assessment;
use App\Models\ObservationItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyObservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'observation_item_id',
        'day',
        'is_checked',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'day' => 'integer',
            'is_checked' => 'boolean',
        ];
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function observationItem()
    {
        return $this->belongsTo(ObservationItem::class);
    }
}
