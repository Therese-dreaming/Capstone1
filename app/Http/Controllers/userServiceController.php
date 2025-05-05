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
            'first_name' => Auth::user()->first_name,
            'last_name' => Auth::user()->last_name,
            'service_date' => $request->preferred_date,
            'service_schedule' => $request->preferred_time,
            'status' => 'pending',
            'notes' => $request->notes,
            'address' => Auth::user()->address,
            'contact_number' => Auth::user()->contact_number,
            'venue' => 'Church'
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