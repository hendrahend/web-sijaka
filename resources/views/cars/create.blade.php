<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                 
                  
                        <form method="POST" action="{{ route('cars.store') }}">
                            @csrf
                    
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
    
                            <!-- Nopol -->
                            <div class="mt-4">
                                <x-input-label for="nopol" :value="__('Nopol')" />
                                <x-text-input id="nopol" class="block mt-1 w-full" type="text" name="nopol" :value="old('nopol')" required autocomplete="nopol" />
                                <x-input-error :messages="$errors->get('nopol')" class="mt-2" />
                            </div>
    
                            <!-- Image URL -->
                            <div class="mt-4">
                                <x-input-label for="image" :value="__('Image URL')" />
                                <x-text-input id="image" class="block mt-1 w-full" type="url" name="image" :value="old('image')" autocomplete="image" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                    
                            <!-- Confirm Password -->

                            <div class="flex items-center justify-end mt-4">
                                <x-danger-link-button href="{{ route('cars.index') }}">
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
