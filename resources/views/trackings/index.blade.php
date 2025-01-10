<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tracking Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                

                 <!-- Table for Status Kendaraan -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- <h3 class="text-2xl font-semibold mb-4">{{ __('Status') }}</h3> --}}
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-4 py-2 text-left">{{ __('Nama') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Kendaraan') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Nopol') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Sopir') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Status') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Static Data for Vehicle Statuses -->
                            <tr class="">
                                <td class="px-4 py-2">John Doe</td>
                                <td class="px-4 py-2">Honda Civic</td>
                                <td class="px-4 py-2">B 5678 DEF</td>
                                <td class="px-4 py-2"></td>
                                <td class="px-4 py-2 text-white-500">{{ __('Dipinjam') }}</td>
                                <td>
                                    <a href="{{ route('trek') }}" class="focus:outline-none text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">{{ __('TRACKING') }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

           
            </div>
        </div>
    </div>

</x-app-layout>