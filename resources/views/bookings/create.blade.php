@extends('layouts.app')

@section('title', 'Book ' . $roomType->name)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    <h1 class="text-3xl font-bold mb-6">Book {{ $roomType->name }}</h1>

                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('bookings.store', $roomType) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold">Personal Information</h2>
                                
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>

                            <!-- Booking Details -->
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold">Booking Details</h2>

                                <div>
                                    <label for="check_in" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                                    <input type="date" name="check_in" id="check_in" value="{{ old('check_in') }}" 
                                           min="{{ date('Y-m-d') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="check_out" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                                    <input type="date" name="check_out" id="check_out" value="{{ old('check_out') }}" 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="number_of_guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                                    <input type="number" name="number_of_guests" id="number_of_guests" 
                                           value="{{ old('number_of_guests', 1) }}" 
                                           min="1" max="{{ $roomType->capacity }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div>
                                    <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests</label>
                                    <textarea name="special_requests" id="special_requests" rows="3" 
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('special_requests') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Room Information -->
                        <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                            <h2 class="text-xl font-semibold mb-4">Room Information</h2>
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-medium">{{ $roomType->name }}</h3>
                                    <p class="text-gray-600">Base price per night</p>
                                </div>
                                <div class="text-xl font-bold">${{ number_format($roomType->base_price, 2) }}</div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Proceed to Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 