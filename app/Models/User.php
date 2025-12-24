<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Prison;
use App\Models\Assessment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'nip',
        'role',
        'prison_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
     public function prison()
    {
        return $this->belongsTo(Prison::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'created_by');
    }

    public function approvedAssessments()
    {
        return $this->hasMany(Assessment::class, 'approved_by');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isKepalaLapas()
    {
        return $this->role === 'kepala_lapas';
    }

    public function isKasubsi()
    {
        return $this->role === 'kasubsi';
    }

    public function isWaliPemasyarakatan()
    {
        return $this->role === 'wali_pemasyarakatan';
    }

    public function canApproveAssessment()
    {
        return in_array($this->role, ['admin', 'kepala_lapas', 'kasubsi']);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get username for authentication.
     */
    public function getAuthIdentifierName()
    {
        return 'username'; // or 'email' depending on your preference
    }

    /**
     * Scope to get active users only.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if user has specific role.
     */
    public function hasRole($role)
    {
        if (is_array($role)) {
            return in_array($this->role, $role);
        }
        return $this->role === $role;
    }
}
