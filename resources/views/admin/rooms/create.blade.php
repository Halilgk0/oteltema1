@extends('admin.layout')

@section('title', 'Yeni Oda')

@section('content')
    <div class="field-card max-w-3xl">
        <div class="p-5 sm:p-8">
            <form action="{{ route('admin.rooms.store') }}" method="POST">
                @csrf
                @include('admin.rooms._form')
            </form>
        </div>
    </div>
@endsection
