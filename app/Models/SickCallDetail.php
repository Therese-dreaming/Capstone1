<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SickCallDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'patient_name',
        'patient_age',
        'patient_condition',
        'location',
        'room_number',
        'contact_person',
        'emergency_contact'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}