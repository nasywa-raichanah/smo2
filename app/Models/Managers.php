<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managers extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'manager_name',
        'whatsapp_num',
        // 'coach_num',
        'coach_photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
