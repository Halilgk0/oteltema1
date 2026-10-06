@extends('admin.layout')

@section('title', 'Genel Bakış')

@section('actions')
    <a href="{{ route('admin.room-types.create') }}" class="btn-ticket-outline !py-2 !px-4 !text-[11px]">
        <i class="fas fa-plus"></i> Oda Tipi
    </a>
    <a href="{{ route('admin.rooms.create') }}" class="btn-ticket !py-2 !px-4 !text-[11px]">
        <i class="fas fa-plus"></i> Oda
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-10">
        @php
            $cards = [
                ['label' => 'Oda Tipi', 'value' => $stats['total_room_types'], 'icon' => 'fa-leaf', 'color' => 'var(--moss)'],
                ['label' => 'Oda', 'value' => $stats['total_rooms'], 'icon' => 'fa-bed', 'color' => 'var(--teal)'],
                ['label' => 'Rezervasyon', 'value' => $stats['total_bookings'], 'icon' => 'fa-book-open', 'color' => 'var(--rust)'],
                ['label' => 'Bekleyen', 'value' => $stats['pending_bookings'], 'icon' => 'fa-hourglass-half', 'color' => 'var(--mustard)'],
            ];
        @endphp
        @foreach($cards as $card)
            <div class="field-card {{ $loop->even ? 'tilt-r' : 'tilt-l' }} p-4 sm:p-6">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-11 h-11 sm:w-14 sm:h-14 flex-shrink-0 rounded-full border-2 border-dashed flex items-center justify-center"
                         style="border-color: {{ $card['color'] }};">
                        <i class="fas {{ $card['icon'] }} text-base sm:text-xl" style="color: {{ $card['color'] }};"></i>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold" style="font-family:'Playfair Display',serif;">{{ $card['value'] }}</div>
                        <div class="type-stamp text-[10px] text-[var(--stone)]">{{ $card['label'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="field-card">
        <div class="p-5 sm:p-6 flex items-center justify-between gap-4 border-b-2 border-dashed border-[var(--paper-dark)]">
            <h2 class="text-lg font-bold">Son Rezervasyonlar</h2>
            <a href="{{ route('admin.bookings') }}" class="type-stamp text-xs text-[var(--ink)] hover:text-[var(--rust)] transition-colors whitespace-nowrap">
                Tümü <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="adm-table w-full text-sm">
                <thead>
                    <tr>
                        <th>Misafir</th>
                        <th>Oda</th>
                        <th>Giriş</th>
                        <th>Çıkış</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['recent_bookings'] as $booking)
                        <tr>
                            <td>
                                <div class="font-semibold">{{ $booking->customer->name }}</div>
                                <div class="text-xs text-[var(--stone)]">{{ $booking->customer->email }}</div>
                            </td>
                            <td>
                                <div>{{ $booking->room->roomType->name }}</div>
                                <div class="text-xs text-[var(--stone)]">Oda {{ $booking->room->room_number }}</div>
                            </td>
                            <td class="whitespace-nowrap">{{ $booking->check_in->format('d.m.Y') }}</td>
                            <td class="whitespace-nowrap">{{ $booking->check_out->format('d.m.Y') }}</td>
                            <td>@include('admin.partials.status', ['status' => $booking->status])</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-[var(--stone)] py-10">Henüz rezervasyon bulunmuyor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
