@extends('layouts.app')

@section('title', $roomType->name)

@section('content')
    <!-- Room Details -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="field-card">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                <!-- Image Section -->
                <div class="relative h-96 lg:h-full item-media group">
                    @include('partials.vine', ['side' => 'left', 'duration' => 6])
                    @include('partials.vine', ['side' => 'right', 'duration' => 7])
                    <img src="{{ $roomType->image ?? 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80' }}"
                         alt="{{ $roomType->name }}"
                         class="photo-grade absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="price-stamp">
                        <b>${{ number_format($roomType->base_price, 0) }}</b>
                        <small>/night</small>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="p-8 lg:p-10">
                    <span class="type-stamp text-xs text-[var(--stone)]">— Room —</span>
                    <h1 class="text-3xl font-bold mb-5 mt-2">{{ $roomType->name }}</h1>

                    <div class="flex flex-wrap gap-6 mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[var(--rust)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="text-[var(--stone)] text-sm">{{ $availableRooms }} rooms available</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[var(--rust)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-[var(--stone)] text-sm">Up to {{ $roomType->capacity }} guests</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="type-stamp text-[10px] text-[var(--stone)] mb-2">— Description —</h2>
                        <p class="text-[var(--ink)]/80 leading-relaxed">{{ $roomType->description }}</p>
                    </div>

                    <div class="mb-8">
                        <h2 class="type-stamp text-[10px] text-[var(--stone)] mb-3">— Amenities —</h2>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($roomType->amenities as $amenity)
                                <div class="flex items-center bg-[var(--paper-deep)] border border-[var(--paper-dark)] px-3 py-2 text-sm">
                                    @if($amenity->icon)
                                        <span class="mr-2 text-[var(--rust)]">{!! $amenity->icon !!}</span>
                                    @endif
                                    <span>{{ $amenity->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t-2 border-dashed border-[var(--paper-dark)] pt-6">
                        <div class="flex items-center justify-end">
                            <a href="{{ route('bookings.create', $roomType) }}"
                               class="btn-ticket !px-8 !py-3.5">
                                Book Now <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
