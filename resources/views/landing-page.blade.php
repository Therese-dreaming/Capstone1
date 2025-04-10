<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Santa Marta Parish</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-[#0d5c2f] text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Santa Marta Parish</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white hover:text-gray-200">Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto p-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-[#0d5c2f]">Welcome, {{ Auth::user()->name }}</h1>
                <p class="text-gray-600 mt-2">What would you like to do today?</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <a href="#" class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <h2 class="text-2xl font-bold text-[#0d5c2f] mb-2">Mass Intention</h2>
                    <p class="text-gray-600">Request mass intentions and offerings</p>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <h2 class="text-2xl font-bold text-[#0d5c2f] mb-2">News & Updates</h2>
                    <p class="text-gray-600">Stay updated with parish announcements</p>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <h2 class="text-2xl font-bold text-[#0d5c2f] mb-2">About Us</h2>
                    <p class="text-gray-600">Learn more about our parish</p>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <h2 class="text-2xl font-bold text-[#0d5c2f] mb-2">Contact Us</h2>
                    <p class="text-gray-600">Get in touch with the parish office</p>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
