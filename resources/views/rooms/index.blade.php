@extends('layouts.app')

@section('title', 'Our Rooms')

@section('content')
    <!-- Header -->
    <div class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-white text-center">Our Rooms</h1>
        </div>
    </div>

    <!-- Room Types Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($roomTypes as $roomType)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden"
                     data-aos="fade-up"
                     data-aos-delay="{{ $loop->index * 200 }}"
                     data-aos-duration="1200">
                    <img src="{{ $roomType->image ?? 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80' }}" 
                         alt="{{ $roomType->name }}" 
                         class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2">{{ $roomType->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($roomType->description, 150) }}</p>
                        
                        <!-- Amenities -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2">Amenities</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($roomType->amenities as $amenity)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        @if($amenity->icon)
                                            <span class="mr-1">{!! $amenity->icon !!}</span>
                                        @endif
                                        {{ $amenity->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold">${{ number_format($roomType->base_price, 2) }}</span>
                                <span class="text-gray-600">/night</span>
                            </div>
                            <div class="space-x-2">
                                <a href="{{ route('rooms.show', $roomType) }}" 
                                   class="inline-block bg-gray-900 text-white px-4 py-2 rounded font-semibold hover:bg-gray-800 transition-colors">
                                    View Details
                                </a>
                                <a href="{{ route('bookings.create', $roomType) }}" 
                                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700 transition-colors">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection 