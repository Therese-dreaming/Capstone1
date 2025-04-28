@extends('layouts.app')

@section('title', 'Service History')

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
            <!-- Card content remains the same -->
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
        @include('admin.partials.service-table')
    </div>

    <!-- Delete Modal -->
    @include('admin.partials.delete-modal')
    
    <!-- View Modal -->
    @include('admin.partials.view-modal')
</div>
@endsection