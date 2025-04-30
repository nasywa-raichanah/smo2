<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'class_name',
        'sex',
        'max_weight',
        'min_weight',
    ];

    public function athleteClass()
    {
        // return $this->belongsToMany(
        //     Athletes::class,
        //     'athletes_classes',
        //     'athletes_id',
        //     'classes_id'
        // );
        return $this->belongsToMany(AthleteClass::class);
    }
}
