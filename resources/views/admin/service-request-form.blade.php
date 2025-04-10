<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request Form | Santa Marta | San Roque</title>
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
                    <h1 class="font-['Questrial'] text-sm whitespace-nowrap">SANTA MARTA | SAN ROQUE</h1>
                </div>
            </div>

            <!-- Admin Info -->
            <div class="flex items-center gap-3 mb-8 bg-white/10 p-3 rounded-lg">
                <img src="{{ asset('images/default-avatar.png') }}" alt="Admin" class="w-10 h-10 rounded-lg">
                <div class="text-white">
                    <p class="font-semibold">Alyanabai</p>
                    <p class="text-sm opacity-80">Admin</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 text-white/60 hover:text-white p-3 rounded-lg hover:bg-white/10 transition-colors">
                    <i class="fas fa-dashboard text-lg"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-3 text-white bg-white/10 p-3 rounded-lg">
                    <i class="fas fa-calendar text-lg"></i>
                    <span class="font-medium">Services</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="bg-white rounded-3xl p-8 shadow-xl">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 flex items-center justify-center text-[#18421F] bg-[#18421F]/10 rounded-xl">
                        @if($serviceType == 'Mass')
                            <i class="fas fa-church text-2xl"></i>
                        @elseif($serviceType == 'Baptism')
                            <i class="fas fa-water text-2xl"></i>
                        @elseif($serviceType == 'Matrimony')
                            <i class="fas fa-rings-wedding text-2xl"></i>
                        @elseif($serviceType == 'Sickcall')
                            <i class="fas fa-hospital-user text-2xl"></i>
                        @elseif($serviceType == 'Blessing')
                            <i class="fas fa-pray text-2xl"></i>
                        @else
                            <i class="fas fa-building-columns text-2xl"></i>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold">SERVICE REQUEST FORM</h1>
                        <p class="text-lg text-gray-600">{{ $serviceType }} Service</p>
                    </div>
                </div>

                <form action="{{ route('service.request.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="service_type" value="{{ $serviceType }}">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" placeholder="ex: Alyanabai Mabalingnay" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#18421F]/20">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" placeholder="ex: Alyanabai Mabalingnay"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#18421F]/20">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <input type="text" name="address" 
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#18421F]/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                        <input type="text" name="contact_number" placeholder="ex: 09xxxxxxxxx"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#18421F]/20">
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Service Date</label>
                            <input type="date" name="service_date" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#18421F]/20">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Service Schedule</label>
                            <input type="time" name="service_schedule" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#18421F]/20">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Priest</label>
                        <select name="priest_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#18421F]/20">
                            <option value="">Select a priest</option>
                            @foreach($priests as $priest)
                                <option value="{{ $priest->id }}">Fr. {{ $priest->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Documents</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center" id="drop-zone">
                            <input type="file" name="documents" class="hidden" id="document-upload" accept=".pdf,.doc,.docx">
                            <label for="document-upload" class="cursor-pointer flex flex-col items-center">
                                <i class="fas fa-arrow-up-from-bracket text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Drag and drop files here or click to browse</p>
                                <p class="text-xs text-gray-400 mt-1">Accepted formats: PDF, DOC, DOCX</p>
                            </label>
                            <div id="file-name" class="mt-2 text-sm text-gray-600"></div>
                        </div>
                    </div>

                    <!-- Add error messages display -->
                    @if ($errors->any())
                        <div class="bg-red-50 text-red-500 p-4 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Venue</label>
                        <input type="text" name="venue" 
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#18421F]/20">
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="bg-[#18421F] text-white px-8 py-3 rounded-lg hover:bg-[#18421F]/90 transition-colors">
                            SUBMIT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('document-upload');
        const fileNameDisplay = document.getElementById('file-name');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-[#18421F]');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-[#18421F]');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-[#18421F]');
            fileInput.files = e.dataTransfer.files;
            updateFileName();
        });

        fileInput.addEventListener('change', updateFileName);

        function updateFileName() {
            const fileName = fileInput.files[0]?.name;
            if (fileName) {
                fileNameDisplay.textContent = `Selected file: ${fileName}`;
            } else {
                fileNameDisplay.textContent = '';
            }
        }
    </script>
</body>
</html>