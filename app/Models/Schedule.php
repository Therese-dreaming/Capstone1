<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'service_type',
        'first_name',
        'last_name',
        'address',
        'contact_number',
        'service_date',
        'service_schedule',
        'venue',
        'document_path',
        'status',
        'priest_id'
    ];

    protected $casts = [
        'service_date' => 'date',
        'service_schedule' => 'string'  // Changed from datetime to string
    ];

    public function priest()
    {
        return $this->belongsTo(User::class, 'priest_id');
    }
}