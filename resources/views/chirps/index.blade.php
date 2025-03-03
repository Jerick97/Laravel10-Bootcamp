<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!--@dump($errors->get('message'))-->
                    <form class="max-w-sm mx-auto flex flex-col gap-2" method="POST" action="{{ route('chirps.store') }}">
                        @csrf <!-- CSRF Token - Siempre que se utilice Post -->
                        <label for="message"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{ __('Your message') }}</label>
                        <textarea id="message" name="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="{{ __('What\'s on your mind?') }}">{{ old('message') }}</textarea>

                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button
                            class="flex items-center justify-center">{{ __('Chirps') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
