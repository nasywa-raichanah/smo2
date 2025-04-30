<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoices_id',
        'user_id',
        'item',
        'qty',
        'cost',
        'total_cost'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoices::class);
    }
}
