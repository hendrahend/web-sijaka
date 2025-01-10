<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booking Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Layout: List of Cars -->
                    <div class="car-list p-6">
                        <h3 class="text-xl font-semibold mb-4">Pilih Kendaraan</h3>

                        <div class="justify-center flex pb-1">
                            {{-- <button class="bg-blue-500 text-white py-2 px-4 w-full rounded-md">Booking Disini</button> --}}
                            <a type="button" href="{{ route('bookings.create') }}"
                                class="bg-blue-500 text-center w-full px-4 py-2 font-medium text-white border-gray-300 leading-5 rounded-md hover:text-slate-300 ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                Booking Disini
                            </a>
                        </div>
                        <div class="mt-6 flex justify-between items-center pb-3">
                            <button id="prev-day" class="text-gray-500 hover:text-gray-700">← Previous Day</button>
                            <button id="reset-day" class="text-blue-500 hover:text-blue-700">Back to Today</button>
                            <button id="next-day" class="text-gray-500 hover:text-gray-700">Next Day →</button>
                        </div>

                      
                        <!-- List Of Cars-->
                        <div class="space-y-4 max-h-96 overflow-y-auto">
                            @foreach ($cars as $car)
                                <div class="flex justify-between items-center p-4 bg-gray-700 rounded-lg">
                                    <div class="flex items-center">
                                        <img src="{{ $car->image }}" class="w-16 h-16 object-cover mr-4">
                                        <span class="font-medium text-base">{{ $car->name }} - {{ $car->nopol }} </span>
                                    </div>
                                    <div>
                                        <div class="flex flex-col justify-items-start text-left">
                                            <h3>Status</h3>
                                            <span class="font-medium text-base">{{ $car->status }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                      
                    </div>

                    <!-- Right Layout: Calendar -->
                    <div class="calendar p-6">
                        <h3 class="text-xl font-semibold mb-4">Tanggal</h3>
                        <!-- FullCalendar container -->
                        @include('bookings.calendar', ['approvedBookings' => $approvedBookings])
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
