@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="bg-white rounded-3xl p-8 shadow-xl">
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <!-- Service header section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">SERVICE SCHEDULING</h1>
        <p class="text-lg text-gray-600">Select a service to schedule</p>
    </div>

    <div class="flex gap-8">
        <!-- Service Grid -->
        <div class="flex-1 grid grid-cols-3 gap-6">
            <!-- Mass -->
            <!-- Mass card example -->
            <div onclick="showCalendar('mass')" class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="w-16 h-16 mb-4 flex items-center justify-center text-[#18421F] bg-[#18421F]/10 rounded-xl">
                    <i class="fas fa-church text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold">MASS</h3>
                <p class="text-gray-500 text-sm mt-2">Regular Service</p>
            </div>

            <!-- Baptism -->
            <a href="{{ route('service.request.form', ['type' => 'baptism']) }}" class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="w-16 h-16 mb-4 flex items-center justify-center text-[#18421F] bg-[#18421F]/10 rounded-xl">
                    <i class="fas fa-water text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold">BAPTISM</h3>
                <p class="text-gray-500 text-sm mt-2">Sacrament</p>
            </a>

            <!-- Matrimony -->
            <a href="{{ route('service.request.form', ['type' => 'matrimony']) }}" class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="w-16 h-16 mb-4 flex items-center justify-center text-[#18421F] bg-[#18421F]/10 rounded-xl">
                    <i class="fas fa-rings-wedding text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold">MATRIMONY</h3>
                <p class="text-gray-500 text-sm mt-2">Sacrament</p>
            </a>

            <!-- Sick Call -->
            <a href="{{ route('service.request.form', ['type' => 'sickcall']) }}" class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="w-16 h-16 mb-4 flex items-center justify-center text-[#18421F] bg-[#18421F]/10 rounded-xl">
                    <i class="fas fa-hospital-user text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold">SICK CALL</h3>
                <p class="text-gray-500 text-sm mt-2">Emergency Service</p>
            </a>

            <!-- Blessing -->
            <a href="{{ route('service.request.form', ['type' => 'blessing']) }}" class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="w-16 h-16 mb-4 flex items-center justify-center text-[#18421F] bg-[#18421F]/10 rounded-xl">
                    <i class="fas fa-pray text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold">BLESSING</h3>
                <p class="text-gray-500 text-sm mt-2">House/Car Blessing</p>
            </a>

            <!-- Venue Reservation -->
            <a href="{{ route('service.request.form', ['type' => 'venue']) }}" class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="w-16 h-16 mb-4 flex items-center justify-center text-[#18421F] bg-[#18421F]/10 rounded-xl">
                    <i class="fas fa-building-columns text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold">VENUE RESERVATION</h3>
                <p class="text-gray-500 text-sm mt-2">Church Facilities</p>
            </a>
        </div>

        <!-- Today's Schedule -->
        <div class="w-[400px] bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Today's Schedule</h2>
            <div class="space-y-6">
                @php
                $now = \Carbon\Carbon::now();
                $closestSchedule = $todaySchedules->sortBy(function($schedule) use ($now) {
                return abs($now->diffInMinutes(\Carbon\Carbon::parse($schedule->service_schedule)));
                })->first();
                @endphp

                @forelse($todaySchedules as $schedule)
                <div onclick="openViewModal({{ json_encode($schedule) }})" class="flex items-center justify-between {{ $schedule->id === $closestSchedule?->id ? 'text-red-500' : '' }} cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                    <div class="flex items-center gap-6">
                        <span class="w-24">{{ Carbon\Carbon::parse($schedule->service_schedule)->format('g:i A') }}</span>
                        <span class="font-medium">{{ $schedule->service_type }}</span>
                    </div>
                    <span class="{{ $schedule->id === $closestSchedule?->id ? 'text-red-500' : 'text-gray-400' }}">
                        {{ $schedule->priest ? 'Fr. ' . $schedule->priest->name : 'Unassigned' }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500 text-center">No schedules for today</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Calendar Modal -->
    <div id="calendarModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-[800px] max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-xl font-bold" id="calendarTitle">Select Date</h3>
                <button onclick="closeCalendarModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="calendar" class="min-h-[500px]"></div>
        </div>
    </div>

    <!-- Date Events Modal -->
    <div id="dateEventsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-[600px]">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-xl font-bold" id="selectedDate"></h3>
                <button onclick="closeDateEventsModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="dateEvents" class="space-y-4 mb-6"></div>
            <div class="flex justify-end">
                <button onclick="openRequestForm()" class="bg-[#18421F] text-white px-6 py-2 rounded-lg hover:bg-[#18421F]/90">
                    Make a Reservation
                </button>
            </div>
        </div>
    </div>

    <!-- Pending Services -->
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">PENDING SERVICES</h2>
        <div class="space-y-4">
            @forelse($pendingServices as $service)
            <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                <div>
                    <h3 class="font-semibold">{{ $service->service_type }}</h3>
                    <p class="text-sm text-gray-500">Ticket: {{ $service->ticket_number }}</p>
                    <p class="text-sm text-gray-500">{{ $service->first_name }} {{ $service->last_name }}</p>
                    <p class="text-sm text-gray-500">{{ Carbon\Carbon::parse($service->service_date)->format('M d, Y') }} at {{ Carbon\Carbon::parse($service->service_schedule)->format('g:i A') }}</p>
                </div>
                <div class="flex gap-2">
                    <button onclick="openViewModal({{ json_encode($service) }})" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        View
                    </button>
                    <button onclick="openApproveModal({{ $service->id }})" class="px-4 py-2 bg-[#18421F] text-white rounded-lg hover:bg-[#18421F]/90">
                        Approve
                    </button>
                    <button onclick="openCancelModal({{ $service->id }})" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Cancel
                    </button>
                </div>
            </div>
            @empty
            <p class="text-gray-500">No pending services</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Approve Modal -->
@include('admin.partials.approve-modal')

<!-- Cancel Modal -->
@include('admin.partials.cancel-modal')

<!-- View Modal -->
@include('admin.partials.view-modal')
@endsection

@section('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
    let selectedServiceType = '';
    let selectedDate = '';
    let currentCalendar = null; // Add this line to track the calendar instance

    function showCalendar(serviceType) {
        console.log('Showing calendar for:', serviceType);
        selectedServiceType = serviceType;
        const modal = document.getElementById('calendarModal');
        modal.style.display = 'flex';

        const calendarEl = document.getElementById('calendar');
        if (currentCalendar) {
            currentCalendar.destroy(); // Destroy existing calendar if any
        }

        currentCalendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
            , headerToolbar: {
                left: 'prev,next today'
                , center: 'title'
                , right: ''
            }
            , events: `/admin/services/${serviceType}/events`
            , dateClick: function(info) {
                showDateEvents(info.dateStr);
            }
            , eventClick: function(info) {
                showDateEvents(info.event.start);
            }
            , eventDisplay: 'block'
            , eventColor: '#18421F'
            , height: 'auto'
        });
        currentCalendar.render();
    }

    function closeCalendarModal() {
        const modal = document.getElementById('calendarModal');
        modal.style.display = 'none';
        if (currentCalendar) {
            currentCalendar.destroy(); // Clean up calendar instance
        }
    }

    // Add this to your window.onclick handler
    window.onclick = function(event) {
        const approveModal = document.getElementById('approveModal');
        const cancelModal = document.getElementById('cancelModal');
        const calendarModal = document.getElementById('calendarModal');
        const dateEventsModal = document.getElementById('dateEventsModal');

        if (event.target === approveModal) {
            closeApproveModal();
        }
        if (event.target === cancelModal) {
            closeCancelModal();
        }
        if (event.target === calendarModal) {
            closeCalendarModal();
        }
        if (event.target === dateEventsModal) {
            closeDateEventsModal();
        }
    }

    function openApproveModal(serviceId) {
        const modal = document.getElementById('approveModal');
        const form = document.getElementById('approveForm');
        form.action = `/admin/services/${serviceId}/approve`;
        modal.style.display = 'flex';
    }

    function closeApproveModal() {
        const modal = document.getElementById('approveModal');
        modal.style.display = 'none';
    }

    function openCancelModal(serviceId) {
        const modal = document.getElementById('cancelModal');
        const form = document.getElementById('cancelForm');
        form.action = `/admin/services/${serviceId}/cancel`;
        modal.style.display = 'flex';
    }

    function closeCancelModal() {
        const modal = document.getElementById('cancelModal');
        modal.style.display = 'none';
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        const approveModal = document.getElementById('approveModal');
        const cancelModal = document.getElementById('cancelModal');

        if (event.target === approveModal) {
            closeApproveModal();
        }
        if (event.target === cancelModal) {
            closeCancelModal();
        }
    }

    function searchServices() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const services = document.querySelectorAll('.pending-service');

        services.forEach(service => {
            const ticketNumber = service.querySelector('.ticket-number').textContent.toLowerCase();
            const name = service.querySelector('.requestor-name').textContent.toLowerCase();

            if (ticketNumber.includes(input) || name.includes(input)) {
                service.style.display = '';
            } else {
                service.style.display = 'none';
            }
        });
    }

    function showDateEvents(date) {
        selectedDate = date;
        const modal = document.getElementById('dateEventsModal');
        const dateTitle = document.getElementById('selectedDate');
        const eventsContainer = document.getElementById('dateEvents');

        // Format the date
        dateTitle.textContent = new Date(date).toLocaleDateString('en-US', {
            weekday: 'long'
            , year: 'numeric'
            , month: 'long'
            , day: 'numeric'
        });

        // Fetch events for the selected date
        fetch(`/admin/services/${selectedServiceType}/events/${date}`)
            .then(response => response.json())
            .then(events => {
                eventsContainer.innerHTML = events.length > 0 ?
                    events.map(event => `
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="font-semibold">${event.service_type}</div>
                            <div class="text-sm text-gray-600">${event.time}</div>
                            <div class="text-sm text-gray-600">${event.requestor}</div>
                        </div>
                    `).join('') :
                    '<p class="text-gray-500 text-center">No events scheduled for this date</p>';
            })
            .catch(error => {
                console.error('Error fetching events:', error);
                eventsContainer.innerHTML = '<p class="text-red-500 text-center">Error loading events</p>';
            });

        modal.style.display = 'flex';
    }

    function closeDateEventsModal() {
        const modal = document.getElementById('dateEventsModal');
        modal.style.display = 'none';
    }

    function openRequestForm() {
        window.location.href = `/admin/services/request/${selectedServiceType}?date=${selectedDate}`;
    }

</script>
@endsection
