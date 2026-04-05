<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    This is the Reports page. Admins can view system statistics and insights here.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            Adoption Requests Summary
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Pending: {{ $requestsPending }} <br>
                            Approved: {{ $requestsApproved }} <br>
                            Disapproved: {{ $requestsDisapproved }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            Pets Overview
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Available Pets: {{ $petsAvailable }} <br>
                            Adopted Pets: {{ $petsAdopted }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            User Activity
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Total Registered Users: {{ $totalUsers }} <br>
                            Active Users (with requests): {{ $activeUsers }} <br>
                            Inactive Users: {{ $inactiveUsers }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 shadow">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            System Health
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Last Backup: {{ $lastBackup }} <br>
                            Errors Logged: {{ $errorsCount }} <br>
                            Performance Status: {{ $systemStatus }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
