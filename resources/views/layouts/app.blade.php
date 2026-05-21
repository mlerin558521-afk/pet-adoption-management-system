<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background: #f5ede8;">

    <div class="min-h-screen flex">
        @if(Auth::user()->role === 'admin')
            @include('layouts.navigation')
        @else
            @include('layouts.user-navigation')
        @endif

        <div class="flex-1 min-h-screen">

            <header style="background: #7d4a3f; box-shadow: 0 2px 8px rgba(0,0,0,0.15); position: sticky; top: 0; z-index: 10;">
                <div style="max-width: 100%; padding: 0 24px; display: flex; justify-content: space-between; align-items: center; height: 64px;">

                    <div>
                        @isset($header)
                            <h2 style="font-size: 18px; font-weight: 700; color: white; letter-spacing: 0.5px;">
                                {{ $header }}
                            </h2>
                        @else
                            <h2 style="font-size: 18px; font-weight: 700; color: white;">
                                Dashboard
                            </h2>
                        @endisset
                    </div>

                    <div style="display: flex; align-items: center; gap: 16px;">

                        @if(Auth::user()->role !== 'admin')
                            <div x-data="{ notifOpen: false }" style="position: relative;">
                                <button @click="notifOpen = !notifOpen"
                                    style="display: flex; align-items: center; gap: 6px; padding: 8px 14px; background: rgba(255,255,255,0.15); border: none; border-radius: 8px; cursor: pointer; color: white; font-size: 14px; transition: background 0.2s;"
                                    onmouseover="this.style.background='rgba(255,255,255,0.25)'"
                                    onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                                    🔔
                                    <span style="background: white; color: #7d4a3f; font-size: 11px; font-weight: 700; padding: 1px 7px; border-radius: 999px;">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                </button>

                                <div x-show="notifOpen" @click.away="notifOpen = false"
                                     style="position: absolute; right: 0; margin-top: 8px; width: 360px; background: white; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); max-height: 380px; overflow-y: auto; z-index: 50;">
                                    <div style="padding: 14px 16px; border-bottom: 1px solid #f3f4f6; font-size: 13px; font-weight: 700; color: #374151;">
                                        Notifications
                                    </div>
                                    @forelse(auth()->user()->notifications as $notification)
                                        <div style="padding: 12px 16px; border-bottom: 1px solid #f9fafb; font-size: 13px; color: #4b5563;">
                                            {{ $notification->data['message'] }}
                                        </div>
                                    @empty
                                        <div style="padding: 16px; font-size: 13px; color: #9ca3af; text-align: center;">
                                            No notifications yet.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        <div x-data="{ open: false }" style="position: relative;">
                            <button @click="open = !open"
                                style="display: flex; align-items: center; gap: 8px; padding: 8px 14px; background: rgba(255,255,255,0.15); border: none; border-radius: 8px; cursor: pointer; color: white; font-size: 14px; font-weight: 600; transition: background 0.2s;"
                                onmouseover="this.style.background='rgba(255,255,255,0.25)'"
                                onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                                <div style="width: 28px; height: 28px; background: rgba(255,255,255,0.25); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                {{ Auth::user()->name }}
                                <svg style="width: 14px; height: 14px; fill: white;" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                 style="position: absolute; right: 0; margin-top: 8px; width: 180px; background: white; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); overflow: hidden; z-index: 50;">
                                <a href="{{ route('profile.edit') }}"
                                   style="display: block; padding: 12px 16px; font-size: 14px; color: #374151; text-decoration: none; transition: background 0.15s;"
                                   onmouseover="this.style.background='#f5ede8'" onmouseout="this.style.background='white'">
                                    👤 Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        style="width: 100%; text-align: left; padding: 12px 16px; font-size: 14px; color: #374151; background: transparent; border: none; cursor: pointer; transition: background 0.15s;"
                                        onmouseover="this.style.background='#f5ede8'" onmouseout="this.style.background='transparent'">
                                        🚪 Log Out
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