<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Adoption Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex flex-col">

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('pams/paw.png') }}" alt="Logo" class="w-10 h-10">
                    <span class="font-bold text-lg text-gray-900">Pet Adoption Center</span>
                </a>
            </div>
            <div class="flex items-center space-x-6">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium px-3 py-1 transition-colors">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 font-medium px-3 py-1 transition-colors rounded hover:bg-gray-100">Register</a>
                    @endif
                @endif
            </div>
        </div>
    </header>

    <!-- Main section with background image -->
    <main style="flex: 1; display: flex; align-items: center; justify-content: flex-start; padding: 32px; 
                 background: url('{{ asset('pams/background.png') }}') no-repeat center center; 
                 background-size: cover;">
        <div style="max-width: 700px; background: rgba(255,255,255,0.7); padding: 32px; border-radius: 8px; text-align: left; margin-left: 48px;">
            <h1 style="font-size: 48px; font-weight: 800; color: #111827; margin-bottom: 24px;">
                Find Your New Best Friend 🐾
            </h1>
            <p class="text-xl text-gray-700 mb-4">
                Welcome to the Pet Adoption Management System — where love meets a forever home.
            </p>
            <p class="text-lg text-gray-600 mb-8">
                Browse adorable pets, manage adoption requests, and help give them the family they deserve.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-800 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Get Started
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-indigo-600 border border-indigo-600 rounded-lg shadow hover:bg-indigo-50 transition">
                        Join Us
                    </a>
                @endif
            </div>
        </div>
    </main>

    <footer class="bg-white shadow mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-gray-600">
            © {{ date('Y') }} Pet Adoption Center. All rights reserved.
        </div>
    </footer>

</body>
</html>
