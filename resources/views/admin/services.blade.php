<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | Santa Marta | San Roque</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#18421F] font-['Poppins']">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#18421F] p-4 shadow-xl">
            <!-- Logo and Title -->
            <div class="flex items-center gap-4 mb-8">
                    <img src="{{ asset('images/church-logo.png') }}" alt="Logo" class="w-10 h-10">
                <div class="text-white">
                    <h1 class="font-['Questrial'] text-sm text-tracking">SANTA MARTA | SAN ROQUE</h1>
                </div>
            </div>

            <!-- Admin Info -->
            <div class="flex items-center gap-3 mb-8 bg-white/10 p-3 rounded-lg hover:bg-white/20 transition-all cursor-pointer">
                <img src="{{ asset('images/default-avatar.png') }}" alt="Admin" class="w-10 h-10 rounded-lg">
                <div class="text-white">
                    <p class="font-semibold">Alyanabai</p>
                    <p class="text-sm opacity-80">Admin</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 text-white/60 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-colors group">
                    <i class="fas fa-dashboard text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-3 text-white bg-white/10 p-3 rounded-lg group">
                    <i class="fas fa-calendar text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Services</span>
                </a>
                <a href="#" class="flex items-center gap-3 text-white/60 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-colors group">
                    <i class="fas fa-users text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Priests</span>
                </a>
                <a href="#" class="flex items-center gap-3 text-white/60 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-colors group">
                    <i class="fas fa-chart-simple text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Analytics</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/5">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Search services..." class="bg-white/10 text-white pl-10 pr-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/20">
                        <i class="fas fa-search text-white/60 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    </div>
                </div>
                <div class="flex items-center gap-4 text-white">
                    <button class="relative hover:text-white/80 transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-xs w-4 h-4 flex items-center justify-center rounded-full">3</span>
                    </button>
                    <button class="hover:text-white/80 transition-colors">
                        <i class="fas fa-gear text-xl"></i>
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-white/80 transition-colors" onclick="window.location.href = '{{ route('home') }}'">
                            <i class="fas fa-sign-out text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-xl">
                <!-- Service header section -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold mb-2">SERVICE SCHEDULING</h1>
                    <p class="text-lg text-gray-600">Select a service to schedule</p>
                </div>

                <div class="flex gap-8">
                    <!-- Service Grid -->
                    <div class="flex-1 grid grid-cols-3 gap-6">
                        <!-- Mass -->
                        <a href="{{ route('service.request.form', ['type' => 'mass']) }}" class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1">
                            <div class="w-16 h-16 mb-4 flex items-center justify-center text-[#18421F] bg-[#18421F]/10 rounded-xl">
                                <i class="fas fa-church text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-bold">MASS</h3>
                            <p class="text-gray-500 text-sm mt-2">Regular Service</p>
                        </a>

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
                            <div class="flex items-center justify-between {{ $schedule->id === $closestSchedule?->id ? 'text-red-500' : '' }}">
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

                <!-- Pending Services -->
                <div class="mt-8">
                    <h2 class="text-xl font-bold mb-4">PENDING SERVICES</h2>
                    <div class="space-y-4">
                        @forelse($pendingServices as $service)
                        <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold">{{ $service->service_type }}</h3>
                                <p class="text-sm text-gray-500">{{ $service->first_name }} {{ $service->last_name }}</p>
                                <p class="text-sm text-gray-500">{{ Carbon\Carbon::parse($service->service_date)->format('M d, Y') }} at {{ Carbon\Carbon::parse($service->service_schedule)->format('g:i A') }}</p>
                            </div>
                            <div class="flex gap-2">
                                <form action="{{ route('service.approve', $service->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-[#18421F] text-white rounded-lg hover:bg-[#18421F]/90">
                                        Approve
                                    </button>
                                </form>
                                <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
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
        </div>
    </div>
</body>
</html>