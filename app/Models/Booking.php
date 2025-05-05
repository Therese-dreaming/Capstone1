<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_type',
        'preferred_date',
        'preferred_time',
        'notes',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baptismDetails()
    {
        return $this->hasOne(BaptismDetail::class);
    }

    public function weddingDetails()
    {
        return $this->hasOne(WeddingDetail::class);
    }

    public function massIntentionDetails()
    {
        return $this->hasOne(MassIntentionDetail::class);
    }

    public function blessingDetails()
    {
        return $this->hasOne(BlessingDetail::class);
    }

    public function confirmationDetails()
    {
        return $this->hasOne(ConfirmationDetail::class);
    }

    public function sickCallDetails()
    {
        return $this->hasOne(SickCallDetail::class);
    }
}