@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 min-h-[calc(100vh-5rem)]">
    <!-- Atmosphere panel -->
    <div class="relative hidden md:block overflow-hidden" style="background: var(--moss-dark);">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1591088398332-8a7791972843?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2074&q=80"
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
                    <i class="fas fa-book"></i> Guest Log
                </span>
                <p class="mt-5 text-2xl md:text-3xl leading-snug" style="font-family:'Playfair Display',serif; font-style:italic;">
                    "Fog rolled in at dusk, and the room glowed like a lantern in the trees."
                </p>
                <p class="type-stamp text-[10px] text-[var(--paper)]/50 mt-4">— Left in the guestbook, Room 04 —</p>
            </div>
        </div>
    </div>

    <!-- Form panel -->
    <div class="relative flex items-center justify-center p-6 sm:p-10 py-16" style="background: var(--paper);">
        <div class="w-full max-w-md">
            <div class="field-card">
                <div class="pointer-events-none absolute -top-2 left-8 opacity-90">
                    @include('partials.vine', ['side' => 'left', 'duration' => 5.5])
                </div>
                <div class="p-8 sm:p-10">
                    <span class="type-stamp text-xs text-[var(--stone)]">— Giriş —</span>
                    <h1 class="text-3xl font-bold mt-2 mb-2">Hoş Geldiniz</h1>
                    <p class="text-sm text-[var(--stone)] mb-8">
                        Hesabınız yok mu?
                        <a href="{{ route('register') }}" class="text-[var(--rust)] font-semibold hover:underline">Yeni hesap oluşturun</a>
                    </p>

                    @if(session('success'))
                        <div class="border-2 border-dashed border-[var(--moss)] bg-[var(--paper-deep)] text-[var(--moss)] px-4 py-3 mb-6 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="border-2 border-dashed border-[var(--rust)] bg-[var(--paper-deep)] text-[var(--rust)] px-4 py-3 mb-6 text-sm">
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-triangle-exclamation mr-1"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="email" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">E-posta</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                                       class="w-full pl-11 pr-4 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors"
                                       placeholder="ornek@eposta.com">
                            </div>
                        </div>

                        <div x-data="{ show: false }">
                            <label for="password" class="type-stamp text-[10px] text-[var(--stone)] block mb-2">Şifre</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[var(--stone)]"></i>
                                <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                       class="w-full pl-11 pr-11 py-3 border-2 border-[var(--ink)] bg-[var(--paper)] focus:outline-none focus:border-[var(--rust)] transition-colors"
                                       placeholder="••••••••">
                                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-[var(--stone)] hover:text-[var(--ink)]">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>

                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember" value="1" class="w-4 h-4 accent-[var(--rust)] border-2 border-[var(--ink)]">
                            <span class="text-sm text-[var(--stone)]">Beni hatırla</span>
                        </label>

                        <button type="submit" class="btn-ticket w-full !py-3.5">
                            Giriş Yap <i class="fas fa-arrow-right text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
