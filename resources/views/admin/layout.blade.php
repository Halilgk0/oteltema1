<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 py-6 flex-shrink-0">
            <div class="px-6 mb-8">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
            </div>
            <nav class="px-3">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-3 py-2 rounded-lg mb-2 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.rooms') }}" 
                   class="block px-3 py-2 rounded-lg mb-2 {{ request()->routeIs('admin.rooms') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-bed mr-2"></i> Odalar
                </a>
                <a href="{{ route('admin.bookings') }}" 
                   class="block px-3 py-2 rounded-lg mb-2 {{ request()->routeIs('admin.bookings') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-calendar-check mr-2"></i> Rezervasyonlar
                </a>
            </nav>
            <div class="px-6 mt-auto">
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i> Çıkış Yap
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <div class="bg-white shadow-md py-4 px-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">@yield('title')</h1>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html> 