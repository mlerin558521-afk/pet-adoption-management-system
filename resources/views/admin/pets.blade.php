<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Pets') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4">
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    This is the Manage Pets page. You can add, edit, or delete pets here.
                </p>

                <form method="GET" action="{{ route('pets.index') }}" class="flex flex-wrap gap-3 mb-4">
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

                    <select name="adopted" class="px-3 py-2 border rounded-md text-sm">
                        <option value="">All</option>
                        <option value="1" {{ request('adopted')=='1' ? 'selected' : '' }}>Adopted</option>
                        <option value="0" {{ request('adopted')=='0' ? 'selected' : '' }}>Not Adopted</option>
                    </select>

                    <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Filter
                    </button>
                    <a href="{{ route('pets.index') }}" class="px-3 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400">
                        Reset
                    </a>
                </form>

                <div class="flex justify-end mb-4">
                    <a href="{{ route('pets.create') }}"
                       class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        + Add Pet
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($pets as $pet)
                        <div class="rounded-lg shadow-md bg-gray-50 dark:bg-gray-700 p-4 flex flex-col justify-between 
                                    transform transition duration-200 hover:scale-105 hover:shadow-lg">
                            
                            <div class="flex justify-center mb-3">
                                @if($pet->photo)
                                    <img src="{{ asset('storage/'.$pet->photo) }}" 
                                         alt="{{ $pet->name }}" 
                                         class="h-20 w-20 object-cover rounded-full shadow-sm">
                                @else
                                    <div class="h-20 w-20 flex items-center justify-center bg-gray-200 dark:bg-gray-600 rounded-full text-gray-500 text-xs">
                                        No photo
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2 text-center">
                                {{ $pet->name }}
                            </h3>
                            <div class="space-y-1 text-xs text-gray-600 dark:text-gray-300 text-center">
                                <p><strong>Species:</strong> {{ $pet->species }}</p>
                                <p><strong>Characteristics:</strong> {{ $pet->characteristics }}</p>
                                <p><strong>Breed:</strong> {{ $pet->breed }}</p>
                                <p><strong>Gender:</strong> {{ $pet->gender }}</p>
                                <p><strong>Age:</strong> {{ $pet->age }} years</p>
                                <p><strong>Adopted:</strong> 
                                    <span class="{{ $pet->adopted ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $pet->adopted ? 'Yes' : 'No' }}
                                    </span>
                                </p>
                            </div>

                            <div class="mt-3 flex justify-center gap-6">
                                <a href="{{ route('pets.edit', $pet->id) }}" 
                                   class="inline-flex items-center text-blue-600 hover:underline text-xs font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            onclick="openConfirmModal('{{ $pet->id }}', '{{ $pet->name }}')"
                                            class="inline-flex items-center text-red-600 hover:underline text-xs font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
            <h2 class="text-lg font-semibold mb-4">Confirm Delete</h2>
            <p id="confirmText" class="text-sm text-gray-700 mb-6"></p>
            <div class="flex justify-end gap-4">
                <button onclick="closeConfirmModal()" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button id="confirmDeleteBtn" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>

    <script>
        let deleteForm = null;

        function openConfirmModal(petId, petName) {
            deleteForm = document.querySelector(`form[action*="/pets/${petId}"]`);
            document.getElementById('confirmText').textContent = "Are you sure you want to delete " + petName + "?";
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            deleteForm = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
</x-app-layout>
