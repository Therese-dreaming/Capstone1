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