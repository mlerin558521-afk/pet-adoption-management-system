<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Browse Pets') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    Find pets available for adoption below.
                </p>

                <form method="GET" action="{{ route('pets.browse') }}" class="flex flex-wrap gap-3 mb-6">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by name, species, breed, or age"
                           class="flex-1 px-3 py-2 border rounded-md text-sm focus:ring focus:ring-blue-300">

                    <select name="species" class="px-3 py-2 border rounded-md text-sm">
                        <option value="">All Species</option>
                        <option value="Cat" {{ request('species')=='Cat' ? 'selected' : '' }}>Cat</option>
                        <option value="Dog" {{ request('species')=='Dog' ? 'selected' : '' }}>Dog</option>
                    </select>

                    <input type="text" name="breed" value="{{ request('breed') }}"
                           placeholder="Breed"
                           class="px-3 py-2 border rounded-md text-sm">

                    <input type="number" name="age" value="{{ request('age') }}"
                           placeholder="Age"
                           class="px-3 py-2 border rounded-md text-sm">

                    <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Filter
                    </button>
                    <a href="{{ route('pets.browse') }}" class="px-3 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400">
                        Reset
                    </a>
                </form>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($pets as $pet)
                        <div class="bg-gray-50 dark:bg-gray-700 shadow rounded-lg p-4 flex flex-col items-center text-center">
                            <img src="{{ asset('storage/' . $pet->photo) }}" 
                                 alt="{{ $pet->name }}" 
                                 class="w-20 h-20 object-cover rounded-full mb-3 shadow-sm">

                            <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                {{ $pet->name }}
                            </h3>
                            <div class="space-y-1 text-xs text-gray-600 dark:text-gray-300">
                                <p><strong>Species:</strong> {{ $pet->species }}</p>
                                <p><strong>Breed:</strong> {{ $pet->breed }}</p>
                                <p><strong>Age:</strong> {{ $pet->age }} years</p>
                                <p><strong>Adopted:</strong> 
                                    <span class="{{ $pet->adopted ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $pet->adopted ? 'Yes' : 'No' }}
                                    </span>
                                </p>
                            </div>

                            @if(!$pet->adopted)
                                <form action="{{ route('adoptions.store') }}" method="POST" class="mt-3 w-full">
                                    @csrf
                                    <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                                    <button type="submit" 
                                            class="w-full bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700">
                                        Apply for Adoption
                                    </button>
                                </form>
                            @else
                                <p class="mt-3 text-xs text-gray-500">Already Adopted</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No pets available right now.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
