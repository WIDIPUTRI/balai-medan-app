<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'gender',
        'birth_place',
        'birth_date',
        'education',
        'address',
        'phone',
        'photo',
        'notes',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_date' => 'date',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }


    public function loginLogs()
    {
        return $this->hasMany(AdminLoginLog::class);
    }

    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }
}