<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlessingDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'blessing_type',
        'blessing_location'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}