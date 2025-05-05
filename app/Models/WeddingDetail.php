<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'groom_name',
        'groom_age',
        'groom_religion',
        'bride_name',
        'bride_age',
        'bride_religion'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}