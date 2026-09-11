@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
    <div class="py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="field-card">
                <div class="pointer-events-none absolute -top-2 left-8 opacity-90">
                    @include('partials.vine', ['side' => 'left', 'duration' => 6])
                </div>
                <div class="pointer-events-none absolute -top-2 right-8 opacity-90">
                    @include('partials.vine', ['side' => 'right', 'duration' => 7])
                </div>
                <div class="p-8 sm:p-10">
                    <div class="text-center mb-8">
                        <div class="mx-auto w-24 h-24 rounded-full border-4 border-dashed border-[var(--moss)] flex items-center justify-center mb-5" style="transform: rotate(-8deg);">
                            <i class="fas fa-check text-3xl text-[var(--moss)]"></i>
                        </div>
                        <span class="type-stamp text-xs text-[var(--stone)]">— Confirmed —</span>
                        <h1 class="text-3xl font-bold mt-2 mb-2">Rezervasyonunuz Alındı!</h1>
                        <p class="text-[var(--stone)]">Konaklamanız başarıyla kaydedildi.</p>
                    </div>

                    <div class="border-t-2 border-b-2 border-dashed border-[var(--paper-dark)] py-6 mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Booking Details -->
                            <div>
                                <h2 class="type-stamp text-xs text-[var(--stone)] mb-4">— Booking Details —</h2>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="type-stamp text-[9px] text-[var(--stone)]">Rezervasyon No</dt>
                                        <dd class="text-sm font-medium">#{{ $booking->id }}</dd>
                                    </div>
                                    <div>
                                        <dt class="type-stamp text-[9px] text-[var(--stone)]">Giriş Tarihi</dt>
                                        <dd class="text-sm font-medium">{{ $booking->check_in->format('F j, Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="type-stamp text-[9px] text-[var(--stone)]">Çıkış Tarihi</dt>
                                        <dd class="text-sm font-medium">{{ $booking->check_out->format('F j, Y') }}</dd>
                                    </div>
                                    <div>
                                        <dt class="type-stamp text-[9px] text-[var(--stone)]">Misafir Sayısı</dt>
                                        <dd class="text-sm font-medium">{{ $booking->number_of_guests }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Guest Information -->
                            <div>
                                <h2 class="type-stamp text-xs text-[var(--stone)] mb-4">— Guest Information —</h2>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="type-stamp text-[9px] text-[var(--stone)]">Ad Soyad</dt>
                                        <dd class="text-sm font-medium">{{ $booking->customer->name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="type-stamp text-[9px] text-[var(--stone)]">E-posta</dt>
                                        <dd class="text-sm font-medium break-all">{{ $booking->customer->email }}</dd>
                                    </div>
                                    <div>
                                        <dt class="type-stamp text-[9px] text-[var(--stone)]">Telefon</dt>
                                        <dd class="text-sm font-medium">{{ $booking->customer->phone }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="border-2 border-dashed border-[var(--paper-dark)] p-6 mb-8" style="background: var(--paper-deep);">
                        <h2 class="type-stamp text-xs text-[var(--stone)] mb-4">— Price Summary —</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-[var(--stone)]">Oda Ücreti ({{ $booking->duration }} gece)</span>
                                <span class="font-medium">${{ number_format($booking->total_price, 2) }}</span>
                            </div>
                            <div class="border-t-2 border-dashed border-[var(--paper-dark)] pt-3 flex justify-between items-center">
                                <span class="font-bold">Toplam Tutar</span>
                                <span class="text-xl font-bold">${{ number_format($booking->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-[var(--stone)] mb-5">Onay e-postası {{ $booking->customer->email }} adresine gönderildi.</p>
                        <a href="{{ route('home') }}" class="btn-ticket !inline-flex">
                            Ana Sayfaya Dön
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
