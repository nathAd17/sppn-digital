<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObservationItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'variable',
        'aspect',
        'aspect_weight',
        'item_name',
        'monthly_frequency',
        'item_weight',
        'sort_order',
        'is_active',
    ];

    protected $dates = ['deleted_at'];

    protected function casts(): array
    {
        return [
            'aspect_weight' => 'decimal:2',
            'item_weight' => 'decimal:2',
            'monthly_frequency' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function dailyObservations()
    {
        return $this->hasMany(DailyObservation::class);
    }

    // Scope untuk filter by variable
    public function scopeByVariable($query, $variable)
    {
        return $query->where('variable', $variable);
    }

    // Scope untuk filter by aspect
    public function scopeByAspect($query, $aspect)
    {
        return $query->where('aspect', $aspect);
    }

    // Scope untuk active items only
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Group items by aspect
    public static function groupedByAspect($variable = null)
    {
        $query = self::active()->orderBy('sort_order');

        if ($variable) {
            $query->where('variable', $variable);
        }

        return $query->get()->groupBy('aspect');
    }
}
