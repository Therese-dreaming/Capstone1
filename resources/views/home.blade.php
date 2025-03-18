<!DOCTYPE html>
<html lang="fil">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Roque Parish | Pateros</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="relative min-h-screen">
        <!-- First section with church-bg-2.jpg -->
        <div class="relative h-screen">
            <img src="{{ asset('images/church-bg.jpg') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-[#41644A] opacity-60"></div>
            
            <div class="relative z-10">
                <div class="flex justify-end p-6 bg-[#0d5c2f]">
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-white hover:text-[#b8860b] text-3xl">LOGIN</a>
                        <a href="{{ route('signup') }}" class="text-white hover:text-[#b8860b] text-3xl">REGISTER</a>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center text-white text-center px-8 py-20">
                    <div class="w-110 h-110 rounded-full flex items-center justify-center mb-8">
                        <div class="w-100 h-100 bg-white rounded-full flex items-center justify-center">
                            <img src="{{ asset('images/church-logo.png') }}" alt="Church Logo" class="w-100 h-100">
                        </div>
                    </div>
                    <h1 class="text-6xl font-bold tracking-[.1em] uppercase leading-none w-full mb-4">Dambanang Pangdiyosesis ni Santa Marta</h1>
                    <h1 class="text-6xl font-bold tracking-[.1em] uppercase leading-none w-full">Parokya ng San Roque</h1>
                </div>
            </div>
        </div>

        <!-- Second section with church-bg.jpg -->
        <div class="relative">
            <img src="{{ asset('images/church-bg-2.jpg') }}" alt="Schedule Background" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-[#1E1E1E] opacity-80"></div>
            
            <div class="relative z-10 py-20">
                <div class="text-white text-center max-w-4xl mx-auto">
                    <h2 class="text-5xl font-bold mb-12">PARISH SCHEDULE</h2>
                    
                    <div class="mb-8">
                        <p class="text-2xl font-bold mb-2">DAILY MASS SCHEDULE:</p>
                        <p class="text-xl">Monday & Thursdays: 6:00 AM & 6:00 PM</p>
                        <p class="text-xl">Anticipated Sunday Mass: 6:00 PM</p>
                    </div>

                    <div class="mb-8">
                        <p class="text-2xl font-bold mb-2">SUNDAY MASS SCHEDULE:</p>
                        <p class="text-xl">Morning: 5:00 AM; 7:30 AM, 8:45 AM; 10:00 AM (English)</p>
                        <p class="text-xl">Afternoon: 3:00 PM (English); 4:00 PM (English); 5:15PM; 6:30PM</p>
                    </div>

                    <div>
                        <p class="text-2xl font-bold mb-2">LIVE STREAMING MASS SCHEDULE:</p>
                        <p class="text-xl">Sunday at 7:30 AM Mass</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third section with links -->
        <div class="w-full bg-[#41644A] py-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto px-8">
                <a href="#" class="relative overflow-hidden rounded-lg group h-72">
                    <img src="{{ asset('images/about.jpg') }}" alt="About Us" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-[#1E1E1E] opacity-40"></div>
                    <div class="absolute inset-0 flex items-end justify-start p-6">
                        <h2 class="text-4xl font-bold text-white">ABOUT<br>US</h2>
                    </div>
                </a>
                
                <a href="#" class="relative overflow-hidden rounded-lg group h-72">
                    <div class="absolute inset-0 bg-[#1E1E1E] opacity-40"></div>
                    <div class="absolute inset-0 flex items-end justify-start p-6">
                        <h2 class="text-4xl font-bold text-white">NEWS<br>& UPDATE</h2>
                    </div>
                </a>
                
                <a href="#" class="relative overflow-hidden rounded-lg group h-72">
                    <img src="{{ asset('images/contact.jpg') }}" alt="Contact Us" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-[#1E1E1E] opacity-40 z-10"></div>
                    <div class="absolute inset-0 flex items-end justify-start p-6 z-20">
                        <h2 class="text-4xl font-bold text-white">CONTACT<br>US</h2>
                    </div>
                </a>
            </div>
        </div>

        <!-- Fourth section - Sacraments and Services -->
        <div class="relative py-20">
            <img src="{{ asset('images/church-bg-3.jpg') }}" alt="Sacraments Background" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-[#1E1E1E] opacity-80"></div>
            
            <div class="relative z-10 text-center max-w-5xl mx-auto px-8">
                <h2 class="text-5xl font-bold text-white mb-12">SACRAMENTS AND SERVICES</h2>
                <div class="grid grid-cols-2 gap-8">
                    <a href="#" class="bg-[#0d5c2f] text-white text-2xl font-bold py-6 px-8 rounded-lg hover:bg-[#0d5c2f]/80 transition-colors border-2 border-white">
                        MATRIMONY
                    </a>
                    <a href="#" class="bg-[#0d5c2f] text-white text-2xl font-bold py-6 px-8 rounded-lg hover:bg-[#0d5c2f]/80 transition-colors border-2 border-white">
                        FUNERAL MASS
                    </a>
                    <a href="#" class="bg-[#0d5c2f] text-white text-2xl font-bold py-6 px-8 rounded-lg hover:bg-[#0d5c2f]/80 transition-colors border-2 border-white">
                        BAPTISM
                    </a>
                    <a href="#" class="bg-[#0d5c2f] text-white text-2xl font-bold py-6 px-8 rounded-lg hover:bg-[#0d5c2f]/80 transition-colors border-2 border-white">
                        OTHER SERVICES
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer section -->
        <footer class="bg-[#0d5c2f] text-white py-12">
            <div class="max-w-5xl mx-auto px-8 grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h3 class="text-2xl font-bold mb-4">CONTACT US</h3>
                    <p class="mb-2">Phone: (02) 8642-3837</p>
                    <p class="mb-2">Email: sanroquepateros@gmail.com</p>
                    <p>Address: M. Almeda St, Pateros, Metro Manila</p>
                </div>
                
                <div>
                    <h3 class="text-2xl font-bold mb-4">OFFICE HOURS</h3>
                    <p class="mb-2">Monday & Thursday:</p>
                    <p class="mb-2">8:00 AM - 5:00 PM</p>
                    <p class="mb-2">Tuesday & Saturday:</p>
                    <p>8:00 AM - 12:00 PM</p>
                </div>

                <div>
                    <h3 class="text-2xl font-bold mb-4">FOLLOW US</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-[#b8860b]">Facebook</a>
                        <a href="#" class="hover:text-[#b8860b]">YouTube</a>
                    </div>
                </div>
            </div>
            
            <div class="max-w-5xl mx-auto px-8 mt-8 pt-8 border-t border-white/20">
                <p class="text-center text-sm">© 2024 San Roque Parish. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>