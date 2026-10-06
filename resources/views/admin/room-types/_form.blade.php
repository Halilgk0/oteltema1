@php
    $roomType = $roomType ?? null;
    $selectedAmenities = old('amenities', $roomType ? $roomType->amenities->pluck('id')->toArray() : []);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="adm-label">Oda Tipi Adı</label>
        <input type="text" name="name" id="name" value="{{ old('name', $roomType->name ?? '') }}" required class="adm-input">
        @error('name') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="capacity" class="adm-label">Kapasite (kişi)</label>
            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $roomType->capacity ?? '') }}" required min="1" class="adm-input">
            @error('capacity') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="base_price" class="adm-label">Gecelik Fiyat ($)</label>
            <input type="number" name="base_price" id="base_price" value="{{ old('base_price', $roomType->base_price ?? '') }}" required min="0" step="0.01" class="adm-input">
            @error('base_price') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="md:col-span-2">
        <label for="description" class="adm-label">Açıklama</label>
        <textarea name="description" id="description" rows="4" required class="adm-input">{{ old('description', $roomType->description ?? '') }}</textarea>
        @error('description') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2" x-data="{ preview: @js($roomType->image ?? null) }">
        <label for="image" class="adm-label">Görsel</label>
        <div class="flex flex-col sm:flex-row gap-4 sm:items-center">
            <div class="w-full sm:w-40 h-32 flex-shrink-0 border-2 border-dashed border-[var(--paper-dark)] bg-[var(--paper-deep)] flex items-center justify-center overflow-hidden">
                <img x-show="preview" :src="preview" alt="" class="w-full h-full object-cover photo-grade">
                <i x-show="!preview" class="fas fa-image text-2xl text-[var(--stone)]"></i>
            </div>
            <div class="flex-1">
                <input type="file" name="image" id="image" accept="image/*" {{ $roomType ? '' : 'required' }}
                       @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview"
                       class="block w-full text-sm text-[var(--stone)] file:mr-3 file:py-2 file:px-4 file:border-2 file:border-[var(--ink)] file:bg-[var(--paper)] file:text-[var(--ink)] file:cursor-pointer hover:file:bg-[var(--paper-deep)]">
                <p class="mt-2 text-xs text-[var(--stone)]">
                    JPG, PNG veya GIF — en fazla 2 MB.
                    @if($roomType) Yeni görsel seçmezseniz mevcut görsel kalır. @endif
                </p>
                @error('image') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <div class="md:col-span-2">
        <span class="adm-label">Özellikler</span>
        <div class="flex flex-wrap gap-2">
            @foreach($amenities as $amenity)
                <label class="cursor-pointer">
                    <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}" class="peer sr-only"
                           {{ in_array($amenity->id, $selectedAmenities) ? 'checked' : '' }}>
                    <span class="inline-flex items-center gap-2 px-3 py-2 text-sm border-2 border-dashed border-[var(--paper-dark)] bg-[var(--paper)] transition-colors
                                 peer-checked:bg-[var(--ink)] peer-checked:text-[var(--paper)] peer-checked:border-solid peer-checked:border-[var(--ink)]
                                 peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-[var(--rust)]">
                        {!! $amenity->icon !!} {{ $amenity->name }}
                    </span>
                </label>
            @endforeach
        </div>
        @error('amenities') <p class="mt-1 text-xs text-[var(--rust)]">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-8 pt-6 border-t-2 border-dashed border-[var(--paper-dark)] flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
    <a href="{{ route('admin.rooms') }}" class="btn-ticket-outline">İptal</a>
    <button type="submit" class="btn-ticket"><i class="fas fa-check"></i> Kaydet</button>
</div>
