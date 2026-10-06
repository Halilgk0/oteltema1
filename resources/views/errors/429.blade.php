@extends('layouts.app')

@section('title', 'Çok Fazla İstek')

@section('content')
<div class="py-24">
    <div class="max-w-xl mx-auto px-4 sm:px-6">
        <div class="field-card tilt-l text-center">
            <div class="p-10">
                <span class="type-stamp text-xs text-[var(--stone)]">— Hata 429 —</span>
                <div class="text-5xl text-[var(--rust)] my-6"><i class="fas fa-hourglass-half"></i></div>
                <h1 class="text-2xl md:text-3xl font-bold">Biraz yavaşlayalım</h1>
                <p class="text-[var(--stone)] mt-4 leading-relaxed">
                    Kısa sürede çok fazla istek gönderildi. Lütfen bir dakika bekleyip tekrar deneyin.
                </p>
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}" class="btn-ticket mt-8 inline-flex">
                    <i class="fas fa-arrow-left mr-1"></i> Geri Dön
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
