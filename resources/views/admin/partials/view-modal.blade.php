<!-- View Service Modal -->
<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-[500px]">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold">Service Details</h3>
            <button onclick="closeViewModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-4">
            <div>
                <label class="text-sm text-gray-500">Ticket Number</label>
                <p id="viewTicketNumber" class="font-semibold"></p>
            </div>
            <div>
                <label class="text-sm text-gray-500">Service Type</label>
                <p id="viewServiceType" class="font-semibold"></p>
            </div>
            <div>
                <label class="text-sm text-gray-500">Requestor</label>
                <p id="viewRequestor" class="font-semibold"></p>
            </div>
            <div>
                <label class="text-sm text-gray-500">Contact Number</label>
                <p id="viewContact" class="font-semibold"></p>
            </div>
            <div>
                <label class="text-sm text-gray-500">Email</label>
                <p id="viewEmail" class="font-semibold"></p>
            </div>
            <div>
                <label class="text-sm text-gray-500">Schedule</label>
                <p id="viewSchedule" class="font-semibold"></p>
            </div>
            <div>
                <label class="text-sm text-gray-500 block">Status</label>
                <p id="viewStatus" class="font-semibold px-2 py-1 rounded-full text-sm mt-1"></p>
            </div>
            <div>
                <label class="text-sm text-gray-500">Documents</label>
                <div id="viewDocuments" class="mt-2 space-y-2">
                    <!-- Documents will be populated here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openViewModal(service) {
        const modal = document.getElementById('viewModal');
        document.getElementById('viewTicketNumber').textContent = service.ticket_number || 'N/A';
        document.getElementById('viewServiceType').textContent = service.service_type || 'N/A';
        document.getElementById('viewRequestor').textContent = `${service.first_name || ''} ${service.last_name || ''}`.trim() || 'N/A';
        document.getElementById('viewContact').textContent = service.contact_number || 'N/A';
        document.getElementById('viewEmail').textContent = service.email || 'N/A';

        // Format the date and time
        const serviceDate = service.service_date ? new Date(service.service_date).toLocaleDateString() : 'N/A';
        const serviceTime = service.service_schedule ?
            new Date(`1970-01-01T${service.service_schedule}`).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            }) : 'N/A';
        document.getElementById('viewSchedule').textContent = `${serviceDate} at ${serviceTime}`;

        const statusElement = document.getElementById('viewStatus');
        const status = service.status || 'Pending';
        statusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1);

        // Set status colors
        switch (status.toLowerCase()) {
            case 'approved':
                statusElement.className = 'font-semibold px-2 py-1 rounded-full text-sm inline-block bg-green-100 text-green-800';
                break;
            case 'pending':
                statusElement.className = 'font-semibold px-2 py-1 rounded-full text-sm inline-block bg-yellow-100 text-yellow-800';
                break;
            case 'cancelled':
                statusElement.className = 'font-semibold px-2 py-1 rounded-full text-sm inline-block bg-red-100 text-red-800';
                break;
            default:
                statusElement.className = 'font-semibold px-2 py-1 rounded-full text-sm inline-block bg-gray-100 text-gray-800';
        }

        // Handle documents
        const documentsContainer = document.getElementById('viewDocuments');
        documentsContainer.innerHTML = '';

        if (service.document_path) {
            try {
                const documents = JSON.parse(service.document_path);
                documents.forEach(doc => {
                    const docDiv = document.createElement('div');
                    docDiv.className = 'flex items-center justify-between bg-gray-50 p-2 rounded';
                    docDiv.innerHTML = `
                        <div class="flex items-center gap-2">
                            <i class="fas fa-file text-gray-400"></i>
                            <span class="text-sm text-gray-600">${doc.split('/').pop()}</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="/storage/${doc}" target="_blank" class="text-blue-500 hover:text-blue-600">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="/storage/${doc}" download class="text-green-500 hover:text-green-600">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    `;
                    documentsContainer.appendChild(docDiv);
                });
            } catch (e) {
                // Handle single document path
                const docDiv = document.createElement('div');
                docDiv.className = 'flex items-center justify-between bg-gray-50 p-2 rounded';
                docDiv.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i class="fas fa-file text-gray-400"></i>
                        <span class="text-sm text-gray-600">${service.document_path.split('/').pop()}</span>
                    </div>
                    <div class="flex gap-2">
                        <a href="/storage/${service.document_path}" target="_blank" class="text-blue-500 hover:text-blue-600">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="/storage/${service.document_path}" download class="text-green-500 hover:text-green-600">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                `;
                documentsContainer.appendChild(docDiv);
            }
        } else {
            documentsContainer.innerHTML = '<p class="text-sm text-gray-500">No documents attached</p>';
        }

        modal.style.display = 'flex';
    }

    function closeViewModal() {
        const modal = document.getElementById('viewModal');
        modal.style.display = 'none';
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const viewModal = document.getElementById('viewModal');
        if (event.target === viewModal) {
            closeViewModal();
        }
    });
</script>