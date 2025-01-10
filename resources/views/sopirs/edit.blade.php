<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Data Sopir') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('sopirs.update',$sopir->id) }}">
                        @csrf
                        @method('PUT')
                
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $sopir->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="no_wa" :value="__('No. Whatsapp')" />
                            <div class="flex items-center">
                                <span class="px-2 py-1.5 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md text-gray-700">+62</span>
                                <x-text-input id="no_wa" class="block mt-1 w-full rounded-l-none" type="number" name="no_wa" :value="old('no_wa', $sopir->no_wa)" required autocomplete="no_wa" />
                            </div>
                            <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('sopirs.index')">
                                {{ __('Batal') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4" :href="route('sopirs.update', $sopir)">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>