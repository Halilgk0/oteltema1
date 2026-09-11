@extends('admin.layout')

@section('title', 'Odalar Yönetimi')

@section('content')
    <!-- Oda Tipleri -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Oda Tipleri</h2>
            <a href="{{ route('admin.room-types.create') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                <i class="fas fa-plus mr-2"></i>Yeni Oda Tipi Ekle
            </a>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($roomTypes as $roomType)
                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ $roomType->image }}" alt="{{ $roomType->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold">{{ $roomType->name }}</h3>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.room-types.edit', $roomType) }}" 
                                       class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.room-types.delete', $roomType) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Bu oda tipini silmek istediğinizden emin misiniz?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($roomType->description, 100) }}</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span><i class="fas fa-bed mr-1"></i>{{ $roomType->capacity }} Kişilik</span>
                                <span><i class="fas fa-dollar-sign mr-1"></i>{{ number_format($roomType->base_price, 2) }}/gece</span>
                            </div>
                            
                            @if($roomType->amenities->count() > 0)
                                <div class="mt-3 pt-3 border-t">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Özellikler</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($roomType->amenities as $amenity)
                                            <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-xs rounded-full">
                                                {!! $amenity->icon !!}
                                                <span class="ml-1">{{ $amenity->name }}</span>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection 