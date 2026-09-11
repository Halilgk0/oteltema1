@extends('layouts.app')

@section('title', 'İletişim')

@section('content')
<!-- Header -->
<div class="relative bg-[var(--moss-dark)] h-[340px] overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
         alt="Contact"
         class="photo-grade w-full h-full object-cover opacity-45">
        <div class="absolute inset-0 bg-gradient-to-t from-[var(--ink)] via-[var(--moss-dark)]/40 to-transparent"></div>
    </div>
    @include('partials.mist')
    <div class="godrays"></div>
    @include('partials.canopy-frame', ['side' => 'left'])
    @include('partials.canopy-frame', ['side' => 'right'])
    <div class="pointer-events-none absolute top-0 left-6 md:left-16 opacity-90">
        @include('partials.vine', ['side' => 'left', 'duration' => 6.4])
    </div>
    <div class="pointer-events-none absolute top-0 right-6 md:right-16 opacity-90">
        @include('partials.vine', ['side' => 'right', 'duration' => 5.6])
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
        <div class="text-[var(--paper)]">
            <span class="type-stamp inline-flex items-center gap-2 text-xs text-[var(--fern)] border border-dashed border-[var(--fern)]/60 bg-black/25 px-3 py-1.5">
                <i class="fas fa-leaf"></i> Bize ulaşın
            </span>
            <h1 class="text-4xl md:text-6xl font-bold mt-4 mb-3">İletişim</h1>
            <p class="text-lg md:text-xl text-[var(--paper)]/75" style="font-family:'Arvo',serif;">Bizimle iletişime geçin</p>
        </div>
    </div>
</div>
<div class="relative z-10 -mt-[46px] md:-mt-[68px]">
    @include('partials.canopy-divider', ['color' => 'var(--paper)'])
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="max-w-3xl mx-auto">
        <!-- İletişim Bilgileri -->
        <div class="field-card mb-14">
            <div class="p-8 md:p-10">
                <h2 class="text-2xl font-bold mb-8">İletişim Bilgileri</h2>

                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="flex items-start gap-4 p-5 border border-dashed border-[var(--paper-dark)]">
                        <div class="flex-shrink-0 w-11 h-11 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-[var(--rust)]"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold">Adres</h3>
                            <p class="mt-1 text-sm text-[var(--stone)] leading-relaxed">
                                Örnek Mahallesi, Lüks Otel Caddesi No:1<br>
                                34000 Şişli/İstanbul
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-5 border border-dashed border-[var(--paper-dark)]">
                        <div class="flex-shrink-0 w-11 h-11 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center">
                            <i class="fas fa-phone text-[var(--rust)]"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold">Telefon</h3>
                            <p class="mt-1 text-sm text-[var(--stone)] leading-relaxed">
                                Rezervasyon: +90 (212) 555 00 01<br>
                                Resepsiyon: +90 (212) 555 00 02
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-5 border border-dashed border-[var(--paper-dark)]">
                        <div class="flex-shrink-0 w-11 h-11 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center">
                            <i class="fas fa-envelope text-[var(--rust)]"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold">E-posta</h3>
                            <p class="mt-1 text-sm text-[var(--stone)] leading-relaxed">
                                Rezervasyon: rezervasyon@luxuryhotel.com<br>
                                Genel Bilgi: info@luxuryhotel.com
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-5 border border-dashed border-[var(--paper-dark)]">
                        <div class="flex-shrink-0 w-11 h-11 rounded-full border-2 border-dashed border-[var(--rust)] flex items-center justify-center">
                            <i class="fas fa-clock text-[var(--rust)]"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold">Çalışma Saatleri</h3>
                            <p class="mt-1 text-sm text-[var(--stone)] leading-relaxed">
                                Resepsiyon: 7/24 açık<br>
                                Restaurant: 06:00 - 00:00
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Harita -->
        <div class="field-card">
            <div class="p-8 md:p-10">
                <h2 class="text-2xl font-bold mb-6">Konum</h2>
                <div class="border-2 border-[var(--ink)] overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3008.9833667120456!2d28.987325815415574!3d41.03677997929828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab703f3858137%3A0xe2b2d5eaf9a65c25!2zxZ5pxZ9saSwgxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1644842223282!5m2!1str!2str"
                        width="100%"
                        height="420"
                        style="border:0; filter: sepia(.25) saturate(.8) contrast(1.05);"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- Sosyal -->
        <div class="mt-14 text-center" data-aos="fade-up">
            <span class="type-stamp text-xs text-[var(--stone)]">— Follow The Trail —</span>
            <div class="flex items-center justify-center gap-4 mt-5">
                <a href="#" class="w-12 h-12 rounded-full border-2 border-dashed border-[var(--ink)] flex items-center justify-center text-[var(--ink)] hover:bg-[var(--ink)] hover:text-[var(--paper)] transition-colors">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="w-12 h-12 rounded-full border-2 border-dashed border-[var(--ink)] flex items-center justify-center text-[var(--ink)] hover:bg-[var(--ink)] hover:text-[var(--paper)] transition-colors">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="w-12 h-12 rounded-full border-2 border-dashed border-[var(--ink)] flex items-center justify-center text-[var(--ink)] hover:bg-[var(--ink)] hover:text-[var(--paper)] transition-colors">
                    <i class="fab fa-x-twitter"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
