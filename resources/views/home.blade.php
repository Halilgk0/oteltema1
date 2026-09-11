@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-[var(--moss-dark)] h-[680px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                 alt="Luxury Hotel"
                 class="photo-grade w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-t from-[var(--ink)] via-[var(--moss-dark)]/50 to-[var(--moss-dark)]/20"></div>
        </div>
        @include('partials.mist')
        <div class="godrays"></div>
        @include('partials.canopy-frame', ['side' => 'left'])
        @include('partials.canopy-frame', ['side' => 'right'])

        <div class="pointer-events-none absolute top-0 left-4 md:left-10 opacity-90">
            @include('partials.vine', ['side' => 'left', 'duration' => 6.5])
        </div>
        <div class="pointer-events-none absolute top-0 left-20 md:left-28 hidden sm:block opacity-80">
            @include('partials.vine', ['side' => 'left', 'duration' => 8.4])
        </div>
        <div class="pointer-events-none absolute top-0 right-4 md:right-10 opacity-90">
            @include('partials.vine', ['side' => 'right', 'duration' => 5.5])
        </div>
        <div class="pointer-events-none absolute top-0 right-20 md:right-28 hidden sm:block opacity-80">
            @include('partials.vine', ['side' => 'right', 'duration' => 7.1])
        </div>
        <div class="pointer-events-none absolute top-0 left-1/3 hidden lg:block opacity-70">
            @include('partials.vine', ['side' => 'left', 'duration' => 7.2])
        </div>
        <div class="pointer-events-none absolute top-0 right-1/3 hidden lg:block opacity-70">
            @include('partials.vine', ['side' => 'right', 'duration' => 6.9])
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="text-[var(--paper)] max-w-2xl" data-aos="fade-up">
                <span class="type-stamp inline-flex items-center gap-2 text-xs text-[var(--fern)] mb-5 border border-dashed border-[var(--fern)]/60 bg-black/25 px-3 py-1.5">
                    <i class="fas fa-leaf"></i> Est. deep in the wild
                </span>
                <h1 class="text-4xl md:text-6xl font-bold mb-5 leading-tight">Welcome to Luxury Hotel</h1>
                <p class="text-lg md:text-xl mb-9 text-[var(--paper)]/75 font-normal" style="font-family:'Arvo',serif;">Where fog settles low in the canopy, and every room breathes green</p>
                <a href="#room-types" class="btn-ticket">
                    View Our Rooms
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="relative z-10 -mt-[46px] md:-mt-[68px]">
        @include('partials.canopy-divider', ['color' => 'var(--paper)'])
    </div>

    <!-- Room Types Section with Slider -->
    <div id="room-types" class="py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="type-stamp text-xs text-[var(--stone)]">— Field Notes, No. 01 —</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-3">Our Luxury Rooms</h2>
            </div>

            <!-- Swiper -->
            <div class="swiper roomSwiper !overflow-visible">
                <div class="swiper-wrapper !items-stretch">
                    @foreach($allRoomTypes as $roomType)
                        <div class="swiper-slide h-auto">
                            <div class="field-card {{ $loop->even ? 'tilt-r' : 'tilt-l' }} h-full">
                                <div class="tape {{ $loop->even ? 'tape-r' : 'tape-l' }}"></div>
                                <div class="relative h-[380px] item-media overflow-hidden">
                                    @include('partials.vine', ['side' => $loop->even ? 'right' : 'left', 'duration' => 5 + $loop->index % 3])
                                    <img src="{{ $roomType->image }}"
                                         alt="{{ $roomType->name }}"
                                         class="absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                    <div class="price-stamp">
                                        <b>${{ number_format($roomType->base_price, 0) }}</b>
                                        <small>/night</small>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 p-5">
                                        <h3 class="text-2xl font-bold text-[var(--paper)]">{{ $roomType->name }}</h3>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <p class="text-[var(--stone)] mb-5 leading-relaxed">{{ Str::limit($roomType->description, 140) }}</p>

                                    <!-- Amenities -->
                                    <div class="mb-6">
                                        <h4 class="type-stamp text-[10px] text-[var(--stone)] mb-3">— Room Features —</h4>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div class="flex items-center text-sm text-[var(--ink)]">
                                                <i class="fas fa-user-friends mr-2 text-[var(--rust)]"></i>
                                                <span>Up to {{ $roomType->capacity }} guests</span>
                                            </div>
                                            @foreach($roomType->amenities->take(3) as $amenity)
                                                <div class="flex items-center text-sm text-[var(--ink)]">
                                                    {!! $amenity->icon !!}
                                                    <span class="ml-2">{{ $amenity->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center pt-3 border-t border-dashed border-[var(--paper-dark)]">
                                        <a href="{{ route('rooms.show', $roomType) }}"
                                           class="type-stamp text-xs text-[var(--ink)] hover:text-[var(--rust)] transition-colors inline-flex items-center gap-2">
                                            Details <i class="fas fa-arrow-right text-[10px] item-arrow"></i>
                                        </a>
                                        <a href="{{ route('bookings.create', $roomType) }}"
                                           class="btn-ticket !py-2 !px-4 !text-[11px]">
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

    <!-- Stats Strip -->
    <div class="relative py-14 overflow-hidden" style="background: var(--moss-dark);">
        @include('partials.mist')
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-[var(--paper)]" style="font-family:'Playfair Display',serif;">28</div>
                    <div class="type-stamp text-[10px] text-[var(--fern)] mt-2">Years in the Wild</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-[var(--paper)]" style="font-family:'Playfair Display',serif;">340</div>
                    <div class="type-stamp text-[10px] text-[var(--fern)] mt-2">Hectares of Canopy</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-[var(--paper)]" style="font-family:'Playfair Display',serif;">96</div>
                    <div class="type-stamp text-[10px] text-[var(--fern)] mt-2">Bird Species Logged</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-[var(--paper)]" style="font-family:'Playfair Display',serif;">12</div>
                    <div class="type-stamp text-[10px] text-[var(--fern)] mt-2">Rooms Deep in the Trees</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 border-y-2 border-dashed border-[var(--paper-dark)]" style="background: var(--paper-deep);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="type-stamp text-xs text-[var(--stone)]">— In Harmony With Nature —</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-3">Why Choose Us</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="field-card text-center p-8" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 rounded-full border-2 border-dashed border-[var(--moss)] flex items-center justify-center mx-auto mb-5">
                        <i class="fas fa-spa text-2xl text-[var(--moss)]"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Luxury Service</h3>
                    <p class="text-[var(--stone)]">Experience the finest amenities and services</p>
                </div>
                <div class="field-card text-center p-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 rounded-full border-2 border-dashed border-[var(--moss)] flex items-center justify-center mx-auto mb-5">
                        <i class="fas fa-feather text-2xl text-[var(--moss)]"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">24/7 Service</h3>
                    <p class="text-[var(--stone)]">Round-the-clock support for your needs</p>
                </div>
                <div class="field-card text-center p-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 rounded-full border-2 border-dashed border-[var(--moss)] flex items-center justify-center mx-auto mb-5">
                        <i class="fas fa-seedling text-2xl text-[var(--moss)]"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Best Rates</h3>
                    <p class="text-[var(--stone)]">Competitive prices for luxury stays</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Wildlife & Wonders -->
    <div class="py-20 relative overflow-hidden" style="background: var(--paper);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="type-stamp text-xs text-[var(--stone)]">— Field Notes, No. 02 —</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-3">Wildlife &amp; Wonders</h2>
                <p class="text-[var(--stone)] mt-3 max-w-xl mx-auto">Just beyond the veranda, the reserve keeps its own residents — here is what our guides most often spot on the trail.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-14">
                <div class="field-card tilt-l text-center p-6">
                    <div class="w-14 h-14 rounded-full border-2 border-dashed border-[var(--teal)] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-dove text-xl text-[var(--teal)]"></i>
                    </div>
                    <h3 class="font-bold mb-1">Toucans &amp; Songbirds</h3>
                    <p class="text-sm text-[var(--stone)]">Dawn chorus starts at first light, right outside your window.</p>
                </div>
                <div class="field-card tilt-r text-center p-6">
                    <div class="w-14 h-14 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-water text-xl text-[var(--rust)]"></i>
                    </div>
                    <h3 class="font-bold mb-1">Hidden Waterfalls</h3>
                    <p class="text-sm text-[var(--stone)]">A forty-minute trail leads to a curtain falls few tourists ever find.</p>
                </div>
                <div class="field-card tilt-l text-center p-6">
                    <div class="w-14 h-14 rounded-full border-2 border-dashed border-[var(--moss)] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tree text-xl text-[var(--moss)]"></i>
                    </div>
                    <h3 class="font-bold mb-1">Canopy Walkways</h3>
                    <p class="text-sm text-[var(--stone)]">Rope bridges strung 20 metres up, level with the treetop birds.</p>
                </div>
                <div class="field-card tilt-r text-center p-6">
                    <div class="w-14 h-14 rounded-full border-2 border-dashed border-[var(--mustard)] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-moon text-xl text-[var(--mustard)]"></i>
                    </div>
                    <h3 class="font-bold mb-1">Night Safaris</h3>
                    <p class="text-sm text-[var(--stone)]">Guided walks after dusk, when the fireflies and frogs take over.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="py-20" style="background: var(--paper);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="type-stamp text-xs text-[var(--stone)]">— Get In Touch —</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-3 mb-4">Need Help?</h2>
                <p class="text-[var(--stone)]">Contact us for any questions or special requests</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="field-card p-8">
                    <div class="w-12 h-12 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-xl text-[var(--rust)]"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Phone</h3>
                    <p class="text-[var(--stone)]">+1 234 567 890</p>
                </div>
                <div class="field-card p-8">
                    <div class="w-12 h-12 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-xl text-[var(--rust)]"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Email</h3>
                    <p class="text-[var(--stone)]">info@luxuryhotel.com</p>
                </div>
                <div class="field-card p-8">
                    <div class="w-12 h-12 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-xl text-[var(--rust)]"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Location</h3>
                    <p class="text-[var(--stone)]">123 Luxury Street, City</p>
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
