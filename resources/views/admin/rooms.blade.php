@extends('admin.layout')

@section('title', 'Odalar')

@section('actions')
    <a href="{{ route('admin.room-types.create') }}" class="btn-ticket-outline !py-2 !px-4 !text-[11px]">
        <i class="fas fa-plus"></i> Oda Tipi
    </a>
    <a href="{{ route('admin.rooms.create') }}" class="btn-ticket !py-2 !px-4 !text-[11px]">
        <i class="fas fa-plus"></i> Oda
    </a>
@endsection

@section('content')
    @php
        $roomStatus = [
            'available' => ['Müsait', 'var(--moss)'],
            'occupied' => ['Dolu', 'var(--rust)'],
            'maintenance' => ['Bakımda', 'var(--mustard)'],
        ];
    @endphp

    @if($roomTypes->isEmpty())
        <div class="field-card text-center py-16 px-6">
            <h3 class="text-xl font-bold mb-2">Henüz oda tipi yok</h3>
            <p class="text-[var(--stone)] mb-6">İlk oda tipini ekleyerek başlayın.</p>
            <a href="{{ route('admin.room-types.create') }}" class="btn-ticket !inline-flex">
                <i class="fas fa-plus"></i> Oda Tipi Ekle
            </a>
        </div>
    @endif

    <div class="space-y-10">
        @foreach($roomTypes as $roomType)
            <div class="field-card">
                <div class="grid grid-cols-1 md:grid-cols-[260px_1fr]">
                    <div class="item-media h-52 md:h-full min-h-[13rem]">
                        <img src="{{ $roomType->image }}" alt="{{ $roomType->name }}" class="absolute inset-0 w-full h-full object-cover">
                        <div class="price-stamp">
                            <b>${{ number_format($roomType->base_price, 0) }}</b>
                            <small>/gece</small>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        <div class="flex flex-wrap items-start justify-between gap-3 mb-2">
                            <div>
                                <h2 class="text-2xl font-bold">{{ $roomType->name }}</h2>
                                <p class="type-stamp text-[10px] text-[var(--stone)] mt-1">
                                    {{ $roomType->capacity }} kişilik · {{ $roomType->rooms->count() }} oda
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.room-types.edit', $roomType) }}"
                                   class="btn-ticket-outline !py-1.5 !px-3 !text-[10px]">
                                    <i class="fas fa-pen"></i> Düzenle
                                </a>
                                <form action="{{ route('admin.room-types.delete', $roomType) }}" method="POST"
                                      onsubmit="return confirm('Bu oda tipini silmek istediğinizden emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-ticket-outline !py-1.5 !px-3 !text-[10px] !border-[var(--rust)] !text-[var(--rust)] hover:!bg-[var(--rust)] hover:!text-[var(--paper)]">
                                        <i class="fas fa-trash"></i> Sil
                                    </button>
                                </form>
                            </div>
                        </div>

                        <p class="text-sm text-[var(--stone)] mb-4">{{ Str::limit($roomType->description, 160) }}</p>

                        @if($roomType->amenities->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-5">
                                @foreach($roomType->amenities as $amenity)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-[var(--paper-deep)] border border-[var(--paper-dark)]">
                                        {!! $amenity->icon !!} {{ $amenity->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <div class="pt-4 border-t-2 border-dashed border-[var(--paper-dark)]">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <h3 class="type-stamp text-xs text-[var(--stone)]">— Odalar —</h3>
                                <a href="{{ route('admin.rooms.create', ['room_type_id' => $roomType->id]) }}"
                                   class="type-stamp text-xs text-[var(--ink)] hover:text-[var(--rust)] transition-colors">
                                    <i class="fas fa-plus text-[10px]"></i> Bu tipe oda ekle
                                </a>
                            </div>

                            @if($roomType->rooms->isEmpty())
                                <p class="text-sm text-[var(--stone)]">Bu tipte henüz oda yok.</p>
                            @else
                                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3">
                                    @foreach($roomType->rooms->sortBy('room_number') as $room)
                                        @php [$label, $color] = $roomStatus[$room->status] ?? [$room->status, 'var(--stone)']; @endphp
                                        <div class="flex items-center justify-between gap-3 border border-dashed border-[var(--paper-dark)] bg-[var(--paper)] px-3 py-2.5">
                                            <div class="min-w-0">
                                                <div class="font-bold">Oda {{ $room->room_number }}</div>
                                                <div class="flex flex-wrap items-center gap-2 mt-1">
                                                    <span class="type-stamp text-[9px] px-1.5 py-0.5 border-2 border-dashed"
                                                          style="border-color: {{ $color }}; color: {{ $color }};">{{ $label }}</span>
                                                    <span class="text-[11px] {{ $room->is_clean ? 'text-[var(--moss)]' : 'text-[var(--rust)]' }}">
                                                        <i class="fas {{ $room->is_clean ? 'fa-broom' : 'fa-triangle-exclamation' }}"></i>
                                                        {{ $room->is_clean ? 'Temiz' : 'Temizlik gerekli' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-1 flex-shrink-0">
                                                <a href="{{ route('admin.rooms.edit', $room) }}" aria-label="Odayı düzenle"
                                                   class="w-8 h-8 flex items-center justify-center text-[var(--ink)] hover:bg-[var(--paper-deep)]">
                                                    <i class="fas fa-pen text-xs"></i>
                                                </a>
                                                <form action="{{ route('admin.rooms.delete', $room) }}" method="POST"
                                                      onsubmit="return confirm('Bu oda silinsin mi?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" aria-label="Odayı sil"
                                                            class="w-8 h-8 flex items-center justify-center text-[var(--rust)] hover:bg-[var(--paper-deep)]">
                                                        <i class="fas fa-trash text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
