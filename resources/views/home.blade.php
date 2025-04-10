<!DOCTYPE html>
<html lang="fil">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Santa Marta | San Roque</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-black m-0 p-0">
    <div class="flex flex-col min-h-screen">

        <!-- Navigation -->
        <nav class="absolute top-0 left-0 right-0 z-20 p-4">
            <div class="container mx-auto flex items-center">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/church-logo.png') }}" alt="Logo" class="h-12 w-12" />
                    <span class="text-white ml-3 text-xl">SANTA MARTA | SAN ROQUE</span>
                </a>
                <div class="ml-auto flex items-center gap-4">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-white flex items-center gap-2">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-200 px-4 py-2 border border-white rounded-lg transition-colors">Login</a>
                        <a href="{{ route('signup') }}" class="bg-white text-[#0d5c2f] hover:bg-gray-100 px-4 py-2 rounded-lg transition-colors">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            <!-- Hero Section -->
            <div class="relative min-h-screen">
                <img src="{{ asset('images/church-bg.jpg') }}" alt="Church Background" class="absolute inset-0 w-full h-full object-cover brightness-50" />
                <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center px-4">
                    <h1 class="text-6xl md:text-7xl font-bold mb-4 tracking-wider">
                        DAMBANANG PANGDIYOSESIS<br />NI STA. MARTA
                    </h1>
                    <h2 class="font-['Great_Vibes'] text-5xl md:text-6xl">Parokya ni San Roque</h2>
                </div>
            </div>

            <!-- Service Hours Section -->
            <div class="bg-white py-20">
                <h2 class="text-[#0d5c2f] text-5xl font-bold text-center mb-16">SERVICE HOURS</h2>

                <div class="container mx-auto px-4 grid md:grid-cols-2 gap-12">
                    <!-- Mass Schedule -->
                    <div class="text-center">
                        <div class="mb-12">
                            <h3 class="font-['Great_Vibes'] text-4xl text-[#0d5c2f] mb-2">Daily</h3>
                            <h4 class="text-2xl font-bold text-[#0d5c2f] mb-4">MASS SCHEDULE</h4>
                            <p class="text-[#b8860b]">MON - SAT 6:00AM & 6:00PM</p>
                        </div>

                        <div class="mb-12">
                            <h3 class="font-['Great_Vibes'] text-4xl text-[#0d5c2f] mb-2">Anticipated</h3>
                            <h4 class="text-2xl font-bold text-[#0d5c2f] mb-4">MASS SCHEDULE</h4>
                            <p class="text-[#b8860b]">SAT 6:00PM</p>
                        </div>

                        <div>
                            <h3 class="font-['Great_Vibes'] text-4xl text-[#0d5c2f] mb-2">Sunday</h3>
                            <h4 class="text-2xl font-bold text-[#0d5c2f] mb-4">MASS SCHEDULE</h4>
                            <div class="grid grid-cols-2 gap-8">
                                <div>
                                    <h5 class="text-[#b8860b] font-bold mb-2">MORNING</h5>
                                    <div class="space-y-1">
                                        <p>5:00 AM</p>
                                        <p>6:15AM</p>
                                        <p>7:30 AM</p>
                                        <p>8:45 AM</p>
                                        <p>10:00AM</p>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="text-[#b8860b] font-bold mb-2">AFTERNOON</h5>
                                    <div class="space-y-1">
                                        <p>3:00 PM</p>
                                        <p>4:00 PM</p>
                                        <p>5:15 PM</p>
                                        <p>6:30 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Office Transaction -->
                    <div class="text-center border-l border-[#0d5c2f]">
                        <h3 class="font-['Great_Vibes'] text-4xl text-[#0d5c2f] mb-2">Office</h3>
                        <h4 class="text-4xl font-bold text-[#0d5c2f] mb-12">TRANSACTION</h4>

                        <div class="mb-8">
                            <h5 class="text-[#b8860b] text-2xl font-bold mb-4">MONDAY & HOLIDAYS</h5>
                            <p class="text-3xl font-bold text-[#0d5c2f]">CLOSED</p>
                        </div>

                        <div class="mb-8">
                            <h5 class="text-[#b8860b] text-2xl font-bold mb-4">TUESDAY - SATURDAY</h5>
                            <p>8:00 AM - 12:00 NN</p>
                            <p>1:00 PM - 5:00 PM</p>
                        </div>

                        <div>
                            <h5 class="text-[#b8860b] text-2xl font-bold mb-4">SUNDAY</h5>
                            <p>8:00 AM - 12:00 NN</p>
                            <p>3:00 PM - 5:00 PM</p>
                        </div>
                    </div>
                </div>

                <!-- Ministry Cards Section (Now full-width and moved outside container) -->
                <div class="w-full bg-white py-20">
                    <div class="flex flex-col md:flex-row w-full h-[80vh]">
                        <!-- Sacraments Card -->
                        <div class="relative w-full md:w-1/3 h-full">
                            <img src="{{ asset('images/sacraments.jpg') }}" alt="Sacraments" class="w-full h-full object-cover grayscale">
                            <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center">
                                <h3 class="text-white text-5xl font-bold mb-4 font-['Rowdies']">SACRAMENTS</h3>
                                <a href="#" class="text-[#0d5c2f] font-bold bg-white px-6 py-1.5 text-sm rounded-xl">LEARN
                                    MORE</a>
                            </div>
                        </div>

                        <!-- Devotion Card -->
                        <div class="relative w-full md:w-1/3 h-full">
                            <img src="{{ asset('images/devotion.jpg') }}" alt="Devotion" class="w-full h-full object-cover grayscale">
                            <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center">
                                <h3 class="text-white text-5xl font-bold mb-4 font-['Rowdies']">DEVOTION</h3>
                                <a href="#" class="text-[#0d5c2f] font-bold bg-white px-6 py-1.5 text-sm rounded-xl">LEARN
                                    MORE</a>
                            </div>
                        </div>

                        <!-- Ministries Card -->
                        <div class="relative w-full md:w-1/3 h-full">
                            <img src="{{ asset('images/ministries.jpg') }}" alt="Ministries" class="w-full h-full object-cover grayscale">
                            <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center">
                                <h3 class="text-white text-5xl font-bold mb-4 font-['Rowdies']">MINISTRIES</h3>
                                <a href="#" class="text-[#0d5c2f] font-bold bg-white px-6 py-1.5 text-sm rounded-xl">LEARN
                                    MORE</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Simbahan Section (unchanged) -->
                <div class="bg-white py-24">
                    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-16">
                        <div class="md:w-1/2">
                            <h2 class="text-[#0d5c2f] text-6xl font-bold mb-12 font-['Rowdies'] leading-tight">
                                ANG SIMBAHAN<br>NG PATEROS
                            </h2>
                            <div class="space-y-6">
                                <div class="group">
                                    <a href="#" class="bg-white shadow-lg hover:shadow-xl w-full py-4 px-8 text-2xl flex items-center justify-between rounded-lg border border-gray-100 hover:border-[#0d5c2f] transition-all duration-300">
                                        <span class="font-['Rowdies'] text-gray-700">ANG PAROKYA</span>
                                        <span class="bg-[#0d5c2f] text-white w-8 h-8 flex items-center justify-center rounded-full group-hover:bg-[#b8860b] transition-colors text-lg leading-none">›</span>
                                    </a>
                                </div>
                                <div class="group">
                                    <a href="#" class="bg-white shadow-lg hover:shadow-xl w-full py-4 px-8 text-2xl flex items-center justify-between rounded-lg border border-gray-100 hover:border-[#0d5c2f] transition-all duration-300">
                                        <span class="font-['Rowdies'] text-gray-700">ANG DIYOSESIS</span>
                                        <span class="bg-[#0d5c2f] text-white w-8 h-8 flex items-center justify-center rounded-full group-hover:bg-[#b8860b] transition-colors text-lg leading-none">›</span>
                                    </a>
                                </div>
                                <div class="group">
                                    <a href="#" class="bg-white shadow-lg hover:shadow-xl w-full py-4 px-8 text-2xl flex items-center justify-between rounded-lg border border-gray-100 hover:border-[#0d5c2f] transition-all duration-300">
                                        <span class="font-['Rowdies'] text-gray-700">ANG KAPARIAN</span>
                                        <span class="bg-[#0d5c2f] text-white w-8 h-8 flex items-center justify-center rounded-full group-hover:bg-[#b8860b] transition-colors text-lg leading-none">›</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-1/2">
                            <div class="relative">
                                <img src="{{ asset('images/altar.jpg') }}" alt="Church Altar" class="w-full h-auto rounded-2xl shadow-2xl">
                                <div class="absolute inset-0 rounded-2xl shadow-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>

        <!-- Footer -->
        <footer class="bg-[#0d5c2f] text-white pt-20 pb-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <!-- Footer Left -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-6">
                            <img src="{{ asset('images/church-logo.png') }}" alt="Logo" class="h-16 w-16" />
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold">SANTA MARTA</h3>
                                <p class="text-[#b8860b]">San Roque Parish Church</p>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            Serving the community with faith, love, and dedication. Join us in worship and
                            experience the grace of God in our historic church.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-white/10 hover:bg-[#b8860b] w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="bg-white/10 hover:bg-[#b8860b] w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="bg-white/10 hover:bg-[#b8860b] w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Footer Quick Links -->
                    <div>
                        <h3 class="text-xl font-bold mb-6 font-['Rowdies']">QUICK LINKS</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 hover:text-[#b8860b] transition-colors">About
                                    Us</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-[#b8860b] transition-colors">Mass
                                    Schedule</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-[#b8860b] transition-colors">Sacraments</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-[#b8860b] transition-colors">Ministries</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-[#b8860b] transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Footer Contact -->
                    <div>
                        <h3 class="text-xl font-bold mb-6 font-['Rowdies']">CONTACT US</h3>
                        <div class="space-y-4">
                            <p class="flex items-center">
                                <span class="w-5 h-5 mr-3">📍</span>
                                P. Herrera St., Pateros<br />Metro Manila, Philippines
                            </p>
                            <p class="flex items-center">
                                <span class="w-5 h-5 mr-3">📞</span>
                                (02) 8642-3837
                            </p>
                            <p class="flex items-center">
                                <span class="w-5 h-5 mr-3">✉️</span>
                                info@sanroqueparish.ph
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-16 pt-8 border-t border-white/20 text-center text-sm text-gray-400">
                    <p>&copy; 2024 San Roque Parish Church. All rights reserved.</p>
                </div>
            </div>
        </footer>

    </div>
</body>

</html>
</footer>
    </div>

    <script>
        document.querySelector('form[action="{{ route('logout') }}"]').addEventListener('submit', function(e) {
            e.preventDefault();
            
            fetch('{{ route('logout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            }).then(() => {
                window.location.reload();
            });
        });
    </script>
</body>
</html>
