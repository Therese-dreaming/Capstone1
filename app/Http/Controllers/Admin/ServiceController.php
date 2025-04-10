<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class ServiceController extends Controller
{
    public function index()
    {
        // Add debug logging
        $today = Carbon::today();
        
        \Log::info('Debug Today\'s Schedule Query:', [
            'current_date' => $today->toDateString(),
            'current_time' => $today->toTimeString()
        ]);

        $todaySchedules = Schedule::with('priest')
            ->whereDate('service_date', $today)
            ->where('status', 'approved')
            ->orderBy('service_schedule', 'asc')
            ->get();

        // Log the query results
        \Log::info('Today\'s Schedules Results:', [
            'count' => $todaySchedules->count(),
            'schedules' => $todaySchedules->toArray(),
            'sql' => Schedule::whereDate('service_date', $today)
                ->where('status', 'approved')
                ->toSql()
        ]);

        $pendingServices = Schedule::with('priest')
            ->where('status', 'pending')
            ->orderBy('service_date')
            ->orderBy('service_schedule')
            ->get();

        return view('admin.services', compact('todaySchedules', 'pendingServices'));
    }

    public function showRequestForm($type)
    {
        $priests = User::where('role', 'priest')->get();
        return view('admin.service-request-form', [
            'serviceType' => ucfirst($type),
            'priests' => $priests
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_type' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string',
            'service_date' => 'required|date',
            'service_schedule' => 'required',
            'venue' => 'required|string',
            'priest_id' => 'nullable|exists:users,id',
            'documents' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        try {
            if ($request->hasFile('documents')) {
                $path = $request->file('documents')->store('service-documents', 'public');
                $validated['document_path'] = $path;
            }

            // Set initial status to pending
            $validated['status'] = 'pending';

            Schedule::create($validated);

            return redirect()->route('admin.services')
                ->with('success', 'Service request submitted successfully');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to submit service request. Please try again.');
        }
    }

    public function approveService(Schedule $schedule)
    {
        try {
            $schedule->update([
                'status' => 'approved'
            ]);

            return back()->with('success', 'Service has been approved successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to approve service. Please try again.');
        }
    }
}
