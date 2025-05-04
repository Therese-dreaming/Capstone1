<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class userServiceController extends Controller
{
    public function bookingForm()
    {
        return view('services.book');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'notes' => 'nullable|string'
        ]);

        $schedule = Schedule::create([
            'service_type' => $request->service_type,
            'first_name' => Auth::user()->first_name, // You might want to split this into first/last name
            'last_name' => Auth::user()->last_name, // You'll need to add this field to your registration
            'service_date' => $request->preferred_date,
            'service_schedule' => $request->preferred_time,
            'status' => 'pending',
            'notes' => $request->notes,
            // Add other required fields from your schedules table
            'address' => Auth::user()->address, // You'll need to collect this in your form
            'contact_number' => Auth::user()->contact_number, // You'll need to collect this in your form
            'venue' => 'Church' // Default venue, you might want to make this configurable
        ]);

        return redirect()->back()->with('success', 'Service booking submitted successfully! Your ticket number is: ' . $schedule->ticket_number);
    }

    public function myBookings()
    {
        $bookings = Schedule::where('first_name', auth()->user()->first_name)
            ->where('last_name', auth()->user()->last_name)
            ->orderBy('service_date', 'desc')
            ->orderBy('service_schedule', 'desc')
            ->get();
            
        return view('services.my-bookings', compact('bookings'));
    }
}