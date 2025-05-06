<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BaptismDetail;
use App\Models\WeddingDetail;
use App\Models\MassIntentionDetail;
use App\Models\BlessingDetail;
use App\Models\ConfirmationDetail;
use App\Models\SickCallDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class userServiceController extends Controller
{
    public function bookingForm()
    {
        return view('services.book');
    }

    public function store(Request $request)
    {
        // Add validation rules
        $validationRules = [
            'service_type' => 'required|string',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'notes' => 'nullable|string'
        ];

        // Add service-specific validation rules
        switch($request->service_type) {
            case 'baptism':
                $validationRules += [
                    'child_name' => 'required|string',
                    'date_of_birth' => 'required|date',
                    'place_of_birth' => 'required|string',
                    'father_name' => 'required|string',
                    'mother_name' => 'required|string',
                    'nationality' => 'required|string'
                ];
                break;
            // Add other service type validations as needed
        }

        // Validate the request
        $validated = $request->validate($validationRules);

        try {
            DB::beginTransaction();
            
            // Create base booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'service_type' => $request->service_type,
                'preferred_date' => $request->preferred_date,
                'preferred_time' => $request->preferred_time,
                'notes' => $request->notes,
                'status' => 'pending'
            ]);
            
            // Handle service-specific details
            switch($request->service_type) {
                case 'baptism':
                    BaptismDetail::create([
                        'booking_id' => $booking->id,
                        'child_name' => $request->child_name,
                        'date_of_birth' => $request->date_of_birth,
                        'place_of_birth' => $request->place_of_birth,
                        'father_name' => $request->father_name,
                        'mother_name' => $request->mother_name,
                        'nationality' => $request->nationality
                    ]);
                    break;

                case 'wedding':
                    WeddingDetail::create([
                        'booking_id' => $booking->id,
                        'groom_name' => $request->groom_name,
                        'groom_age' => $request->groom_age,
                        'groom_religion' => $request->groom_religion,
                        'bride_name' => $request->bride_name,
                        'bride_age' => $request->bride_age,
                        'bride_religion' => $request->bride_religion
                    ]);
                    break;

                case 'mass_intention':
                    MassIntentionDetail::create([
                        'booking_id' => $booking->id,
                        'mass_type' => $request->mass_type,
                        'mass_names' => $request->mass_names
                    ]);
                    break;

                case 'blessing':
                    BlessingDetail::create([
                        'booking_id' => $booking->id,
                        'blessing_type' => $request->blessing_type,
                        'blessing_location' => $request->blessing_location
                    ]);
                    break;

                case 'confirmation':
                    ConfirmationDetail::create([
                        'booking_id' => $booking->id,
                        'confirmand_name' => $request->confirmand_name,
                        'confirmand_dob' => $request->confirmand_dob,
                        'baptism_place' => $request->baptism_place,
                        'baptism_date' => $request->baptism_date,
                        'sponsor_name' => $request->sponsor_name
                    ]);
                    break;

                case 'sick_call':
                    SickCallDetail::create([
                        'booking_id' => $booking->id,
                        'patient_name' => $request->patient_name,
                        'patient_age' => $request->patient_age,
                        'patient_condition' => $request->patient_condition,
                        'location' => $request->location,
                        'room_number' => $request->room_number,
                        'contact_person' => $request->contact_person,
                        'emergency_contact' => $request->emergency_contact
                    ]);
                    break;
            }

            DB::commit();
            return redirect()->back()->with('success', 'Service booked successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Booking error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while processing your booking. Please try again.']);
        }
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->orderBy('preferred_date', 'desc')
            ->orderBy('preferred_time', 'desc')
            ->get();
            
        return view('services.my-bookings', compact('bookings'));
    }
}