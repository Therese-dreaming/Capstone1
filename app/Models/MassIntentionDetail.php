<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MassIntentionDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'mass_type',
        'mass_names'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}