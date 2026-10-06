@extends('admin.layout')

@section('title', 'Yeni Oda Tipi')

@section('content')
    <div class="field-card max-w-4xl">
        <div class="p-5 sm:p-8">
            <form action="{{ route('admin.room-types.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.room-types._form')
            </form>
        </div>
    </div>
@endsection
