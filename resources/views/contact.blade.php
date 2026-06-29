@extends('layouts.app')

@section('title', 'İletişim')

@section('content')
<!-- Header -->
<div class="relative bg-gray-900 h-[300px]">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
             alt="Contact" 
             class="w-full h-full object-cover opacity-50">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
        <div class="text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">İletişim</h1>
            <p class="text-xl md:text-2xl">Bizimle iletişime geçin</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <!-- İletişim Bilgileri -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-12">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">İletişim Bilgileri</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Adres</h3>
                            <p class="mt-1 text-gray-600">
                                Örnek Mahallesi, Lüks Otel Caddesi No:1<br>
                                34000 Şişli/İstanbul
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-phone text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Telefon</h3>
                            <p class="mt-1 text-gray-600">
                                Rezervasyon: +90 (212) 555 00 01<br>
                                Resepsiyon: +90 (212) 555 00 02
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-envelope text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">E-posta</h3>
                            <p class="mt-1 text-gray-600">
                                Rezervasyon: rezervasyon@luxuryhotel.com<br>
                                Genel Bilgi: info@luxuryhotel.com
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Çalışma Saatleri</h3>
                            <p class="mt-1 text-gray-600">
                                Resepsiyon: 7/24 açık<br>
                                Restaurant: 06:00 - 00:00
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Harita -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Konum</h2>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3008.9833667120456!2d28.987325815415574!3d41.03677997929828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab703f3858137%3A0xe2b2d5eaf9a65c25!2zxZ5pxZ9saSwgxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1644842223282!5m2!1str!2str" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 