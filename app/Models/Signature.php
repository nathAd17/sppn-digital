<?php

namespace App\Models;

use App\Models\User;
use App\Models\Assessment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'user_id',
        'role',
        'name',
        'nip',
        'signed_at',
    ];

    protected function casts(): array
    {
        return [
            'signed_at' => 'datetime',
        ];
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
