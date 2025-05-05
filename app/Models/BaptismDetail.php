<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaptismDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'child_name',
        'date_of_birth',
        'place_of_birth',
        'father_name',
        'mother_name',
        'nationality'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}