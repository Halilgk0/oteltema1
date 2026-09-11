@extends('layouts.app')

@section('title', 'Our Rooms')

@section('content')
    <!-- Header -->
    <div class="relative bg-[var(--moss-dark)] py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-[var(--ink)]/40 to-transparent"></div>
        @include('partials.mist')
        <div class="godrays"></div>
        @include('partials.canopy-frame', ['side' => 'left'])
        @include('partials.canopy-frame', ['side' => 'right'])
        <div class="pointer-events-none absolute top-0 left-6 md:left-16 opacity-90">
            @include('partials.vine', ['side' => 'left', 'duration' => 6])
        </div>
        <div class="pointer-events-none absolute top-0 left-24 md:left-40 hidden sm:block opacity-70">
            @include('partials.vine', ['side' => 'left', 'duration' => 8])
        </div>
        <div class="pointer-events-none absolute top-0 right-6 md:right-16 opacity-90">
            @include('partials.vine', ['side' => 'right', 'duration' => 6.8])
        </div>
        <div class="pointer-events-none absolute top-0 right-24 md:right-40 hidden sm:block opacity-70">
            @include('partials.vine', ['side' => 'right', 'duration' => 7.6])
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="type-stamp inline-flex items-center gap-2 text-xs text-[var(--fern)] border border-dashed border-[var(--fern)]/60 bg-black/25 px-3 py-1.5">
                <i class="fas fa-leaf"></i> Deep in the canopy
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-[var(--paper)] mt-4">Our Rooms</h1>
            <p class="text-[var(--paper)]/70 mt-3 max-w-lg mx-auto" style="font-family:'Arvo',serif;">Twelve rooms, each with its own view of the canopy — pick the one that calls to you.</p>
        </div>
    </div>
    <div class="relative z-10 -mt-[46px] md:-mt-[68px]">
        @include('partials.canopy-divider', ['color' => 'var(--paper)'])
    </div>

    <!-- Room Types Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-14">
            @foreach($roomTypes as $roomType)
                <div class="field-card {{ $loop->iteration % 2 === 0 ? 'tilt-r' : 'tilt-l' }}">
                    <div class="tape {{ $loop->iteration % 2 === 0 ? 'tape-r' : 'tape-l' }}"></div>
                    <div class="item-media h-64">
                        @include('partials.vine', ['side' => $loop->even ? 'right' : 'left', 'duration' => 5 + $loop->index % 3])
                        <img src="{{ $roomType->image ?? 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80' }}"
                             alt="{{ $roomType->name }}"
                             class="w-full h-full object-cover">
                        <div class="price-stamp">
                            <b>${{ number_format($roomType->base_price, 0) }}</b>
                            <small>/night</small>
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2">{{ $roomType->name }}</h2>
                        <p class="text-[var(--stone)] mb-4 leading-relaxed">{{ Str::limit($roomType->description, 150) }}</p>

                        <!-- Amenities -->
                        <div class="mb-5">
                            <h3 class="type-stamp text-[10px] text-[var(--stone)] mb-3">— Amenities —</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($roomType->amenities as $amenity)
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium bg-[var(--paper-deep)] text-[var(--ink)] border border-[var(--paper-dark)]">
                                        @if($amenity->icon)
                                            <span class="mr-1">{!! $amenity->icon !!}</span>
                                        @endif
                                        {{ $amenity->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-dashed border-[var(--paper-dark)]">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('rooms.show', $roomType) }}"
                                   class="type-stamp text-xs text-[var(--ink)] hover:text-[var(--rust)] transition-colors inline-flex items-center gap-1">
                                    Details <i class="fas fa-arrow-right text-[10px] item-arrow"></i>
                                </a>
                            </div>
                            <a href="{{ route('bookings.create', $roomType) }}"
                               class="btn-ticket !py-2 !px-4 !text-[11px]">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- How Booking Works -->
    <div class="py-16 border-t-2 border-dashed border-[var(--paper-dark)]" style="background: var(--paper-deep);">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="type-stamp text-xs text-[var(--stone)]">— How It Works —</span>
                <h2 class="text-2xl md:text-3xl font-bold mt-3">From Trailhead to Room Key</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="type-stamp text-3xl text-[var(--rust)] mb-3">01</div>
                    <h3 class="font-bold mb-1">Pick Your Room</h3>
                    <p class="text-sm text-[var(--stone)]">Browse the field notes above and find the room that suits your trip.</p>
                </div>
                <div>
                    <div class="type-stamp text-3xl text-[var(--rust)] mb-3">02</div>
                    <h3 class="font-bold mb-1">Choose Your Dates</h3>
                    <p class="text-sm text-[var(--stone)]">Tell us when you're arriving and how many are in your party.</p>
                </div>
                <div>
                    <div class="type-stamp text-3xl text-[var(--rust)] mb-3">03</div>
                    <h3 class="font-bold mb-1">Confirm &amp; Pack</h3>
                    <p class="text-sm text-[var(--stone)]">We'll hold your room and send everything you need before arrival.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
