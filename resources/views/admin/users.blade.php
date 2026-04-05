<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    This is the Manage Users page. You can view and manage all registered accounts here.
                </p>

                <form method="GET" action="{{ route('users.index') }}" class="flex gap-3 mb-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by name"
                           class="flex-1 px-3 py-2 border rounded-md text-sm focus:ring focus:ring-blue-300">
                    <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Search
                    </button>
                    <a href="{{ route('users.index') }}" class="px-3 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400">
                        Reset
                    </a>
                </form>

                <div class="overflow-x-auto">
                    <table class="table-fixed w-full border-collapse divide-y divide-gray-200 dark:divide-gray-700 text-base leading-normal">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="w-16 px-6 py-4 text-left text-gray-700 dark:text-gray-300">ID</th>
                                <th class="w-1/4 px-6 py-4 text-left text-gray-700 dark:text-gray-300">Name</th>
                                <th class="w-1/3 px-6 py-4 text-left text-gray-700 dark:text-gray-300">Email</th>
                                <th class="w-1/4 px-6 py-4 text-center text-gray-700 dark:text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="w-16 px-6 py-4 text-left text-gray-800 dark:text-gray-200">{{ $user->id }}</td>
                                    <td class="w-1/4 px-6 py-4 text-left text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                    <td class="w-1/3 px-6 py-4 text-left text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                    <td class="w-1/4 px-6 py-4 text-center space-x-5">
                                        <a href="{{ route('users.edit', $user->id) }}" 
                                           class="text-blue-600 hover:underline">Edit</a>
                                        <button type="button" 
                                                onclick="openDeleteModal('{{ $user->name }}', '{{ route('users.destroy', $user->id) }}')" 
                                                class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
            Confirm Delete
        </h2>
        <p class="text-gray-600 dark:text-gray-300 mb-6">
            Are you sure you want to delete <span id="deleteUserName" class="font-bold"></span>?
        </p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" 
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded hover:bg-gray-400 dark:hover:bg-gray-500">
                Cancel
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(userName, actionUrl) {
        document.getElementById('deleteUserName').textContent = userName;
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
