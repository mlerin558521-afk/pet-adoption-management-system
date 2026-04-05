<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    <div class="min-h-screen flex">
        @if(Auth::user()->role === 'admin')
            {{-- Admin Sidebar --}}
            @include('layouts.navigation')
        @else
            {{-- User Sidebar --}}
            @include('layouts.user-navigation')
        @endif

        <div class="flex-1 min-h-screen">
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                    
                    <div class="flex items-center">
                        @isset($header)
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ $header }}
                            </h2>
                        @else
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                Dashboard
                            </h2>
                        @endisset
                    </div>

                    <div class="flex items-center space-x-6">
                        @if(Auth::user()->role !== 'admin')
                            <div x-data="{ notifOpen: false }" class="relative">
                                <button @click="notifOpen = !notifOpen"
                                        class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                    🔔
                                    <span class="ml-2 bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                </button>

                                <div x-show="notifOpen" @click.away="notifOpen = false"
                                     class="absolute right-0 mt-2 w-[28rem] bg-white dark:bg-gray-800 shadow-lg rounded-md max-h-96 overflow-y-auto z-50">
                                    @forelse(auth()->user()->notifications as $notification)
                                        <div class="px-4 py-2 border-b text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal">
                                            {{ $notification->data['message'] }}
                                        </div>
                                    @empty
                                        <div class="px-4 py-2 text-sm text-gray-500">No notifications yet.</div>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                    class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                {{ Auth::user()->name }}
                                <svg class="ml-2 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                 class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-md text-center">
                                <a href="{{ route('profile.edit') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-6 flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
