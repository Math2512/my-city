<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Création d\'un article') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-12 space-y-6 text-gray-900 dark:text-gray-100">
                <livewire:post-manager :group="$group" />
            </div>


        </div>


    </div>
    <x-action-button />

</x-app-layout>
