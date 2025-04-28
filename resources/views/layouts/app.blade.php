<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Santa Marta | San Roque</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Remove the old FullCalendar links and add just the CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
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
                <a href="#" class="flex items-center gap-3 text-white/60 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-colors group {{ request()->is('admin/dashboard*') ? 'bg-white/10 text-white' : '' }}">
                    <i class="fas fa-dashboard text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('admin.services') }}" class="flex items-center gap-3 text-white/60 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-colors group {{ request()->is('admin/services') ? 'bg-white/10 text-white' : '' }}">
                    <i class="fas fa-calendar text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Services</span>
                </a>
                <a href="{{ route('admin.services.history') }}" class="flex items-center gap-3 text-white/60 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-colors group {{ request()->is('admin/services/history*') ? 'bg-white/10 text-white' : '' }}">
                    <i class="fas fa-history text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Service History</span>
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
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search by ticket number or name..." 
                            class="bg-white/10 text-white pl-10 pr-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/20" 
                            onkeyup="searchServices()">
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
                        <button type="submit" class="hover:text-white/80 transition-colors">
                            <i class="fas fa-sign-out text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>

            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>