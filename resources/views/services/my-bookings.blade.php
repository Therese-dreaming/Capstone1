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

                        <div class="mt-4">
                            <button onclick="openModal('modal-{{ $booking->id }}')" class="inline-flex items-center px-4 py-2 bg-[#0d5c2f] text-white rounded-lg hover:bg-[#0d5c2f]/90 transition-colors">
                                <i class="fas fa-eye mr-2"></i> View Details
                            </button>
                        </div>

                        <!-- Modal -->
                        <div id="modal-{{ $booking->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="fixed inset-0 bg-black opacity-50"></div>
                                <div class="relative bg-white rounded-lg max-w-2xl w-full">
                                    <div class="p-6">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-2xl font-bold text-[#0d5c2f] capitalize">
                                                {{ str_replace('_', ' ', $booking->service_type) }} Details
                                            </h3>
                                            <button onclick="closeModal('modal-{{ $booking->id }}')" class="text-gray-400 hover:text-gray-500">
                                                <i class="fas fa-times text-xl"></i>
                                            </button>
                                        </div>
                                        
                                        @switch($booking->service_type)
                                            @case('baptism')
                                                @include('services.partials._baptism_details', ['booking' => $booking])
                                                @break
                                            @case('wedding')
                                                @include('services.partials._wedding_details', ['booking' => $booking])
                                                @break
                                            @case('mass_intention')
                                                @include('services.partials._mass_intention_details', ['booking' => $booking])
                                                @break
                                            @case('blessing')
                                                @include('services.partials._blessing_details', ['booking' => $booking])
                                                @break
                                            @case('confirmation')
                                                @include('services.partials._confirmation_details', ['booking' => $booking])
                                                @break
                                            @case('sick_call')
                                                @include('services.partials._sick_call_details', ['booking' => $booking])
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        </div>
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

<!-- Add this script at the end of your file -->
<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('fixed')) {
        const modals = document.querySelectorAll('.fixed.inset-0');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    }
}
</script>
@endsection