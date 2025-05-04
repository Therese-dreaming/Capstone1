@extends('layouts.user')

@section('title', 'Book Services')

@section('content')
@auth
@if(Auth::user()->first_name && Auth::user()->last_name && Auth::user()->address && Auth::user()->contact_number)
<div class="bg-white min-h-screen py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold text-[#0d5c2f] mb-8">Book Church Services</h1>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white rounded-3xl p-8 shadow-xl">
                <form action="{{ route('services.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Service Type</label>
                        <select name="service_type" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            <option value="">Select a service</option>
                            <option value="baptism">Baptism</option>
                            <option value="wedding">Wedding</option>
                            <option value="mass_intention">Mass Intention</option>
                            <option value="blessing">House/Car Blessing</option>
                            <option value="confirmation">Confirmation</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Date</label>
                        <input type="date" name="preferred_date" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Time</label>
                        <input type="time" name="preferred_time" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
                        <textarea name="notes" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-300"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#18421F] text-white px-8 py-3 rounded-lg hover:bg-[#18421F]/90">
                            Submit Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="bg-white min-h-screen py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-[#0d5c2f] mb-8">Complete Your Profile First</h1>
            <p class="text-gray-600 mb-8">Please complete your profile information before booking church services.</p>
            <div class="flex justify-center">
                <a href="{{ route('profile') }}" class="bg-[#0d5c2f] text-white px-8 py-3 rounded-lg hover:bg-[#0d5c2f]/90">
                    Complete Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@else
<div class="bg-white min-h-screen py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-[#0d5c2f] mb-8">Please Login to Book Services</h1>
            <p class="text-gray-600 mb-8">You need to be logged in to book church services.</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-[#0d5c2f] text-white px-8 py-3 rounded-lg hover:bg-[#0d5c2f]/90">
                    Login
                </a>
                <a href="{{ route('signup') }}" class="border border-[#0d5c2f] text-[#0d5c2f] px-8 py-3 rounded-lg hover:bg-gray-50">
                    Register
                </a>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection
