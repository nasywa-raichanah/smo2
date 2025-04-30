<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'username',
        'university',
        'email',
        'password',
        'is_active',
        'is_confirm',
        'status',
        'nationality',
        'address',
        'postal_code',
        'logo',
        'mandate_letter',
    ];

    public function manager()
    {
        return $this->hasMany(Manager::class);
    }
    public function athlete()
    {
        return $this->hasMany(Athlete::class);
    }
    public function athleteClass()
    {
        return $this->hasMany(AthleteClass::class);
    }
    public function user()
    {
        return $this->hasOne(Invoices::class);
    }
    public function message()
    {
        return $this->hasMany(Messages::class);
    }
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
