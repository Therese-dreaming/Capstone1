<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmationDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'confirmand_name',
        'confirmand_dob',
        'baptism_place',
        'baptism_date',
        'sponsor_name'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}