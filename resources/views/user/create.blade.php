<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <a href="{{ route('users.index') }}" class="mr-4">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ajouter un utilisateur') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">
                    <div class="p-6 space-y-6">
                        <form method="POST" action="{{ route('users.store') }}" class="" enctype="multipart/form-data">
                            @include('partials.forms._create_user')
                        </form>
                    </div>


            </div>
        </div>

    </div>

    <x-action-button />

</x-app-layout>
