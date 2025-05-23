<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteClass extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function athletes()
    {
        return $this->belongsTo(Athletes::class);
    }
    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }
}
