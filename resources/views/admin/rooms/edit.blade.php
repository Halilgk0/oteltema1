@extends('admin.layout')

@section('title', 'Odayı Düzenle')

@section('content')
    <div class="field-card max-w-3xl">
        <div class="p-5 sm:p-8">
            <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.rooms._form', ['room' => $room])
            </form>
        </div>
    </div>
@endsection
