<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ma commune') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <livewire:tag-manager/>
    </div>
</x-app-layout>
