@php
    $room = $room ?? null;
    $selectedType = old('room_type_id', $room->room_type_id ?? request('room_type_id'));
    $selectedStatus = old('status', $room->status ?? 'available');
    $isClean = (string) old('is_clean', $room ? (int) $room->is_clean : 1);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="room_number" class="adm-label">Oda Numarası</label>
        <input type="text" name="room_number" id="room_number" value="{{ old('room_number', $room->room_number ?? '') }}"
               required placeholder="Örn. 104" class="adm-input">
        @error('room_number') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="room_type_id" class="adm-label">Oda Tipi</label>
        <select name="room_type_id" id="room_type_id" required class="adm-input">
            <option value="">Oda tipi seçin</option>
            @foreach($roomTypes as $roomType)
                <option value="{{ $roomType->id }}" {{ (string) $selectedType === (string) $roomType->id ? 'selected' : '' }}>
                    {{ $roomType->name }}
                </option>
            @endforeach
        </select>
        @error('room_type_id') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <span class="adm-label">Durum</span>
        <div class="flex flex-wrap gap-2">
            @foreach(['available' => ['Müsait', 'fa-door-open'], 'occupied' => ['Dolu', 'fa-bed'], 'maintenance' => ['Bakımda', 'fa-screwdriver-wrench']] as $value => [$label, $icon])
                <label class="cursor-pointer">
                    <input type="radio" name="status" value="{{ $value }}" class="peer sr-only" {{ $selectedStatus === $value ? 'checked' : '' }}>
                    <span class="inline-flex items-center gap-2 px-4 py-2 text-sm border-2 border-dashed border-[var(--paper-dark)] bg-[var(--paper)] transition-colors
                                 peer-checked:bg-[var(--ink)] peer-checked:text-[var(--paper)] peer-checked:border-solid peer-checked:border-[var(--ink)]
                                 peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-[var(--rust)]">
                        <i class="fas {{ $icon }}"></i> {{ $label }}
                    </span>
                </label>
            @endforeach
        </div>
        @error('status') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <span class="adm-label">Temizlik</span>
        <div class="flex flex-wrap gap-2">
            @foreach(['1' => ['Temiz', 'fa-broom'], '0' => ['Temizlik Gerekli', 'fa-triangle-exclamation']] as $value => [$label, $icon])
                <label class="cursor-pointer">
                    <input type="radio" name="is_clean" value="{{ $value }}" class="peer sr-only" {{ $isClean === (string) $value ? 'checked' : '' }}>
                    <span class="inline-flex items-center gap-2 px-4 py-2 text-sm border-2 border-dashed border-[var(--paper-dark)] bg-[var(--paper)] transition-colors
                                 peer-checked:bg-[var(--ink)] peer-checked:text-[var(--paper)] peer-checked:border-solid peer-checked:border-[var(--ink)]
                                 peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-[var(--rust)]">
                        <i class="fas {{ $icon }}"></i> {{ $label }}
                    </span>
                </label>
            @endforeach
        </div>
        @error('is_clean') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-8 pt-6 border-t-2 border-dashed border-[var(--paper-dark)] flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
    <a href="{{ route('admin.rooms') }}" class="btn-ticket-outline">İptal</a>
    <button type="submit" class="btn-ticket"><i class="fas fa-check"></i> Kaydet</button>
</div>
