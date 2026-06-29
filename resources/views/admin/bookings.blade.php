@extends('admin.layout')

@section('title', 'Rezervasyonlar')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                    <i class="fas fa-calendar-check text-2xl text-blue-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Toplam Rezervasyon</h3>
                    <p class="text-2xl font-semibold">{{ $stats['total_bookings'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 bg-opacity-10">
                    <i class="fas fa-check-circle text-2xl text-green-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Onaylı</h3>
                    <p class="text-2xl font-semibold">{{ $stats['confirmed_bookings'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-500 bg-opacity-10">
                    <i class="fas fa-clock text-2xl text-yellow-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Bekleyen</h3>
                    <p class="text-2xl font-semibold">{{ $stats['pending_bookings'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-500 bg-opacity-10">
                    <i class="fas fa-times-circle text-2xl text-red-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">İptal Edilen</h3>
                    <p class="text-2xl font-semibold">{{ $stats['cancelled_bookings'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold">Tüm Rezervasyonlar</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rezervasyon No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Müşteri Bilgileri
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Oda Bilgileri
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tarih
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Detaylar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Durum
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    #{{ $booking->id }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $booking->created_at->format('d.m.Y H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $booking->customer->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $booking->customer->email }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $booking->customer->phone }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $booking->room->roomType->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    Oda No: {{ $booking->room->room_number }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <div class="flex items-center">
                                        <i class="fas fa-sign-in-alt text-green-500 mr-1"></i>
                                        {{ $booking->check_in->format('d.m.Y') }}
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-sign-out-alt text-red-500 mr-1"></i>
                                        {{ $booking->check_out->format('d.m.Y') }}
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    {{ $booking->duration }} gece
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $booking->number_of_guests }} Misafir
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    ${{ number_format($booking->total_price, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection 