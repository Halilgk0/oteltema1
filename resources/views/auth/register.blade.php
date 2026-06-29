@extends('layouts.app')

@section('title', 'Kayıt Ol')

@section('content')
<!-- Country Flags CSS -->
<link href="https://cdn.jsdelivr.net/npm/country-flag-icons/css/country-flag-icons.min.css" rel="stylesheet">

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Yeni Hesap Oluşturun
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Zaten hesabınız var mı?
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Giriş yapın
                </a>
            </p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="name" class="sr-only">Ad Soyad</label>
                    <input id="name" name="name" type="text" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Ad Soyad">
                </div>
                <div>
                    <label for="email" class="sr-only">Email adresi</label>
                    <input id="email" name="email" type="email" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Email adresi">
                </div>
                <div class="flex -space-x-px">
                    <div class="w-1/3 relative">
                        <label for="country_code" class="sr-only">Ülke Kodu</label>
                        <select id="country_code" name="country_code" required 
                                class="appearance-none rounded-none relative block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                            <option value="+90" data-country="TR">+90 Türkiye</option>
                            <option value="+1" data-country="US">+1 USA</option>
                            <option value="+44" data-country="GB">+44 UK</option>
                            <option value="+49" data-country="DE">+49 Germany</option>
                            <option value="+33" data-country="FR">+33 France</option>
                            <option value="+39" data-country="IT">+39 Italy</option>
                            <option value="+34" data-country="ES">+34 Spain</option>
                            <option value="+31" data-country="NL">+31 Netherlands</option>
                            <option value="+7" data-country="RU">+7 Russia</option>
                            <option value="+86" data-country="CN">+86 China</option>
                            <option value="+81" data-country="JP">+81 Japan</option>
                            <option value="+82" data-country="KR">+82 South Korea</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="fi fi-tr text-lg"></span>
                        </div>
                    </div>
                    <div class="w-2/3">
                        <label for="phone" class="sr-only">Telefon</label>
                        <input id="phone" name="phone" type="tel" required 
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                               placeholder="Telefon numarası">
                    </div>
                </div>
                <div>
                    <label for="password" class="sr-only">Şifre</label>
                    <input id="password" name="password" type="password" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Şifre">
                </div>
                <div>
                    <label for="password_confirmation" class="sr-only">Şifre Tekrar</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                           placeholder="Şifre Tekrar">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Kayıt Ol
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('country_code').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const countryCode = selectedOption.getAttribute('data-country').toLowerCase();
    const flagElement = this.parentElement.querySelector('.fi');
    flagElement.className = `fi fi-${countryCode} text-lg`;
});
</script>
@endsection 