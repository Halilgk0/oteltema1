<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Arvo:wght@400;700&family=Special+Elite&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    @include('partials.theme-styles')

    <style>
        .adm-label {
            display: block;
            margin-bottom: .5rem;
            font-family: 'Special Elite', 'Courier New', monospace;
            letter-spacing: .12em;
            font-size: 10px;
            color: var(--stone);
        }
        .adm-input {
            width: 100%;
            padding: .7rem .9rem;
            border: 2px solid var(--ink);
            background: var(--paper);
            color: var(--ink);
            transition: border-color .2s ease;
        }
        .adm-input:focus { outline: none; border-color: var(--rust); }
        .adm-nav-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .8rem 1rem;
            border-left: 3px solid transparent;
            font-family: 'Special Elite', 'Courier New', monospace;
            letter-spacing: .08em;
            font-size: .8rem;
            color: rgba(217, 201, 154, .75);
            transition: background .2s ease, color .2s ease, border-color .2s ease;
        }
        .adm-nav-link:hover { background: rgba(217, 201, 154, .06); color: var(--paper); }
        .adm-nav-link.is-active { background: rgba(217, 201, 154, .1); color: var(--paper); border-left-color: var(--mustard); }
        .adm-table th {
            font-family: 'Special Elite', 'Courier New', monospace;
            letter-spacing: .1em;
            font-size: 10px;
            font-weight: normal;
            color: var(--stone);
            text-align: left;
            padding: .75rem 1rem;
            border-bottom: 2px solid var(--ink);
            white-space: nowrap;
        }
        .adm-table td { padding: .9rem 1rem; border-bottom: 1px dashed var(--paper-dark); vertical-align: top; }
        .adm-table tbody tr:hover { background: rgba(195, 174, 118, .25); }
        .pager nav a,
        .pager nav span[aria-disabled] > span,
        .pager nav span[aria-current] > span,
        .pager nav span > span {
            background: var(--paper) !important;
            border-color: var(--ink) !important;
            color: var(--ink) !important;
            border-radius: 0 !important;
        }
        .pager nav span[aria-current] > span { background: var(--ink) !important; color: var(--paper) !important; }
        .pager nav p { color: var(--stone); }
    </style>

    @yield('styles')
</head>
<body class="bg-[var(--paper)] min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="grain"></div>

    <div class="min-h-screen lg:flex">
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/50 z-30 lg:hidden"></div>

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen lg:flex-shrink-0 transition-transform duration-200 bg-[var(--moss-dark)] text-[var(--paper)] flex flex-col overflow-hidden"
               :style="sidebarOpen ? 'transform: translateX(0)' : ''">
            <div class="pointer-events-none absolute -top-2 right-6 opacity-80">
                @include('partials.vine', ['side' => 'right', 'duration' => 7])
            </div>

            <div class="relative px-6 pt-7 pb-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <span class="brand-badge !bg-transparent !border-[var(--fern)]">
                        <i class="fas fa-leaf text-[var(--fern)] text-lg"></i>
                    </span>
                    <span>
                        <span class="block text-lg font-bold leading-tight" style="font-family:'Playfair Display',serif;">{{ config('app.name', 'Luxury Hotel') }}</span>
                        <span class="type-stamp block text-[9px] text-[var(--fern)]">Yönetim Paneli</span>
                    </span>
                </a>
            </div>

            <nav class="flex-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="adm-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                    <i class="fas fa-compass w-4 text-center"></i> Genel Bakış
                </a>
                <a href="{{ route('admin.rooms') }}"
                   class="adm-nav-link {{ request()->routeIs('admin.rooms*', 'admin.room-types*') ? 'is-active' : '' }}">
                    <i class="fas fa-bed w-4 text-center"></i> Odalar
                </a>
                <a href="{{ route('admin.bookings') }}"
                   class="adm-nav-link {{ request()->routeIs('admin.bookings') ? 'is-active' : '' }}">
                    <i class="fas fa-book-open w-4 text-center"></i> Rezervasyonlar
                </a>
            </nav>

            <div class="px-6 py-6 border-t border-dashed border-[rgba(217,201,154,0.2)] space-y-3">
                <a href="{{ route('home') }}" class="adm-nav-link !px-0 !border-0 hover:!bg-transparent">
                    <i class="fas fa-arrow-left w-4 text-center"></i> Siteye Dön
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="btn-ticket-outline w-full !text-[var(--paper)] !border-[rgba(217,201,154,0.5)] hover:!bg-[var(--rust)] hover:!border-[var(--rust)]">
                        <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-1 min-w-0 flex flex-col relative z-10">
            <header class="nav-paper sticky top-0 z-20">
                <div class="px-4 sm:px-8 py-4 flex items-center gap-4">
                    <button type="button" @click="sidebarOpen = true"
                            class="lg:hidden flex items-center justify-center w-11 h-11 border-2 border-[var(--ink)] text-[var(--ink)]"
                            aria-label="Menüyü aç">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <div class="flex-1 min-w-0">
                        <span class="type-stamp text-[10px] text-[var(--stone)]">— Yönetim —</span>
                        <h1 class="text-xl sm:text-2xl font-bold truncate">@yield('title')</h1>
                    </div>
                    @hasSection('actions')
                        <div class="hidden sm:flex items-center gap-3">@yield('actions')</div>
                    @endif
                </div>
                @hasSection('actions')
                    <div class="sm:hidden px-4 pb-4 flex flex-wrap gap-2">@yield('actions')</div>
                @endif
            </header>

            <main class="flex-1 px-4 sm:px-8 py-8">
                @if(session('success'))
                    <div class="border-2 border-dashed border-[var(--moss)] bg-[var(--paper-deep)] text-[var(--moss)] px-4 py-3 mb-6 text-sm">
                        <i class="fas fa-circle-check mr-1"></i>{{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="border-2 border-dashed border-[var(--rust)] bg-[var(--paper-deep)] text-[var(--rust)] px-4 py-3 mb-6 text-sm">
                        <i class="fas fa-triangle-exclamation mr-1"></i>{{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
