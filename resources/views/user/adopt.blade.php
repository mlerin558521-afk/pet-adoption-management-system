<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Adoption Requests') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="flex justify-center">
            <div class="w-full max-w-4xl">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    @if($requests->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400 text-center">
                            You haven’t submitted any adoption requests yet.
                        </p>
                    @else
                        <table class="table-auto border-collapse divide-y divide-gray-200 dark:divide-gray-700 w-full text-center rounded-lg overflow-hidden">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pet</th>
                                    <th class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300">Species</th>
                                    <th class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300">Breed</th>
                                    <th class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300">Status</th>
                                    <th class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300">Requested At</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($requests as $request)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                            {{ $request->pet->name }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $request->pet->species }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $request->pet->breed }}
                                        </td>
                                        <td class="px-4 py-2 text-sm 
                                            @if($request->status === 'approved') text-green-600 
                                            @elseif($request->status === 'disapproved') text-red-600 
                                            @else text-yellow-600 @endif">
                                            {{ ucfirst($request->status) }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $request->created_at->format('M d, Y h:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
