@extends('layouts.app')

@section('title', 'Book ' . $roomType->name)

@section('content')
    <div class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up">
                <span class="type-stamp text-xs text-[var(--stone)]">— Reservation —</span>
                <h1 class="text-3xl md:text-4xl font-bold mt-3">Book {{ $roomType->name }}</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <!-- Form -->
                <div class="lg:col-span-2 field-card">
                    <div class="pointer-events-none absolute -top-2 left-8 opacity-90">
                        @include('partials.vine', ['side' => 'left', 'duration' => 6])
                    </div>
                    <div class="p-6 sm:p-8">
                        @if($errors->any())
                            <div class="border-2 border-dashed border-[var(--rust)] bg-[var(--paper-deep)] text-[var(--rust)] px-4 py-3 mb-6 text-sm">
                                <p class="type-stamp text-[10px] mb-2">— Hata —</p>
                                <ul class="space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li><i class="fas fa-triangle-exclamation mr-1"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('bookings.store', $roomType) }}" method="POST" class="space-y-8" id="booking-form">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                                <div class="md:col-span-2">
                                    <h2 class="type-stamp text-xs text-[var(--stone)] mb-1">— Personal Information —</h2>
                                </div>

                                <div>
                                    <label for="first_name" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Ad</label>
                                    <div class="relative">
                                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                                               class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors">
                                    </div>
                                </div>

                                <div>
                                    <label for="last_name" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Soyad</label>
                                    <div class="relative">
                                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                               class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors">
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">E-posta</label>
                                    <div class="relative">
                                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                               class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors">
                                    </div>
                                </div>

                                <div>
                                    <label for="phone" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Telefon</label>
                                    <div class="relative">
                                        <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                               class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5 pt-6 border-t-2 border-dashed border-[var(--paper-dark)]">
                                <div class="md:col-span-2">
                                    <h2 class="type-stamp text-xs text-[var(--stone)] mb-1">— Booking Details —</h2>
                                </div>

                                <div>
                                    <label for="check_in" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Giriş Tarihi</label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-check absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)] pointer-events-none z-10"></i>
                                        <input type="text" name="check_in" id="check_in" value="{{ old('check_in') }}"
                                               autocomplete="off" placeholder="Tarih seçin"
                                               class="date-input w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors cursor-pointer">
                                    </div>
                                </div>

                                <div>
                                    <label for="check_out" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Çıkış Tarihi</label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-xmark absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)] pointer-events-none z-10"></i>
                                        <input type="text" name="check_out" id="check_out" value="{{ old('check_out') }}"
                                               autocomplete="off" placeholder="Tarih seçin"
                                               class="date-input w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors cursor-pointer">
                                    </div>
                                </div>

                                <div x-data="{ guests: {{ (int) old('number_of_guests', 1) }}, max: {{ (int) $roomType->capacity }} }">
                                    <label class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Misafir Sayısı</label>
                                    <div class="flex items-stretch border-2 border-[var(--ink)] bg-[var(--paper)]">
                                        <button type="button" @click="guests = Math.max(1, guests - 1)"
                                                class="stepper-btn border-r-2 border-[var(--ink)]">−</button>
                                        <div class="flex-1 flex items-center justify-center gap-2">
                                            <i class="fas fa-user-friends text-[var(--stone)] text-sm"></i>
                                            <input type="number" name="number_of_guests" id="number_of_guests"
                                                   x-model.number="guests"
                                                   @blur="guests = Math.min(max, Math.max(1, guests || 1))"
                                                   min="1" :max="max"
                                                   class="no-spinner w-10 text-center bg-transparent focus:outline-none font-semibold">
                                        </div>
                                        <button type="button" @click="guests = Math.min(max, guests + 1)"
                                                class="stepper-btn border-l-2 border-[var(--ink)]">+</button>
                                    </div>
                                    <p class="text-xs text-[var(--stone)] mt-1">En fazla {{ $roomType->capacity }} misafir</p>
                                </div>

                                <div>
                                    <label for="special_requests" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Özel İstekler</label>
                                    <div class="relative">
                                        <i class="fas fa-feather absolute left-4 top-3.5 text-[var(--stone)]"></i>
                                        <textarea name="special_requests" id="special_requests" rows="1"
                                                  class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors resize-none">{{ old('special_requests') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-ticket w-full !py-4">
                                Rezervasyonu Tamamla <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Room summary -->
                <div class="field-card tilt-r lg:sticky lg:top-28">
                    <div class="item-media h-56">
                        @include('partials.vine', ['side' => 'right', 'duration' => 6.5])
                        <img src="{{ $roomType->image ?? 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80' }}"
                             alt="{{ $roomType->name }}" class="w-full h-full object-cover">
                        <div class="price-stamp">
                            <b>${{ number_format($roomType->base_price, 0) }}</b>
                            <small>/night</small>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $roomType->name }}</h3>
                        <p class="text-sm text-[var(--stone)] mb-4 leading-relaxed">{{ Str::limit($roomType->description, 110) }}</p>
                        <div class="flex items-center gap-2 text-sm pt-4 border-t border-dashed border-[var(--paper-dark)]">
                            <i class="fas fa-user-friends text-[var(--rust)]"></i>
                            <span>Up to {{ $roomType->capacity }} guests</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script>
    var dateInputClass = "date-input w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors cursor-pointer";

    var checkOutPicker = flatpickr("#check_out", {
        dateFormat: "Y-m-d",
        altInput: true,
        altInputClass: dateInputClass,
        altFormat: "d.m.Y",
        minDate: "{{ old('check_out', date('Y-m-d', strtotime('+1 day'))) }}",
        disableMobile: true,
    });

    flatpickr("#check_in", {
        dateFormat: "Y-m-d",
        altInput: true,
        altInputClass: dateInputClass,
        altFormat: "d.m.Y",
        minDate: "today",
        disableMobile: true,
        onChange: function(selectedDates, dateStr) {
            var next = new Date(selectedDates[0]);
            next.setDate(next.getDate() + 1);
            checkOutPicker.set('minDate', next);
            if (checkOutPicker.selectedDates[0] && checkOutPicker.selectedDates[0] <= selectedDates[0]) {
                checkOutPicker.setDate(next, true);
            }
        }
    });

    document.getElementById('booking-form').addEventListener('submit', function (e) {
        var checkIn = document.getElementById('check_in').value;
        var checkOut = document.getElementById('check_out').value;
        if (!checkIn || !checkOut) {
            e.preventDefault();
            alert('Lütfen giriş ve çıkış tarihlerini seçin.');
        }
    });
</script>
@endsection
