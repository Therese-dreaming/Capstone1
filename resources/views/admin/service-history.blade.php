<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service History | Santa Marta | San Roque</title>
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
                <a href="{{ route('admin.services') }}" class="flex items-center gap-3 text-white/60 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-colors group">
                    <i class="fas fa-calendar text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Services</span>
                </a>
                <a href="{{ route('admin.services.history') }}" class="flex items-center gap-3 text-white bg-white/10 p-3 rounded-lg group">
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

                <div class="mb-8">
                    <h1 class="text-4xl font-bold mb-2">SERVICE HISTORY</h1>
                    <p class="text-lg text-gray-600">View all completed and cancelled services</p>
                </div>

                <!-- Search and Filter -->
                <div class="flex gap-4 mb-6">
                    <div class="relative flex-1">
                        <input type="text" id="searchInput" placeholder="Search by ticket number or name..." 
                            class="w-full pl-10 pr-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#18421F]" 
                            onkeyup="searchServices()">
                        <i class="fas fa-search text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    </div>
                    <select id="statusFilter" onchange="filterServices()" 
                        class="px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#18421F]">
                        <option value="all">All Status</option>
                        <option value="approved">Approved</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <div class="flex rounded-lg border">
                        <button onclick="toggleView('card')" id="cardViewBtn" class="px-4 py-2 rounded-l-lg bg-[#18421F] text-white">
                            <i class="fas fa-grid-2"></i>
                        </button>
                        <button onclick="toggleView('table')" id="tableViewBtn" class="px-4 py-2 rounded-r-lg hover:bg-[#18421F] hover:text-white">
                            <i class="fas fa-table-list"></i>
                        </button>
                    </div>
                </div>

                <!-- Card View -->
                <div id="cardView" class="space-y-4">
                    @forelse($completedServices as $service)
                    <div class="service-item bg-white p-4 rounded-lg shadow border hover:shadow-md transition-shadow"
                         data-status="{{ $service->status }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="font-semibold text-lg">{{ $service->service_type }}</h3>
                                    <span class="ticket-number text-sm text-gray-500">#{{ $service->ticket_number }}</span>
                                    <span class="px-2 py-1 rounded-full text-sm 
                                        {{ $service->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($service->status) }}
                                    </span>
                                </div>
                                <div class="text-gray-600">
                                    <p class="requestor-name">{{ $service->first_name }} {{ $service->last_name }}</p>
                                    <p>{{ Carbon\Carbon::parse($service->service_date)->format('M d, Y') }} at 
                                       {{ Carbon\Carbon::parse($service->service_schedule)->format('g:i A') }}</p>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <button onclick="openViewModal({{ json_encode($service) }})"
                                    class="text-[#18421F] hover:text-[#18421F]/70">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="openDeleteModal({{ $service->id }})"
                                    class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-500">No service history found</p>
                    @endforelse
                </div>

                <!-- Table View -->
                <div id="tableView" class="hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ticket #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requestor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($completedServices as $service)
                                <tr class="service-item" data-status="{{ $service->status }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="ticket-number">#{{ $service->ticket_number }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $service->service_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="requestor-name">{{ $service->first_name }} {{ $service->last_name }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ Carbon\Carbon::parse($service->service_date)->format('M d, Y') }} at 
                                        {{ Carbon\Carbon::parse($service->service_schedule)->format('g:i A') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 rounded-full text-sm 
                                            {{ $service->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex gap-2">
                                            <button onclick="openViewModal({{ json_encode($service) }})"
                                                class="text-[#18421F] hover:text-[#18421F]/70">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="openDeleteModal({{ $service->id }})"
                                                class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No service history found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Delete Modal (moved outside both views) -->
                <!-- Delete Modal -->
                                <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                                    <div class="bg-white rounded-lg p-6 w-[400px]">
                                        <h3 class="text-xl font-bold mb-4">Confirm Deletion</h3>
                                        <p class="text-gray-600 mb-6">Are you sure you want to permanently delete this service request? This action cannot be undone.</p>
                                        <div class="flex justify-end gap-4">
                                            <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                                                Cancel
                                            </button>
                                            <form id="deleteForm" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                <!-- Delete Modal JavaScript (moved outside both views) -->
                <script>
                    function openDeleteModal(serviceId) {
                        const modal = document.getElementById('deleteModal');
                        const form = document.getElementById('deleteForm');
                        form.action = `/admin/services/${serviceId}/delete`;
                        modal.style.display = 'flex';
                    }

                    function closeDeleteModal() {
                        const modal = document.getElementById('deleteModal');
                        modal.style.display = 'none';
                    }

                    // Close modal when clicking outside
                    window.addEventListener('click', function(event) {
                        const modal = document.getElementById('deleteModal');
                        if (event.target === modal) {
                            closeDeleteModal();
                        }
                    });
                </script>
                <script>
                    function toggleView(view) {
                        const cardView = document.getElementById('cardView');
                        const tableView = document.getElementById('tableView');
                        const cardViewBtn = document.getElementById('cardViewBtn');
                        const tableViewBtn = document.getElementById('tableViewBtn');

                        if (view === 'card') {
                            cardView.classList.remove('hidden');
                            tableView.classList.add('hidden');
                            cardViewBtn.classList.add('bg-[#18421F]', 'text-white');
                            cardViewBtn.classList.remove('hover:bg-[#18421F]', 'hover:text-white');
                            tableViewBtn.classList.remove('bg-[#18421F]', 'text-white');
                            tableViewBtn.classList.add('hover:bg-[#18421F]', 'hover:text-white');
                        } else {
                            cardView.classList.add('hidden');
                            tableView.classList.remove('hidden');
                            tableViewBtn.classList.add('bg-[#18421F]', 'text-white');
                            tableViewBtn.classList.remove('hover:bg-[#18421F]', 'hover:text-white');
                            cardViewBtn.classList.remove('bg-[#18421F]', 'text-white');
                            cardViewBtn.classList.add('hover:bg-[#18421F]', 'hover:text-white');
                        }
                    }

                    // Keep the existing searchServices and filterServices functions
                </script>
            </div>
        </div>
    </div>

    <!-- View Modal (reuse the same modal from services.blade.php) -->
    @include('admin.partials.view-modal')

    <script>
        function searchServices() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const services = document.querySelectorAll('.service-item');

            services.forEach(service => {
                const ticketNumber = service.querySelector('.ticket-number').textContent.toLowerCase();
                const name = service.querySelector('.requestor-name').textContent.toLowerCase();
                const status = service.dataset.status;
                
                const matchesSearch = ticketNumber.includes(searchValue) || name.includes(searchValue);
                const matchesFilter = statusFilter === 'all' || status === statusFilter;

                service.style.display = matchesSearch && matchesFilter ? '' : 'none';
            });
        }

        function filterServices() {
            searchServices();
        }
    </script>
</body>
</html>