@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <!-- Header -->
    <div class="relative bg-gray-900 h-[400px]">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1469371670807-013ccf25f16a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                 alt="Events" 
                 class="w-full h-full object-cover opacity-50">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Special Events</h1>
                <p class="text-xl md:text-2xl">Discover our exclusive events and celebrations</p>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $loop->index * 200 }}">
                        <div class="relative h-64">
                            <img src="{{ $event['image'] }}" 
                                 alt="{{ $event['title'] }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-2">{{ $event['title'] }}</h3>
                            <div class="flex items-center text-gray-600 mb-4">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>{{ $event['date'] }}</span>
                                <i class="fas fa-clock ml-4 mr-2"></i>
                                <span>{{ $event['time'] }}</span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ $event['description'] }}</p>
                            <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Learn More
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Plan Your Event</h2>
                <p class="text-gray-600">Contact us to organize your special event</p>
            </div>
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-bold mb-4">Contact Information</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-600 mr-3"></i>
                                    <span>+1 234 567 890</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-gray-600 mr-3"></i>
                                    <span>events@luxuryhotel.com</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-4">Event Spaces</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li>• Grand Ballroom (up to 500 guests)</li>
                                <li>• Conference Rooms (up to 100 guests)</li>
                                <li>• Garden Terrace (up to 200 guests)</li>
                                <li>• Private Dining Room (up to 30 guests)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 