
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gray-800 text-gray-100 p-6 rounded-lg shadow-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-semibold">{{ __('Kendaraan Tersedia') }}</h3>
                    </div>
                    <div class="text-center">
                        <span class="text-3xl font-bold">{{ $availableCars }}</span>
                    </div>
                </div>

                <div class="bg-gray-800 text-gray-100 p-6 rounded-lg shadow-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-semibold">{{ __('Kendaraan Dipinjamkan') }}</h3>
                    </div>
                    <div class="text-center">
                        <span class="text-3xl font-bold">{{ $unavailableCars }}</span>
                    </div>
                </div>

                <div class="bg-gray-800 text-gray-100 p-6 rounded-lg shadow-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-semibold">{{ __('Menunggu Persetujuan') }}</h3>
                    </div>
                    <div class="text-center">
                        <span class="text-3xl font-bold">{{ $pendingBookings }}</span>
                    </div>
                </div>
                <div class="bg-gray-800 text-gray-100 p-6 rounded-lg shadow-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-semibold">{{ __('Sopir Tersedia') }}</h3>
                    </div>
                    <div class="text-center">
                        <span class="text-3xl font-bold">{{ $availableSopirs }}</span>
                    </div>
                </div>
            </div>
            <div class="dark:bg-gray-800 bg-white p-6 rounded-lg shadow-lg">
                @include('grafik')
            </div>            
            <div class="bg-white mt-8 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-4">{{ __('Permohonan Kendaraan Menunggu Persetujuan') }}</h3>
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-4 py-2 text-left">{{ __('Nama') }}</th>
                                {{-- <th class="px-4 py-2 text-left">{{ __('Seksi') }}</th> --}}
                                <th class="px-4 py-2 text-left">{{ __('Kegiatan') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Kendaraan') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Sopir') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Tanggal Mulai') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Tanggal Selesai') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Status') }}</th>
                                <th class="px-4 py-2 text-center">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings->where('status', 'pending') as $booking)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $booking->name }}</td>
                                {{-- <td class="px-4 py-2">{{ $booking->nip }}</td> --}}
                                <td class="px-4 py-2">{{ $booking->kegiatan }}</td>
                                <td class="px-4 py-2">{{ $booking->car->name }}</td>
                                <td class="px-4 py-2">{{ $booking->sopir->name ?? "-" }}</td>
                                <td class="px-4 py-2">{{ $booking->tanggal_pinjam }}</td>
                                <td class="px-4 py-2">{{ $booking->selesai_pinjam }}</td>
                                <td class="px-4 py-2">{{ $booking->status }}</td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('bookings.approve', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="focus:outline-none text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">{{ __('APPROVE') }}</button>
                                    </form>
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">{{ __('REJECT') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                    <tr>
                                        <td colspan="10" class="px-4 py-4 text-center">{{ __('Tidak ada data tersedia') }}</td>
                                    </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table for Status Kendaraan -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-4">{{ __('Status Kendaraan') }}</h3>
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-4 py-2 text-left">{{ __('Nama') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Kegiatan') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Kendaraan') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Tanggal Mulai') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Tanggal Selesai') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Static Data for Vehicle Statuses -->
                            {{-- <tr class="border-b">
                                <td class="px-4 py-2">Toyota Avanza</td>
                                <td class="px-4 py-2">B 1234 ABC</td>
                                <td class="px-4 py-2">{{ __('Dipinjam') }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2">Honda Civic</td>
                                <td class="px-4 py-2">B 5678 DEF</td>
                                <td class="px-4 py-2 ">{{ __('Dipinjam') }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2">Suzuki Ertiga</td>
                                <td class="px-4 py-2">B 9012 GHI</td>
                                <td class="px-4 py-2 text-green-500">{{ __('Tersedia') }}</td>
                            </tr> --}}
                            @forelse ($bookings->where('status', 'approved') as $booking)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $booking->name }}</td>
                                <td class="px-4 py-2">{{ $booking->kegiatan }}</td>
                                <td class="px-4 py-2">{{ $booking->car->name }}</td>
                                <td class="px-4 py-2">{{ $booking->tanggal_pinjam }}</td>
                                <td class="px-4 py-2">{{ $booking->selesai_pinjam }}</td>
                                <td class="px-4 py-2">{{ $booking->status }}</td>
                            </tr>
                            @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-center">{{ __('Tidak ada data tersedia') }}</td>
                                    </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
