<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


        <div class="py-0 dark:text-gray-400">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <livewire:task-manager/>
                    </div>
                </div>

                <div class="mt-8 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 mb-60 border-gray-200">
                        <livewire:category-manager/>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
