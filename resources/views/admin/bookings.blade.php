@extends('admin.layout')

@section('title', 'Rezervasyonlar')

@section('content')
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-10">
        @php
            $cards = [
                ['label' => 'Toplam', 'value' => $stats['total_bookings'], 'icon' => 'fa-book-open', 'color' => 'var(--ink)'],
                ['label' => 'Onaylı', 'value' => $stats['confirmed_bookings'], 'icon' => 'fa-circle-check', 'color' => 'var(--moss)'],
                ['label' => 'Bekleyen', 'value' => $stats['pending_bookings'], 'icon' => 'fa-hourglass-half', 'color' => 'var(--mustard)'],
                ['label' => 'İptal', 'value' => $stats['cancelled_bookings'], 'icon' => 'fa-ban', 'color' => 'var(--rust)'],
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
        <div class="p-5 sm:p-6 border-b-2 border-dashed border-[var(--paper-dark)]">
            <h2 class="text-lg font-bold">Tüm Rezervasyonlar</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="adm-table w-full text-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Misafir</th>
                        <th>Oda</th>
                        <th>Tarih</th>
                        <th>Detay</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td class="whitespace-nowrap">
                                <div class="font-bold">#{{ $booking->id }}</div>
                                <div class="text-xs text-[var(--stone)]">{{ $booking->created_at->format('d.m.Y H:i') }}</div>
                            </td>
                            <td>
                                <div class="font-semibold">{{ $booking->customer->name }}</div>
                                <div class="text-xs text-[var(--stone)]">{{ $booking->customer->email }}</div>
                                <div class="text-xs text-[var(--stone)]">{{ $booking->customer->phone }}</div>
                            </td>
                            <td>
                                <div>{{ $booking->room->roomType->name }}</div>
                                <div class="text-xs text-[var(--stone)]">Oda {{ $booking->room->room_number }}</div>
                            </td>
                            <td class="whitespace-nowrap">
                                <div><i class="fas fa-sign-in-alt text-[var(--moss)] text-xs mr-1"></i>{{ $booking->check_in->format('d.m.Y') }}</div>
                                <div><i class="fas fa-sign-out-alt text-[var(--rust)] text-xs mr-1"></i>{{ $booking->check_out->format('d.m.Y') }}</div>
                                <div class="text-xs text-[var(--stone)] mt-1">{{ $booking->duration }} gece</div>
                            </td>
                            <td class="whitespace-nowrap">
                                <div>{{ $booking->number_of_guests }} misafir</div>
                                <div class="font-bold">${{ number_format($booking->total_price, 2) }}</div>
                            </td>
                            <td>@include('admin.partials.status', ['status' => $booking->status])</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-[var(--stone)] py-10">Henüz rezervasyon bulunmuyor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
            <div class="pager px-5 sm:px-6 py-4 border-t-2 border-dashed border-[var(--paper-dark)]">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
@endsection
