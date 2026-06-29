@extends('layouts.app')

@section('title', $roomType->name)

@section('content')
    <!-- Room Details -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Image Section -->
                <div class="relative h-96 lg:h-full">
                    <img src="{{ $roomType->image ?? 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80' }}" 
                         alt="{{ $roomType->name }}" 
                         class="absolute inset-0 w-full h-full object-cover">
                </div>

                <!-- Details Section -->
                <div class="p-8">
                    <h1 class="text-3xl font-bold mb-4">{{ $roomType->name }}</h1>
                    
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="text-gray-600">{{ $availableRooms }} rooms available</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-gray-600">Up to {{ $roomType->capacity }} guests</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Description</h2>
                        <p class="text-gray-600">{{ $roomType->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Amenities</h2>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($roomType->amenities as $amenity)
                                <div class="flex items-center">
                                    @if($amenity->icon)
                                        <span class="mr-2">{!! $amenity->icon !!}</span>
                                    @endif
                                    <span>{{ $amenity->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <span class="text-2xl font-bold">${{ number_format($roomType->base_price, 2) }}</span>
                                <span class="text-gray-600">/night</span>
                            </div>
                            <a href="{{ route('bookings.create', $roomType) }}" 
                               class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 