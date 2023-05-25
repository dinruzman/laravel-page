<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl md:text-2xl xs:text-gray-200 sm:text-gray-800 md:text-gray-800  leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
