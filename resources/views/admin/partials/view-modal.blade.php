<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-[600px] max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-xl font-bold">Service Details</h3>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="serviceDetails" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Service Type</p>
                    <p id="viewServiceType" class="font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p id="viewStatus" class="font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Requestor</p>
                    <p id="viewRequestor" class="font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Contact Number</p>
                    <p id="viewContact" class="font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Schedule</p>
                    <p id="viewSchedule" class="font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Venue</p>
                    <p id="viewVenue" class="font-medium"></p>
                </div>
                <div class="col-span-2">
                    <p class="text-sm text-gray-500">Address</p>
                    <p id="viewAddress" class="font-medium"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openViewModal(service) {
    const modal = document.getElementById('viewModal');
    document.getElementById('viewServiceType').textContent = service.service_type;
    document.getElementById('viewStatus').textContent = service.status.charAt(0).toUpperCase() + service.status.slice(1);
    document.getElementById('viewRequestor').textContent = `${service.first_name} ${service.last_name}`;
    document.getElementById('viewContact').textContent = service.contact_number;
    document.getElementById('viewSchedule').textContent = `${formatDate(service.service_date)} at ${formatTime(service.service_schedule)}`;
    document.getElementById('viewVenue').textContent = service.venue;
    document.getElementById('viewAddress').textContent = service.address;
    modal.style.display = 'flex';
}

function closeViewModal() {
    const modal = document.getElementById('viewModal');
    modal.style.display = 'none';
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric'
    });
}

function formatTime(timeString) {
    return new Date(`2000-01-01 ${timeString}`).toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
    });
}

window.addEventListener('click', function(event) {
    const modal = document.getElementById('viewModal');
    if (event.target === modal) {
        closeViewModal();
    }
});
</script>