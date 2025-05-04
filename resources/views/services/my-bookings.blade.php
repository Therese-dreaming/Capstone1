@extends('layouts.user')

@section('title', 'My Bookings')

@section('content')
<div class="bg-white min-h-screen py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl font-bold text-[#0d5c2f] mb-8">My Bookings</h1>

            <div class="grid gap-6">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 flex items-center justify-center text-[#0d5c2f] bg-[#0d5c2f]/10 rounded-xl">
                                    @if($booking->service_type == 'baptism')
                                        <i class="fas fa-water text-2xl"></i>
                                    @elseif($booking->service_type == 'wedding')
                                        <i class="fas fa-rings-wedding text-2xl"></i>
                                    @elseif($booking->service_type == 'mass_intention')
                                        <i class="fas fa-church text-2xl"></i>
                                    @elseif($booking->service_type == 'blessing')
                                        <i class="fas fa-pray text-2xl"></i>
                                    @elseif($booking->service_type == 'confirmation')
                                        <i class="fas fa-dove text-2xl"></i>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold capitalize">{{ str_replace('_', ' ', $booking->service_type) }}</h3>
                                    <p class="text-gray-500">
                                        {{ \Carbon\Carbon::parse($booking->preferred_date)->format('F j, Y') }} at 
                                        {{ \Carbon\Carbon::parse($booking->preferred_time)->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                @if($booking->status == 'pending')
                                    <span class="px-4 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">Pending</span>
                                @elseif($booking->status == 'approved')
                                    <span class="px-4 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Approved</span>
                                @elseif($booking->status == 'cancelled')
                                    <span class="px-4 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">Cancelled</span>
                                @endif
                            </div>
                        </div>
                        @if($booking->notes)
                            <div class="mt-4 text-gray-600">
                                <p class="text-sm"><span class="font-medium">Additional Notes:</span> {{ $booking->notes }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center text-[#0d5c2f] bg-[#0d5c2f]/10 rounded-full">
                            <i class="fas fa-calendar-xmark text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">No Bookings Yet</h3>
                        <p class="text-gray-600 mb-6">You haven't made any service bookings yet.</p>
                        <a href="{{ route('services.book') }}" class="inline-flex items-center text-[#0d5c2f] font-semibold hover:text-[#b8860b] transition-colors">
                            Book a Service <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection