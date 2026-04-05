<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Pet') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block">Pet Name</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Photo</label>
                        <input type="file" name="photo" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Species</label>
                        <input type="text" name="species" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Characteristics</label>
                        <textarea name="characteristics" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block">Breed/Type</label>
                        <input type="text" name="breed" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Gender</label>
                        <select name="gender" class="w-full border rounded px-3 py-2">
                            <option value="">Select an option</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Age</label>
                        <input type="number" name="age" min="0" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Adopted?</label>
                        <select name="adopted" class="w-full border rounded px-3 py-2">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Save Pet
                        </button>
                        <a href="{{ route('pets.index') }}" class="ml-2 text-gray-600 hover:underline">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
