@extends('layouts.app')

@section('title', 'Profilim')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Profil Bilgileri -->
            <div class="md:col-span-1">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="text-center mb-6">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff" 
                                 alt="{{ $user->name }}"
                                 class="h-24 w-24 rounded-full mx-auto mb-4">
                            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                            <p class="text-gray-600">Üye since {{ $user->created_at->format('M Y') }}</p>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="mt-1 text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Telefon</label>
                                <p class="mt-1 text-gray-900">{{ $user->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rezervasyonlar -->
            <div class="md:col-span-3">
                <!-- Aktif Rezervasyonlar -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Aktif Rezervasyonlar</h3>
                        @php
                            $activeBookings = $user->bookings()
                                ->whereIn('status', ['pending', 'confirmed'])
                                ->where('check_out', '>=', now())
                                ->orderBy('check_in')
                                ->get();
                        @endphp

                        @if($activeBookings->isEmpty())
                            <p class="text-gray-500">Aktif rezervasyonunuz bulunmuyor.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($activeBookings as $booking)
                                    <div class="border rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold">{{ $booking->room->roomType->name }}</h4>
                                                <p class="text-sm text-gray-600">Oda No: {{ $booking->room->room_number }}</p>
                                            </div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                        <div class="mt-2 grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <p class="text-gray-600">Check-in</p>
                                                <p class="font-medium">{{ $booking->check_in->format('d M Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600">Check-out</p>
                                                <p class="font-medium">{{ $booking->check_out->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 text-sm">
                                            <p class="text-gray-600">Toplam</p>
                                            <p class="font-medium">${{ number_format($booking->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Geçmiş Rezervasyonlar -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Geçmiş Rezervasyonlar</h3>
                        @php
                            $pastBookings = $user->bookings()
                                ->where(function($query) {
                                    $query->where('check_out', '<', now())
                                        ->orWhere('status', 'cancelled');
                                })
                                ->orderBy('check_in', 'desc')
                                ->get();
                        @endphp

                        @if($pastBookings->isEmpty())
                            <p class="text-gray-500">Geçmiş rezervasyonunuz bulunmuyor.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($pastBookings as $booking)
                                    <div class="border rounded-lg p-4 @if($booking->status === 'cancelled') bg-gray-50 @endif">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold">{{ $booking->room->roomType->name }}</h4>
                                                <p class="text-sm text-gray-600">Oda No: {{ $booking->room->room_number }}</p>
                                            </div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($booking->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                        <div class="mt-2 grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <p class="text-gray-600">Check-in</p>
                                                <p class="font-medium">{{ $booking->check_in->format('d M Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600">Check-out</p>
                                                <p class="font-medium">{{ $booking->check_out->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 text-sm">
                                            <p class="text-gray-600">Toplam</p>
                                            <p class="font-medium">${{ number_format($booking->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 