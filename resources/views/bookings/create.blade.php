<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Peminjaman Kendaraan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus autocomplete="name" disabled />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="nip" :value="__('NIP')" />
                            <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" value="{{ $user->nip }}" required autofocus autocomplete="nip" disabled />
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                        </div>
                        <div class="justify-around flex mt-2 gap-2">
                            <div class="w-full">
                                <x-input-label for="tanggal_pinjam" :value="__('Mulai Pinjam')" />
                                <x-text-input id="tanggal_pinjam" class="block mt-1 w-full" type="date" name="tanggal_pinjam" :value="old('tanggal_pinjam')" required autofocus autocomplete="tanggal_pinjam" />
                                <x-input-error :messages="$errors->get('tanggal_pinjam')" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-input-label for="selesai_pinjam" :value="__('Selesai Pinjam')" />
                                <x-text-input id="selesai_pinjam" class="block mt-1 w-full" type="date" name="selesai_pinjam" :value="old('selesai_pinjam')" required autofocus autocomplete="selesai_pinjam" />
                                <x-input-error :messages="$errors->get('selesai_pinjam')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mt-2">
                            <x-input-label for="car_id" :value="__('Kendaraan')" />
                            <select id="car_id" name="car_id" class="block dark:border-gray-700 mt-1 w-full dark:bg-gray-900 rounded-md">
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>{{ $car->name . ' - ' . $car->nopol }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('car_id')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <label for="with_driver" class="inline-flex items-center">
                                <input id="with_driver" type="checkbox" class="form-checkbox" name="with_driver" {{ old('with_driver') ? 'checked' : '' }} onclick="toggleDriverField()">
                                <span class="ml-2 text-sm text-gray-100">{{ __('Dengan Sopir ?') }}</span>
                            </label>
                        </div>
                        <div class="mt-2" id="driver_field" style="display: none;">
                            <x-input-label for="sopir_id" :value="__('Sopir')" />
                            <select id="sopir_id" name="sopir_id" class="block dark:border-gray-700 mt-1 w-full dark:bg-gray-900 rounded-md">
                                <option value="">{{ __('Pilih Sopir') }}</option>
                                @foreach($drivers as $drv)
                                    <option value="{{ $drv->id }}" {{ old('sopir_id') == $drv->id ? 'selected' : '' }}>{{ $drv->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('sopir_id')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="kegiatan" :value="__('Kegiatan')" />
                            <x-text-input id="kegiatan" class="block mt-1 w-full" type="text" name="kegiatan" :value="old('kegiatan')" required autofocus autocomplete="kegiatan" />
                            <x-input-error :messages="$errors->get('kegiatan')" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-input-label for="catatan" :value="__('Catatan')" />
                            <textarea id="catatan" name="catatan" class="block dark:border-gray-700 mt-1 w-full dark:bg-gray-900 rounded-md" rows="4" placeholder="{{ __('Cth: Surat Tugas, dll.') }}" required>{{ old('catatan') }}</textarea>
                            <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button href="{{ route('bookings.index') }}">
                                {{ __('Batal') }}
                            </x-danger-link-button>
                
                            <x-primary-button class="ms-4">
                                {{ __('Buat') }}
                            </x-primary-button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function toggleDriverField() {
        var checkBox = document.getElementById('with_driver');
        var driverField = document.getElementById('driver_field');
        if (checkBox.checked) {
            driverField.style.display = 'block';
        } else {
            driverField.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleDriverField();
    });
</script>