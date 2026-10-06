@extends('admin.layout')

@section('title', 'Oda Tipini Düzenle')

@section('content')
    <div class="field-card max-w-4xl">
        <div class="p-5 sm:p-8">
            <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.room-types._form', ['roomType' => $roomType])
            </form>
        </div>
    </div>
@endsection
