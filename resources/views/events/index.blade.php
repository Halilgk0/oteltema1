@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <!-- Header -->
    <div class="relative bg-[var(--moss-dark)] h-[440px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1469371670807-013ccf25f16a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                 alt="Events"
                 class="photo-grade w-full h-full object-cover opacity-45">
            <div class="absolute inset-0 bg-gradient-to-t from-[var(--ink)] via-[var(--moss-dark)]/40 to-transparent"></div>
        </div>
        @include('partials.mist')
        <div class="godrays"></div>
        @include('partials.canopy-frame', ['side' => 'left'])
        @include('partials.canopy-frame', ['side' => 'right'])
        <div class="pointer-events-none absolute top-0 left-6 md:left-16 opacity-90">
            @include('partials.vine', ['side' => 'left', 'duration' => 6.2])
        </div>
        <div class="pointer-events-none absolute top-0 right-6 md:right-16 opacity-90">
            @include('partials.vine', ['side' => 'right', 'duration' => 5.8])
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="text-[var(--paper)]">
                <span class="type-stamp inline-flex items-center gap-2 text-xs text-[var(--fern)] border border-dashed border-[var(--fern)]/60 bg-black/25 px-3 py-1.5">
                    <i class="fas fa-leaf"></i> Occasions in the wild
                </span>
                <h1 class="text-4xl md:text-6xl font-bold mt-4 mb-4">Special Events</h1>
                <p class="text-lg md:text-xl text-[var(--paper)]/75" style="font-family:'Arvo',serif;">Discover our exclusive events and celebrations</p>
            </div>
        </div>
    </div>
    <div class="relative z-10 -mt-[46px] md:-mt-[68px]">
        @include('partials.canopy-divider', ['color' => 'var(--paper)'])
    </div>

    <!-- Events Section -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-14">
                @foreach($events as $event)
                    <div class="field-card {{ $loop->iteration % 2 === 0 ? 'tilt-r' : 'tilt-l' }}">
                        <div class="tape {{ $loop->iteration % 2 === 0 ? 'tape-r' : 'tape-l' }}"></div>
                        <div class="relative h-64 item-media">
                            @include('partials.vine', ['side' => $loop->even ? 'right' : 'left', 'duration' => 5 + $loop->index % 3])
                            <img src="{{ $event['image'] }}"
                                 alt="{{ $event['title'] }}"
                                 class="photo-grade w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-3">{{ $event['title'] }}</h3>
                            <div class="type-stamp flex items-center flex-wrap gap-x-4 gap-y-1 text-[10px] text-[var(--stone)] mb-4">
                                <span><i class="fas fa-calendar-alt mr-1 text-[var(--rust)]"></i>{{ $event['date'] }}</span>
                                <span><i class="fas fa-clock mr-1 text-[var(--rust)]"></i>{{ $event['time'] }}</span>
                            </div>
                            <p class="text-[var(--stone)] mb-5 leading-relaxed">{{ $event['description'] }}</p>
                            <a href="#" class="type-stamp text-xs text-[var(--ink)] hover:text-[var(--rust)] transition-colors inline-flex items-center gap-2">
                                Learn More <i class="fas fa-arrow-right text-[10px] item-arrow"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="py-20" style="background: var(--paper-deep);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="type-stamp text-xs text-[var(--stone)]">— Let's Plan —</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-3 mb-4">Plan Your Event</h2>
                <p class="text-[var(--stone)]">Contact us to organize your special event</p>
            </div>
            <div class="max-w-3xl mx-auto">
                <div class="field-card p-8 md:p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="type-stamp text-[10px] text-[var(--stone)] mb-4">— Contact Information —</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-[var(--rust)] mr-3"></i>
                                    <span>+1 234 567 890</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-[var(--rust)] mr-3"></i>
                                    <span>events@luxuryhotel.com</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="type-stamp text-[10px] text-[var(--stone)] mb-4">— Event Spaces —</h3>
                            <ul class="space-y-2 text-[var(--ink)]/80">
                                <li class="flex items-center gap-2"><i class="fas fa-circle text-[4px] text-[var(--rust)]"></i>Grand Ballroom (up to 500 guests)</li>
                                <li class="flex items-center gap-2"><i class="fas fa-circle text-[4px] text-[var(--rust)]"></i>Conference Rooms (up to 100 guests)</li>
                                <li class="flex items-center gap-2"><i class="fas fa-circle text-[4px] text-[var(--rust)]"></i>Garden Terrace (up to 200 guests)</li>
                                <li class="flex items-center gap-2"><i class="fas fa-circle text-[4px] text-[var(--rust)]"></i>Private Dining Room (up to 30 guests)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
