<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('History Peminjaman') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="py-5 mb-5">
                        <a href="{{ route('cetak') }}" class="focus:outline-none text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">{{ __('BUAT LAPORAN') }}</a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-gray-700 dark:text-gray-200 uppercase bg-white dark:bg-gray-800 ">
                                <tr
                                    class="bg-white border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="col" class="px-6 py-3 text-center">{{ __('NIP') }}</th>
                                    <th scope="col" class="px-6 py-3 text-center">{{ __('Nama') }}</th>
                                    <th scope="col" class="px-6 py-3 text-center">{{ __('Kegiatan') }}</th>
                                    <th scope="col" class="px-6 py-3 text-center">{{ __('Kendaraan') }}</th>
                                    <th scope="col" class="px-6 py-3 text-center">{{ __('Nopol') }}</th>
                                    <th scope="col" class="px-6 py-3 text-center">{{ __('Sopir') }}</th>
                                    <th scope="col" class="px-6 py-3 text-center">{{ __('Tgl Mulai') }}</th>
                                    <th scope="col" class="px-6 py-3 text-center">{{ __('Tgl Selesai') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history )
                                <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-center">{{ $history->nip }}</td>
                                    <td class="px-6 py-4 text-center">{{ $history->name }}</td>
                                    <td class="px-6 py-4 text-center">{{ $history->kegiatan }}</td>
                                    <td class="px-6 py-4 text-center">{{ $history->car->name }}</td>
                                    <td class="px-6 py-4 text-center">{{ $history->car->nopol }}</td>
                                    <td class="px-6 py-4 text-center">{{ $history->sopir->name ?? "-" }}</td>
                                    <td class="px-6 py-4 text-center">{{ $history->tanggal_pinjam }}</td>
                                    <td class="px-6 py-4 text-center">{{ $history->selesai_pinjam }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>