@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-900 h-[600px]">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                 alt="Luxury Hotel" 
                 class="w-full h-full object-cover opacity-50">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to Luxury Hotel</h1>
                <p class="text-xl md:text-2xl mb-8">Experience unparalleled luxury and comfort</p>
                <a href="#room-types" 
                   class="inline-block bg-white text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    View Our Rooms
                </a>
            </div>
        </div>
    </div>

    <!-- Room Types Section with Slider -->
    <div id="room-types" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Our Luxury Rooms</h2>
            
            <!-- Swiper -->
            <div class="swiper roomSwiper">
                <div class="swiper-wrapper">
                    @foreach($allRoomTypes as $roomType)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="relative h-[400px]">
                                    <img src="{{ $roomType->image }}" 
                                         alt="{{ $roomType->name }}" 
                                         class="absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                        <h3 class="text-2xl font-bold mb-2">{{ $roomType->name }}</h3>
                                        <div class="flex items-center mb-4">
                                            <span class="text-xl font-bold">${{ number_format($roomType->base_price, 2) }}</span>
                                            <span class="ml-2">/night</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <p class="text-gray-600 mb-4">{{ Str::limit($roomType->description, 150) }}</p>
                                    
                                    <!-- Amenities -->
                                    <div class="mb-6">
                                        <h4 class="text-lg font-semibold mb-3">Room Features</h4>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div class="flex items-center text-gray-600">
                                                <i class="fas fa-user-friends mr-2"></i>
                                                <span>Up to {{ $roomType->capacity }} guests</span>
                                            </div>
                                            @foreach($roomType->amenities->take(3) as $amenity)
                                                <div class="flex items-center text-gray-600">
                                                    {!! $amenity->icon !!}
                                                    <span class="ml-2">{{ $amenity->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('rooms.show', $roomType) }}" 
                                           class="inline-block bg-gray-900 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                                            View Details
                                        </a>
                                        <a href="{{ route('bookings.create', $roomType) }}" 
                                           class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Why Choose Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-concierge-bell text-2xl text-gray-900"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Luxury Service</h3>
                    <p class="text-gray-600">Experience the finest amenities and services</p>
                </div>
                <div class="text-center">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl text-gray-900"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">24/7 Service</h3>
                    <p class="text-gray-600">Round-the-clock support for your needs</p>
                </div>
                <div class="text-center">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tag text-2xl text-gray-900"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Best Rates</h3>
                    <p class="text-gray-600">Competitive prices for luxury stays</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Need Help?</h2>
                <p class="text-gray-600">Contact us for any questions or special requests</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-xl text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Phone</h3>
                    <p class="text-gray-600">+1 234 567 890</p>
                </div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-xl text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Email</h3>
                    <p class="text-gray-600">info@luxuryhotel.com</p>
                </div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-xl text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Location</h3>
                    <p class="text-gray-600">123 Luxury Street, City</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var swiper = new Swiper(".roomSwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        speed: 1000,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
@endsection 