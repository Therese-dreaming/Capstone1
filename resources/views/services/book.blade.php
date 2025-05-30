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
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Service Type</label>
                        <select name="service_type" required class="w-full px-4 py-2 rounded-lg border border-gray-300" onchange="handleServiceTypeChange(this.value)">
                            <option value="">Select a service</option>
                            <option value="baptism">Baptism</option>
                            <option value="wedding">Wedding</option>
                            <option value="mass_intention">Mass Intention</option>
                            <option value="blessing">House/Car Blessing</option>
                            <option value="confirmation">Confirmation</option>
                            <option value="sick_call">Sick Call</option>
                        </select>
                    </div>

                    <!-- Dynamic Service Forms -->
                    <div id="baptismForm" class="service-form hidden">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Child's Name</label>
                                <input type="text" name="child_name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                                <input type="text" name="place_of_birth" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Father's Name</label>
                                <input type="text" name="father_name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mother's Name</label>
                                <input type="text" name="mother_name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Parents' Nationality</label>
                                <input type="text" name="nationality" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                        </div>
                    </div>

                    <div id="weddingForm" class="service-form hidden">
                        <div class="space-y-4">
                            <h3 class="font-medium text-gray-900">Groom Information</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Groom's Full Name</label>
                                <input type="text" name="groom_name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Groom's Age</label>
                                <input type="number" name="groom_age" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Groom's Religion</label>
                                <input type="text" name="groom_religion" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>

                            <h3 class="font-medium text-gray-900 mt-6">Bride Information</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bride's Full Name</label>
                                <input type="text" name="bride_name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bride's Age</label>
                                <input type="number" name="bride_age" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bride's Religion</label>
                                <input type="text" name="bride_religion" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                        </div>
                    </div>

                    <div id="massIntentionForm" class="service-form hidden">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Type of Mass</label>
                                <select name="mass_type" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                                    <option value="">Select Mass Type</option>
                                    <option value="thanksgiving">Thanksgiving</option>
                                    <option value="special_intention">Special Intention</option>
                                    <option value="healing">Healing</option>
                                    <option value="repose_soul">Repose of the Soul</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name(s) to be Included in Mass</label>
                                <textarea name="mass_names" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300"></textarea>
                            </div>
                        </div>
                    </div>

                    <div id="blessingForm" class="service-form hidden">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Type of Blessing</label>
                                <select name="blessing_type" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                                    <option value="">Select Blessing Type</option>
                                    <option value="house">House Blessing</option>
                                    <option value="car">Car Blessing</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address/Location</label>
                                <textarea name="blessing_location" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300"></textarea>
                            </div>
                        </div>
                    </div>

                    <div id="confirmationForm" class="service-form hidden">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirmand's Name</label>
                                <input type="text" name="confirmand_name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="confirmand_dob" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Place of Baptism</label>
                                <input type="text" name="baptism_place" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Baptism</label>
                                <input type="date" name="baptism_date" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sponsor's Name</label>
                                <input type="text" name="sponsor_name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                        </div>
                    </div>

                    <div id="sick_callForm" class="service-form hidden">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Patient's Name</label>
                                <input type="text" name="patient_name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Patient's Age</label>
                                <input type="number" name="patient_age" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Patient's Condition</label>
                                <textarea name="patient_condition" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hospital/Location</label>
                                <input type="text" name="location" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Room/Ward Number</label>
                                <input type="text" name="room_number" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contact Person</label>
                                <input type="text" name="contact_person" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Number</label>
                                <input type="text" name="emergency_contact" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            </div>
                        </div>
                    </div>

                    <div class="common-fields hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Date</label>
                        <input type="date" name="preferred_date" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
                    </div>

                    <div class="common-fields hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Time</label>
                        <input type="time" name="preferred_time" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
                    </div>

                    <div class="common-fields hidden">
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
<script>
    function handleServiceTypeChange(value) {
        // Hide all service forms first
        document.querySelectorAll('.service-form').forEach(form => {
            form.classList.add('hidden');
        });

        // Hide common fields initially
        document.querySelectorAll('.common-fields').forEach(field => {
            field.classList.add('hidden');
        });

        // Show the selected form if a service is selected
        if (value && value !== '') {
            const formId = value.includes('mass') ? 'massIntentionForm' : value + 'Form';
            const selectedForm = document.getElementById(formId);
            if (selectedForm) {
                selectedForm.classList.remove('hidden');
                // Show common fields when a service is selected
                document.querySelectorAll('.common-fields').forEach(field => {
                    field.classList.remove('hidden');
                });
            }
        }
    }

</script>
@endsection
