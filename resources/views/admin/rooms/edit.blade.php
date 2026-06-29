@extends('admin.layout')

@section('title', 'Oda Düzenle')

@section('content')
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold">Oda Düzenle</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="room_number" class="block text-sm font-medium text-gray-700 mb-2">Oda Numarası</label>
                        <input type="text" name="room_number" id="room_number" value="{{ old('room_number', $room->room_number) }}" 
                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                               required>
                        @error('room_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="room_type_id" class="block text-sm font-medium text-gray-700 mb-2">Oda Tipi</label>
                        <select name="room_type_id" id="room_type_id" 
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                            <option value="">Oda tipi seçin</option>
                            @foreach($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}" 
                                    {{ old('room_type_id', $room->room_type_id) == $roomType->id ? 'selected' : '' }}>
                                    {{ $roomType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                        <select name="status" id="status" 
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                            <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Müsait</option>
                            <option value="occupied" {{ old('status', $room->status) == 'occupied' ? 'selected' : '' }}>Dolu</option>
                            <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>Bakımda</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="is_clean" class="block text-sm font-medium text-gray-700 mb-2">Temizlik Durumu</label>
                        <select name="is_clean" id="is_clean" 
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required>
                            <option value="1" {{ old('is_clean', $room->is_clean) ? 'selected' : '' }}>Temiz</option>
                            <option value="0" {{ old('is_clean', !$room->is_clean) ? 'selected' : '' }}>Temizlik Gerekli</option>
                        </select>
                        @error('is_clean')
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