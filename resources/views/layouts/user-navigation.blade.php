<nav 
     class="bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 w-80 h-screen flex flex-col justify-between relative">

    <div class="flex flex-col flex-grow">
        <div class="flex items-center space-x-2 p-4">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('pams/paw.png') }}" alt="Logo" class="h-10 w-10">
            </a>
            <span class="font-bold text-lg text-gray-800 dark:text-gray-200">
                Pet Adoption Center
            </span>
        </div>

        <div class="flex flex-col space-y-6 px-6 mt-8">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-4 py-2">
                {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link :href="route('pets.browse')" :active="request()->routeIs('pets.*')" class="px-4 py-2">
                {{ __('Browse Pets') }}
            </x-nav-link>

            <x-nav-link :href="route('adoptions.userIndex')" :active="request()->routeIs('adoptions.userIndex')" class="px-4 py-2">
                {{ __('My Requests') }}
            </x-nav-link>
        </div>
    </div>
</nav>
