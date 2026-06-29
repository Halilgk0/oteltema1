@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="mb-4">
                            <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Booking Confirmed!</h1>
                        <p class="text-gray-600">Your booking has been successfully processed.</p>
                    </div>

                    <div class="border-t border-b border-gray-200 py-6 mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Booking Details -->
                            <div>
                                <h2 class="text-lg font-semibold mb-4">Booking Details</h2>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Booking Reference</dt>
                                        <dd class="mt-1 text-sm text-gray-900">#{{ $booking->id }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Check-in Date</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $booking->check_in->format('F j, Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Check-out Date</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $booking->check_out->format('F j, Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Number of Guests</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $booking->number_of_guests }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Guest Information -->
                            <div>
                                <h2 class="text-lg font-semibold mb-4">Guest Information</h2>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Guest Name</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $booking->customer->full_name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $booking->customer->email }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $booking->customer->phone }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <h2 class="text-lg font-semibold mb-4">Price Summary</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Room Rate ({{ $booking->duration }} nights)</span>
                                <span class="font-medium">${{ number_format($booking->total_price, 2) }}</span>
                            </div>
                            <div class="border-t pt-3 flex justify-between items-center">
                                <span class="text-lg font-semibold">Total Amount</span>
                                <span class="text-xl font-bold">${{ number_format($booking->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-600 mb-4">A confirmation email has been sent to {{ $booking->customer->email }}</p>
                        <a href="{{ route('home') }}" 
                           class="inline-block bg-gray-900 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                            Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 