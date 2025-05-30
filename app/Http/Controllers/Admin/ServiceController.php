<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        $todaySchedules = Schedule::with('priest')
            ->whereDate('service_date', $today)
            ->where('status', 'approved')
            ->orderBy('service_schedule', 'asc')
            ->get()
            ->map(function ($schedule) {
                $schedule->service_schedule = Carbon::parse($schedule->service_schedule)->format('H:i:s');
                return $schedule;
            });

        $pendingServices = Schedule::with('priest')
            ->where('status', 'pending')
            ->orderBy('service_date')
            ->orderBy('service_schedule')
            ->get()
            ->map(function ($schedule) {
                $schedule->service_schedule = Carbon::parse($schedule->service_schedule)->format('H:i:s');
                return $schedule;
            });

        $priests = User::where('role', 'priest')->get();

        return view('admin.services', compact('todaySchedules', 'pendingServices', 'priests'));
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
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        try {
            // Remove documents from validated data as we'll handle it separately
            $serviceData = collect($validated)->except('documents')->toArray();
            $serviceData['status'] = 'pending';

            // Handle multiple file uploads
            if ($request->hasFile('documents')) {
                $paths = [];
                foreach ($request->file('documents') as $file) {
                    $paths[] = $file->store('service-documents', 'public');
                }
                $serviceData['document_path'] = json_encode($paths);
            }

            // Create the service record with all data including document paths
            $service = Schedule::create($serviceData);

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

    public function cancelService($id)
    {
        try {
            $service = Schedule::findOrFail($id);
            $service->update([
                'status' => 'cancelled'
            ]);
            return redirect()->back()->with('success', 'Service request cancelled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to cancel service. Please try again.');
        }
    }


    public function destroy($id)
    {
        try {
            $service = Schedule::findOrFail($id);
            $service->delete();
            
            return redirect()->back()->with('success', 'Service deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete service');
        }
    }

    public function history()
    {
        $completedServices = Schedule::whereIn('status', ['approved', 'cancelled'])
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('admin.service-history', compact('completedServices'));
    }

    public function getEvents($type)
    {
        $events = Schedule::where('service_type', ucfirst($type))
            ->where('status', 'approved')
            ->get()
            ->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'title' => $schedule->service_type,
                    'start' => $schedule->service_date . 'T' . $schedule->service_schedule,
                    'end' => $schedule->service_date . 'T' . $schedule->service_schedule,
                    'display' => 'block',
                    'backgroundColor' => '#18421F',
                    'borderColor' => '#18421F'
                ];
            });

        return response()->json($events);
    }

    public function getDateEvents($type, $date)
    {
        $events = Schedule::where('service_type', ucfirst($type))
            ->whereDate('service_date', $date)
            ->where('status', 'approved')
            ->get()
            ->map(function ($schedule) {
                return [
                    'service_type' => $schedule->service_type,
                    'time' => Carbon::parse($schedule->service_schedule)->format('g:i A'),
                    'requestor' => $schedule->first_name . ' ' . $schedule->last_name
                ];
            });

        return response()->json($events);
    }
}
