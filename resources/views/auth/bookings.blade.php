@extends('layouts.app')

@section('title', 'Rezervasyonlarım')

@section('content')
<div class="py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="type-stamp text-xs text-[var(--stone)]">— Guest Log —</span>
            <h1 class="text-3xl md:text-4xl font-bold mt-3">Rezervasyonlarım</h1>
        </div>

        @if(session('success'))
            <div class="border-2 border-dashed border-[var(--moss)] bg-[var(--paper-deep)] text-[var(--moss)] px-4 py-3 mb-8 text-sm max-w-3xl mx-auto">
                <i class="fas fa-circle-check mr-1"></i>{{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="border-2 border-dashed border-[var(--rust)] bg-[var(--paper-deep)] text-[var(--rust)] px-4 py-3 mb-8 text-sm max-w-3xl mx-auto">
                @foreach($errors->all() as $error)
                    <p><i class="fas fa-triangle-exclamation mr-1"></i>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if($bookings->isEmpty())
            <div class="field-card text-center py-16 px-6">
                <div class="w-16 h-16 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center mx-auto mb-5">
                    <i class="fas fa-calendar-times text-2xl text-[var(--rust)]"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Henüz rezervasyonunuz bulunmuyor</h3>
                <p class="text-[var(--stone)] mb-6">Hemen bir oda rezervasyonu yapın ve konforlu bir konaklama deneyimi yaşayın.</p>
                <a href="{{ route('rooms') }}" class="btn-ticket !inline-flex">
                    Odaları İncele <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="field-card {{ $loop->even ? 'tilt-r' : 'tilt-l' }} p-6">
                        <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                            <div>
                                <h3 class="text-xl font-bold">{{ $booking->room->roomType->name }}</h3>
                                <p class="text-sm text-[var(--stone)]">Oda No: {{ $booking->room->room_number }}</p>
                            </div>
                            <span class="type-stamp text-[10px] px-3 py-1.5 border-2 border-dashed whitespace-nowrap
                                @if($booking->status === 'confirmed') border-[var(--moss)] text-[var(--moss)]
                                @elseif($booking->status === 'pending') border-[var(--mustard)] text-[var(--mustard)]
                                @elseif($booking->status === 'cancelled') border-[var(--rust)] text-[var(--rust)]
                                @else border-[var(--stone)] text-[var(--stone)] @endif">
                                {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 border-t border-dashed border-[var(--paper-dark)] text-sm">
                            <div>
                                <p class="type-stamp text-[9px] text-[var(--stone)]">Tarih</p>
                                <p class="font-medium">{{ $booking->check_in->format('d.m.Y') }}</p>
                                <p class="text-[var(--stone)]">{{ $booking->check_out->format('d.m.Y') }} ({{ $booking->duration }} gece)</p>
                            </div>
                            <div>
                                <p class="type-stamp text-[9px] text-[var(--stone)]">Misafir Sayısı</p>
                                <p class="font-medium">{{ $booking->number_of_guests }} kişi</p>
                            </div>
                            <div>
                                <p class="type-stamp text-[9px] text-[var(--stone)]">Toplam Ücret</p>
                                <p class="font-bold">${{ number_format($booking->total_price, 2) }}</p>
                            </div>
                        </div>

                        @if(in_array($booking->status, ['pending', 'confirmed']) && $booking->check_in->isFuture())
                            <div class="mt-4 pt-4 border-t border-dashed border-[var(--paper-dark)] text-right">
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST"
                                      onsubmit="return confirm('Bu rezervasyonu iptal etmek istediğinize emin misiniz?');">
                                    @csrf
                                    <button type="submit" class="btn-ticket-outline !border-[var(--rust)] !text-[var(--rust)] hover:!bg-[var(--rust)] hover:!text-[var(--paper)] !py-2 !px-4 !text-[11px]">
                                        <i class="fas fa-ban mr-1"></i> Rezervasyonu İptal Et
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
