<?php

namespace App\Models;

use App\Models\User;
use App\Models\Inmate;
use App\Models\Assessment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prison extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'code',
        'address',
        'city',
        'province',
        'phone',
    ];

    protected $dates = ['deleted_at'];

    public function inmates()
    {
        return $this->hasMany(Inmate::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
