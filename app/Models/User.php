<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_CLIENT = 'client';
    const ROLE_FREELANCE = 'freelance';
    const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'competences',
        'bio',
        'taux_horaire',
    ];

    protected $casts = [
        'competences' => 'array',
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'competences' => 'array',
        'taux_horaire' => 'float',
    ];

    public function travaux()
    {
        return $this->hasMany(Travail::class, 'user_id');
    }

    public function offres()
    {
        return $this->hasMany(Offre::class, 'freelance_id');
    }

    public function isFreelance()
    {
        return $this->role === self::ROLE_FREELANCE;
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function isFreelance(): bool
    {
        return $this->role === 'freelance';
    }

    public function hasRole($role): bool
    {
        if (is_array($role)) {
            return in_array($this->role, $role);
        }
        return $this->role === $role;
    }

    public function hasAnyRole($roles): bool
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        return $this->hasRole($roles);
    }
}
