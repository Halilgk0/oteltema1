<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Luxury Hotel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Arvo:wght@400;700&family=Special+Elite&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    @include('partials.theme-styles')

    @yield('styles')
</head>
<body class="bg-[var(--paper)] flex flex-col min-h-screen">
    <div class="grain"></div>
    <div class="vignette"></div>
    @include('partials.jungle-fx')

    <!-- Navigation -->
    <nav class="nav-paper sticky top-0 z-50" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 py-3 items-center">
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <span class="brand-badge">
                            <i class="fas fa-leaf text-[var(--moss)] text-lg"></i>
                        </span>
                        <span class="text-xl font-bold" style="font-family:'Playfair Display',serif;">
                            {{ config('app.name', 'Luxury Hotel') }}
                        </span>
                    </a>
                    <div class="hidden sm:flex sm:space-x-7">
                        <a href="{{ route('home') }}" class="nav-link inline-flex items-center py-2">Home</a>
                        <a href="{{ route('rooms') }}" class="nav-link inline-flex items-center py-2">Rooms</a>
                        <a href="{{ route('events.index') }}" class="nav-link inline-flex items-center py-2">Events</a>
                        <a href="{{ route('contact') }}" class="nav-link inline-flex items-center py-2">İletişim</a>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center">
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                    class="flex items-center space-x-2 text-[var(--stone)] hover:text-[var(--ink)] focus:outline-none transition-colors">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3c5334&color=e9dfc0"
                                     alt="{{ Auth::user()->name }}"
                                     class="h-9 w-9 rounded-full border-2 border-[var(--ink)]">
                                <span class="type-stamp text-xs">{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open"
                                 x-cloak
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="transform opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-3 w-52 border-2 border-[var(--ink)] shadow-xl bg-[var(--paper)] z-50 overflow-hidden">
                                <div class="py-1">
                                    @if(Auth::user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)] transition-colors border-b border-dashed border-[var(--paper-dark)]">
                                            <i class="fas fa-key mr-3 text-[var(--rust)]"></i> Yönetim Paneli
                                        </a>
                                    @endif
                                    <a href="{{ route('profile') }}" class="flex items-center px-4 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)] transition-colors">
                                        <i class="fas fa-user mr-3 text-[var(--stone)]"></i> Profilim
                                    </a>
                                    <a href="{{ route('my-bookings') }}" class="flex items-center px-4 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)] transition-colors">
                                        <i class="fas fa-calendar-check mr-3 text-[var(--stone)]"></i> Rezervasyonlarım
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center text-left px-4 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)] transition-colors">
                                            <i class="fas fa-sign-out-alt mr-3 text-[var(--stone)]"></i> Çıkış Yap
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link px-3 py-2">Giriş Yap</a>
                        <a href="{{ route('register') }}" class="btn-ticket ml-4 !py-2.5 !px-5">Kayıt Ol</a>
                    @endauth
                </div>

                <!-- Mobile hamburger -->
                <button @click="mobileOpen = !mobileOpen" type="button"
                        class="sm:hidden flex items-center justify-center w-11 h-11 border-2 border-[var(--ink)] text-[var(--ink)]"
                        :aria-expanded="mobileOpen" aria-label="Menüyü aç/kapat">
                    <i class="fas fa-bars text-lg" x-show="!mobileOpen"></i>
                    <i class="fas fa-xmark text-lg" x-show="mobileOpen" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile menu panel -->
        <div x-show="mobileOpen"
             x-cloak
             @click.away="mobileOpen = false"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="sm:hidden border-t-2 border-[var(--ink)] bg-[var(--paper)]">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('home') }}" @click="mobileOpen = false" class="type-stamp block px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">Home</a>
                <a href="{{ route('rooms') }}" @click="mobileOpen = false" class="type-stamp block px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">Rooms</a>
                <a href="{{ route('events.index') }}" @click="mobileOpen = false" class="type-stamp block px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">Events</a>
                <a href="{{ route('contact') }}" @click="mobileOpen = false" class="type-stamp block px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">İletişim</a>

                <div class="pt-3 mt-2 border-t-2 border-dashed border-[var(--paper-dark)]">
                    @auth
                        <div class="flex items-center gap-3 px-3 py-2 mb-1">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3c5334&color=e9dfc0"
                                 alt="{{ Auth::user()->name }}"
                                 class="h-9 w-9 rounded-full border-2 border-[var(--ink)]">
                            <span class="type-stamp text-xs">{{ Auth::user()->name }}</span>
                        </div>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" @click="mobileOpen = false" class="flex items-center px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">
                                <i class="fas fa-key mr-3 text-[var(--rust)]"></i> Yönetim Paneli
                            </a>
                        @endif
                        <a href="{{ route('profile') }}" @click="mobileOpen = false" class="flex items-center px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">
                            <i class="fas fa-user mr-3 text-[var(--stone)]"></i> Profilim
                        </a>
                        <a href="{{ route('my-bookings') }}" @click="mobileOpen = false" class="flex items-center px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">
                            <i class="fas fa-calendar-check mr-3 text-[var(--stone)]"></i> Rezervasyonlarım
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex w-full items-center text-left px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">
                                <i class="fas fa-sign-out-alt mr-3 text-[var(--stone)]"></i> Çıkış Yap
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" @click="mobileOpen = false" class="type-stamp block px-3 py-3 text-sm text-[var(--ink)] hover:bg-[var(--paper-deep)]">Giriş Yap</a>
                        <a href="{{ route('register') }}" @click="mobileOpen = false" class="btn-ticket w-full !py-3 mt-2">Kayıt Ol</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="relative z-10 flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <div class="relative z-10">
        @include('partials.canopy-divider', ['color' => 'var(--ink)'])
    </div>
    <footer class="relative z-10 bg-[var(--ink)] text-[var(--paper)] -mt-px overflow-hidden">
        <div class="pointer-events-none absolute -top-2 left-10 opacity-90">
            @include('partials.vine', ['side' => 'left', 'duration' => 6])
        </div>
        <div class="pointer-events-none absolute -top-2 left-24 opacity-70 hidden md:block">
            @include('partials.vine', ['side' => 'left', 'duration' => 8])
        </div>
        <div class="pointer-events-none absolute -top-2 right-10 opacity-90">
            @include('partials.vine', ['side' => 'right', 'duration' => 7])
        </div>
        <div class="pointer-events-none absolute -top-2 right-24 opacity-70 hidden md:block">
            @include('partials.vine', ['side' => 'right', 'duration' => 9])
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <span class="brand-badge !border-[var(--fern)] !bg-transparent"><i class="fas fa-leaf text-[var(--fern)] text-base"></i></span>
                        {{ config('app.name', 'Luxury Hotel') }}
                    </h3>
                    <p class="text-[var(--paper)]/60 leading-relaxed">Experience luxury and comfort at our hotel. We provide exceptional service and unforgettable stays.</p>
                </div>
                <div>
                    <h3 class="type-stamp text-xs text-[var(--fern)] mb-4">Contact</h3>
                    <p class="text-[var(--paper)]/70 mb-1">info@luxuryhotel.com</p>
                    <p class="text-[var(--paper)]/70 mb-1">+1 234 567 890</p>
                    <p class="text-[var(--paper)]/70">123 Luxury Street, City</p>
                </div>
                <div>
                    <h3 class="type-stamp text-xs text-[var(--fern)] mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-[var(--paper)]/70 hover:text-[var(--paper)] transition-colors">Home</a></li>
                        <li><a href="{{ route('rooms') }}" class="text-[var(--paper)]/70 hover:text-[var(--paper)] transition-colors">Rooms</a></li>
                        <li><a href="{{ route('events.index') }}" class="text-[var(--paper)]/70 hover:text-[var(--paper)] transition-colors">Events</a></li>
                        <li><a href="{{ route('contact') }}" class="text-[var(--paper)]/70 hover:text-[var(--paper)] transition-colors">İletişim</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-dashed border-[var(--paper)]/20 text-center">
                <p class="type-stamp text-[var(--paper)]/40 text-xs">&copy; {{ date('Y') }} {{ config('app.name', 'Luxury Hotel') }} — est. deep in the wild</p>            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
