<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(Auth::user()->role === 'admin')
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                        Welcome, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        You are logged in as an <strong>Administrator</strong>. 
                        From here, you can manage pets, users, adoption requests, and view reports.
                    </p>
                @else
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                            Welcome back, {{ Auth::user()->name }}!
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            We’re glad to see you again. Start exploring pets, check your requests, 
                            or update your profile — your adoption journey continues here.
                        </p>

                        <p class="mt-8 text-gray-500 dark:text-gray-400 italic">
                            “Every pet deserves a loving home — and you’re part of that story.”
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
