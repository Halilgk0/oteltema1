@extends('layouts.app')

@section('title', 'Profilim')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="type-stamp text-xs text-[var(--stone)]">— Guest Log —</span>
            <h1 class="text-3xl md:text-4xl font-bold mt-3">Profilim</h1>
        </div>

        @if(session('success'))
            <div class="border-2 border-dashed border-[var(--moss)] bg-[var(--paper-deep)] text-[var(--moss)] px-4 py-3 mb-8 text-sm max-w-3xl mx-auto">
                <i class="fas fa-circle-check mr-1"></i>{{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="border-2 border-dashed border-[var(--rust)] bg-[var(--paper-deep)] text-[var(--rust)] px-4 py-3 mb-8 text-sm max-w-3xl mx-auto">
                @foreach($errors->all() as $error)
                    <p><i class="fas fa-triangle-exclamation mr-1"></i>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Profil Bilgileri -->
            <div class="md:col-span-1">
                <div class="field-card">
                    <div class="pointer-events-none absolute -top-2 left-8 opacity-90">
                        @include('partials.vine', ['side' => 'left', 'duration' => 6])
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-6">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2c4025&color=e9dfc0"
                                 alt="{{ $user->name }}"
                                 class="h-24 w-24 rounded-full mx-auto mb-4 border-2 border-[var(--ink)]">
                            <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                            <p class="type-stamp text-[10px] text-[var(--stone)] mt-1">Üye — {{ $user->created_at->format('M Y') }}</p>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3 p-3 border border-dashed border-[var(--paper-dark)]">
                                <i class="fas fa-envelope text-[var(--rust)] mt-1"></i>
                                <div>
                                    <div class="type-stamp text-[9px] text-[var(--stone)]">E-posta</div>
                                    <p class="text-sm break-all">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 border border-dashed border-[var(--paper-dark)]">
                                <i class="fas fa-phone text-[var(--rust)] mt-1"></i>
                                <div>
                                    <div class="type-stamp text-[9px] text-[var(--stone)]">Telefon</div>
                                    <p class="text-sm">{{ $user->phone ?? '—' }}</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('my-bookings') }}" class="btn-ticket w-full !py-3 mt-6">
                            Rezervasyonlarım
                        </a>
                    </div>
                </div>

                <!-- Şifre Değiştir -->
                <div class="field-card mt-8" x-data="{ open: {{ $errors->password->any() ? 'true' : 'false' }}, show: false }">
                    <div class="p-6">
                        <button type="button" @click="open = !open"
                                class="w-full flex items-center justify-between gap-3 text-left"
                                :aria-expanded="open.toString()">
                            <span class="type-stamp text-xs text-[var(--stone)]">— Şifre Değiştir —</span>
                            <i class="fas fa-chevron-down text-[var(--stone)] transition-transform" :class="open && 'rotate-180'"></i>
                        </button>

                        <form x-show="open" x-cloak action="{{ route('profile.password') }}" method="POST" class="mt-5 space-y-4">
                            @csrf

                            @if($errors->password->any())
                                <div class="border-2 border-dashed border-[var(--rust)] bg-[var(--paper-deep)] text-[var(--rust)] px-3 py-2 text-xs space-y-1">
                                    @foreach($errors->password->all() as $error)
                                        <p><i class="fas fa-triangle-exclamation mr-1"></i>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <div>
                                <label for="current_password" class="type-stamp text-[9px] text-[var(--stone)] block mb-2">Mevcut Şifre</label>
                                <input :type="show ? 'text' : 'password'" id="current_password" name="current_password" required autocomplete="current-password"
                                       class="w-full px-3 py-2.5 text-sm border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors">
                            </div>
                            <div>
                                <label for="new_password" class="type-stamp text-[9px] text-[var(--stone)] block mb-2">Yeni Şifre</label>
                                <input :type="show ? 'text' : 'password'" id="new_password" name="password" required minlength="8" autocomplete="new-password"
                                       class="w-full px-3 py-2.5 text-sm border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors">
                            </div>
                            <div>
                                <label for="new_password_confirmation" class="type-stamp text-[9px] text-[var(--stone)] block mb-2">Yeni Şifre (Tekrar)</label>
                                <input :type="show ? 'text' : 'password'" id="new_password_confirmation" name="password_confirmation" required minlength="8" autocomplete="new-password"
                                       class="w-full px-3 py-2.5 text-sm border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors">
                            </div>

                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" x-model="show" class="w-4 h-4 accent-[var(--rust)]">
                                <span class="text-xs text-[var(--stone)]">Şifreleri göster</span>
                            </label>

                            <p class="text-[11px] text-[var(--stone)] leading-relaxed">
                                Şifreniz değişince diğer cihazlardaki oturumlarınız kapanır.
                            </p>

                            <button type="submit" class="btn-ticket w-full !py-3">
                                <i class="fas fa-key mr-1"></i> Şifreyi Güncelle
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Rezervasyonlar -->
            <div class="md:col-span-3 space-y-8">
                <!-- Aktif Rezervasyonlar -->
                <div class="field-card">
                    <div class="p-6">
                        <h3 class="type-stamp text-xs text-[var(--stone)] mb-4">— Aktif Rezervasyonlar —</h3>
                        @php
                            $activeBookings = $user->bookings()
                                ->whereIn('status', ['pending', 'confirmed'])
                                ->where('check_out', '>=', now())
                                ->orderBy('check_in')
                                ->get();
                        @endphp

                        @if($activeBookings->isEmpty())
                            <p class="text-[var(--stone)] text-sm">Aktif rezervasyonunuz bulunmuyor.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($activeBookings as $booking)
                                    <div class="border-2 border-dashed border-[var(--paper-dark)] p-4">
                                        <div class="flex justify-between items-start gap-3">
                                            <div>
                                                <h4 class="font-bold">{{ $booking->room->roomType->name }}</h4>
                                                <p class="text-sm text-[var(--stone)]">Oda No: {{ $booking->room->room_number }}</p>
                                            </div>
                                            <span class="type-stamp text-[10px] px-2 py-1 border whitespace-nowrap
                                                @if($booking->status === 'confirmed') border-[var(--moss)] text-[var(--moss)]
                                                @else border-[var(--mustard)] text-[var(--mustard)] @endif">
                                                {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                                            </span>
                                        </div>
                                        <div class="mt-3 grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <p class="type-stamp text-[9px] text-[var(--stone)]">Check-in</p>
                                                <p class="font-medium">{{ $booking->check_in->format('d M Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="type-stamp text-[9px] text-[var(--stone)]">Check-out</p>
                                                <p class="font-medium">{{ $booking->check_out->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 pt-3 border-t border-dashed border-[var(--paper-dark)] text-sm flex items-center justify-between">
                                            <div>
                                                <span class="type-stamp text-[9px] text-[var(--stone)]">Toplam</span>
                                                <span class="font-bold ml-2">${{ number_format($booking->total_price, 2) }}</span>
                                            </div>
                                            @if(in_array($booking->status, ['pending', 'confirmed']) && $booking->check_in->isFuture())
                                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST"
                                                      onsubmit="return confirm('Bu rezervasyonu iptal etmek istediğinize emin misiniz?');">
                                                    @csrf
                                                    <button type="submit" class="btn-ticket-outline !border-[var(--rust)] !text-[var(--rust)] hover:!bg-[var(--rust)] hover:!text-[var(--paper)] !py-1.5 !px-3 !text-[10px]">
                                                        <i class="fas fa-ban mr-1"></i> İptal Et
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Geçmiş Rezervasyonlar -->
                <div class="field-card">
                    <div class="p-6">
                        <h3 class="type-stamp text-xs text-[var(--stone)] mb-4">— Geçmiş Rezervasyonlar —</h3>
                        @php
                            $pastBookings = $user->bookings()
                                ->where(function($query) {
                                    $query->where('check_out', '<', now())
                                        ->orWhere('status', 'cancelled');
                                })
                                ->orderBy('check_in', 'desc')
                                ->get();
                        @endphp

                        @if($pastBookings->isEmpty())
                            <p class="text-[var(--stone)] text-sm">Geçmiş rezervasyonunuz bulunmuyor.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($pastBookings as $booking)
                                    <div class="border-2 border-dashed border-[var(--paper-dark)] p-4 {{ $booking->status === 'cancelled' ? 'opacity-60' : '' }}">
                                        <div class="flex justify-between items-start gap-3">
                                            <div>
                                                <h4 class="font-bold">{{ $booking->room->roomType->name }}</h4>
                                                <p class="text-sm text-[var(--stone)]">Oda No: {{ $booking->room->room_number }}</p>
                                            </div>
                                            <span class="type-stamp text-[10px] px-2 py-1 border whitespace-nowrap
                                                @if($booking->status === 'cancelled') border-[var(--rust)] text-[var(--rust)]
                                                @else border-[var(--stone)] text-[var(--stone)] @endif">
                                                {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                                            </span>
                                        </div>
                                        <div class="mt-3 grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <p class="type-stamp text-[9px] text-[var(--stone)]">Check-in</p>
                                                <p class="font-medium">{{ $booking->check_in->format('d M Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="type-stamp text-[9px] text-[var(--stone)]">Check-out</p>
                                                <p class="font-medium">{{ $booking->check_out->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 pt-3 border-t border-dashed border-[var(--paper-dark)] text-sm">
                                            <span class="type-stamp text-[9px] text-[var(--stone)]">Toplam</span>
                                            <span class="font-bold ml-2">${{ number_format($booking->total_price, 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
