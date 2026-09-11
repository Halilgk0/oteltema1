@extends('admin.layout')

@section('title', 'Oda Tipi Düzenle')

@section('content')
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold">Oda Tipi Düzenle</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Oda Tipi Adı</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $roomType->name) }}" 
                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Kapasite</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $roomType->capacity) }}" 
                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                               required min="1">
                        @error('capacity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="base_price" class="block text-sm font-medium text-gray-700 mb-2">Gecelik Fiyat</label>
                        <input type="number" name="base_price" id="base_price" value="{{ old('base_price', $roomType->base_price) }}" 
                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                               required min="0" step="0.01">
                        @error('base_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Resim</label>
                        <input type="file" name="image" id="image" 
                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                               accept="image/*">
                        <p class="mt-1 text-sm text-gray-500">Yeni bir resim seçmezseniz mevcut resim kullanılmaya devam edecektir.</p>
                        @if($roomType->image)
                            <div class="mt-2">
                                <img src="{{ $roomType->image }}" alt="{{ $roomType->name }}" class="w-32 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Açıklama</label>
                        <textarea name="description" id="description" rows="4" 
                                  class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                  required>{{ old('description', $roomType->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Özellikler</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($amenities as $amenity)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                           class="rounded border-gray-300 text-blue-600 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                           {{ in_array($amenity->id, old('amenities', $roomType->amenities->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <span class="ml-2">
                                        {!! $amenity->icon !!}
                                        <span class="ml-1">{{ $amenity->name }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('amenities')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.rooms') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">
                        İptal
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection 