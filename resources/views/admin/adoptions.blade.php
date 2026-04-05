<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adoption Requests') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    This is the Adoption Requests page. Admins can approve or disapprove requests here.
                </p>

                <form method="GET" action="{{ route('adoptions.index') }}" class="flex gap-3 mb-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by user name"
                           class="flex-1 px-3 py-2 border rounded-md text-sm focus:ring focus:ring-blue-300">
                    <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Search
                    </button>
                    <a href="{{ route('adoptions.index') }}" class="px-3 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400">
                        Reset
                    </a>
                </form>

                <div class="overflow-x-auto">
                    <table class="table-fixed w-full border-collapse divide-y divide-gray-200 dark:divide-gray-700 text-base leading-normal">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left">Request ID</th>
                                <th class="px-6 py-4 text-left">Pet</th>
                                <th class="px-6 py-4 text-left">User</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td class="px-6 py-4">{{ $request->id }}</td>
                                    <td class="px-6 py-4">{{ $request->pet->name }}</td>
                                    <td class="px-6 py-4">{{ $request->user->name }}</td>
                                    <td class="px-6 py-4 text-center">{{ ucfirst($request->status) }}</td>
                                    <td class="px-6 py-4 text-center space-x-4">
                                        @if($request->status === 'pending')
                                            <form action="{{ route('adoptions.approve', $request->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1 bg-green-800 text-black rounded hover:bg-green-700">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('adoptions.disapprove', $request->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                    Disapprove
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">No actions</span>
                                        @endif
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
