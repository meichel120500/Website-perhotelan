<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'is_active'     => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isResepsionis(): bool
    {
        return $this->role === 'resepsionis';
    }

    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            'admin'       => 'Administrator',
            'resepsionis' => 'Resepsionis',
            default       => $this->role,
        };
    }
}
