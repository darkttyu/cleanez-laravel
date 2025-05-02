<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    const ROLE_ADMIN = 'Admin';
    const ROLE_USER = 'User';
    const ROLE_APPLICANT = 'Applicant';
    const ROLE_CLEANER = 'Cleaner';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'date_of_birth',
        'phone',
        'gender',
        'address',
        'role',
        'is_active',
        'last_login_at',
        'cancelled_appointments'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'address' => 'array',
            'date_of_birth' => 'datetime',
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
        ];
    }

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser() {
        return $this->role === self::ROLE_USER;
    }

    public function isApplicant() {
        return $this->role === self::ROLE_APPLICANT;
    }

    public function isCleaner() {
        return $this->role === self::ROLE_CLEANER;
    }
}
