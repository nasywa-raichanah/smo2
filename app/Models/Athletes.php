<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athletes extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'athlete_name',
        'athlete_email',
        'athlete_whatsapp',
        'birth_place',
        'birth_date',
        'sex',
        'weight',
        'status',
        'photo',
        'nic',
        'campus_card',
        'belt_certificate',
        'college_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function athleteClass()
    {
        // return $this->belongsToMany(
        //     Classes::class,
        //     'athletes_classes',
        //     'athletes_id',
        //     'classes_id'
        // );
        return $this->belongsToMany(AthleteClass::class);
    }
}
