@extends('layouts.app')

@section('title', 'Kayıt Ol')

@section('content')
<!-- Country Flags CSS -->
<link href="https://cdn.jsdelivr.net/npm/country-flag-icons/css/country-flag-icons.min.css" rel="stylesheet">

<div class="grid grid-cols-1 md:grid-cols-2 min-h-[calc(100vh-5rem)]">
    <!-- Atmosphere panel -->
    <div class="relative hidden md:block overflow-hidden" style="background: var(--moss-dark);">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                 alt="" class="photo-grade w-full h-full object-cover opacity-45">
            <div class="absolute inset-0 bg-gradient-to-t from-[var(--ink)] via-[var(--moss-dark)]/55 to-[var(--moss-dark)]/25"></div>
        </div>
        @include('partials.mist')
        <div class="godrays"></div>
        @include('partials.canopy-frame', ['side' => 'left'])
        @include('partials.canopy-frame', ['side' => 'right'])
        <div class="pointer-events-none absolute top-0 left-10 opacity-90">
            @include('partials.vine', ['side' => 'left', 'duration' => 6.4])
        </div>
        <div class="pointer-events-none absolute top-0 right-10 opacity-90">
            @include('partials.vine', ['side' => 'right', 'duration' => 7.1])
        </div>
        <div class="relative z-10 h-full flex flex-col justify-between p-10 lg:p-14 text-[var(--paper)]">
            <a href="{{ route('home') }}" class="flex items-center gap-3 w-fit">
                <span class="brand-badge !bg-transparent"><i class="fas fa-leaf text-[var(--fern)] text-lg"></i></span>
                <span class="text-xl font-bold" style="font-family:'Playfair Display',serif;">{{ config('app.name', 'Luxury Hotel') }}</span>
            </a>
            <div>
                <span class="type-stamp inline-flex items-center gap-2 text-xs text-[var(--fern)] border border-dashed border-[var(--fern)]/60 bg-black/25 px-3 py-1.5">
                    <i class="fas fa-compass"></i> Neden Üye Olun?
                </span>
                <ul class="mt-6 space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-bolt text-[var(--mustard)] mt-1"></i>
                        <span>Hızlı ve öncelikli rezervasyon, bekleme yok.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-tag text-[var(--mustard)] mt-1"></i>
                        <span>Üyelere özel fiyatlar ve mevsimlik kampanyalar.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-book-open text-[var(--mustard)] mt-1"></i>
                        <span>Tüm rezervasyon geçmişiniz tek bir günlükte.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-dove text-[var(--mustard)] mt-1"></i>
                        <span>Gece safarisi ve kanopi yürüyüşü davetleri ilk sizde.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Form panel -->
    <div class="relative flex items-center justify-center p-6 sm:p-10 py-16" style="background: var(--paper);">
        <div class="w-full max-w-md">
            <div class="field-card">
                <div class="pointer-events-none absolute -top-2 right-8 opacity-90">
                    @include('partials.vine', ['side' => 'right', 'duration' => 5.8])
                </div>
                <div class="p-8 sm:p-10">
                    <span class="type-stamp text-xs text-[var(--stone)]">— Kayıt —</span>
                    <h1 class="text-3xl font-bold mt-2 mb-2">Aramıza Katılın</h1>
                    <p class="text-sm text-[var(--stone)] mb-8">
                        Zaten hesabınız var mı?
                        <a href="{{ route('login') }}" class="text-[var(--rust)] font-semibold hover:underline">Giriş yapın</a>
                    </p>

                    @if($errors->any())
                        <div class="border-2 border-dashed border-[var(--rust)] bg-[var(--paper-deep)] text-[var(--rust)] px-4 py-3 mb-6 text-sm">
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-triangle-exclamation mr-1"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Ad Soyad</label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                       class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors"
                                       placeholder="Adınız Soyadınız">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">E-posta</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                       class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors"
                                       placeholder="ornek@eposta.com">
                            </div>
                        </div>

                        <div>
                            <label class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Telefon</label>
                            <div class="flex gap-2">
                                <div class="relative w-28 flex-shrink-0">
                                    <span class="fi fi-tr absolute left-3 top-1/2 -translate-y-1/2 text-base pointer-events-none"></span>
                                    <select id="country_code" name="country_code" required
                                            class="w-full pl-9 pr-1 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors text-sm">
                                        <option value="+90" data-country="TR">+90</option>
                                        <option value="+1" data-country="US">+1</option>
                                        <option value="+44" data-country="GB">+44</option>
                                        <option value="+49" data-country="DE">+49</option>
                                        <option value="+33" data-country="FR">+33</option>
                                        <option value="+39" data-country="IT">+39</option>
                                        <option value="+34" data-country="ES">+34</option>
                                        <option value="+31" data-country="NL">+31</option>
                                        <option value="+7" data-country="RU">+7</option>
                                        <option value="+86" data-country="CN">+86</option>
                                        <option value="+81" data-country="JP">+81</option>
                                        <option value="+82" data-country="KR">+82</option>
                                    </select>
                                </div>
                                <div class="relative flex-1">
                                    <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                    <input id="phone" name="phone" type="tel" required value="{{ old('phone') }}"
                                           class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors"
                                           placeholder="5xx xxx xx xx">
                                </div>
                            </div>
                        </div>

                        <div x-data="{ show: false }">
                            <label for="password" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Şifre</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                <input :type="show ? 'text' : 'password'" id="password" name="password" required minlength="8"
                                       class="w-full pl-11 pr-11 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors"
                                       placeholder="En az 8 karakter">
                                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-[var(--stone)] hover:text-[var(--ink)]">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>

                        <div x-data="{ show: false }">
                            <label for="password_confirmation" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Şifre Tekrar</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required
                                       class="w-full pl-11 pr-11 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors"
                                       placeholder="Şifrenizi doğrulayın">
                                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-[var(--stone)] hover:text-[var(--ink)]">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-ticket w-full !py-3.5">
                            Kayıt Ol <i class="fas fa-arrow-right text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('country_code').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const countryCode = selectedOption.getAttribute('data-country').toLowerCase();
    const flagElement = this.parentElement.querySelector('.fi');
    flagElement.className = `fi fi-${countryCode} absolute left-3 top-1/2 -translate-y-1/2 text-base pointer-events-none`;
});
</script>
@endsection
