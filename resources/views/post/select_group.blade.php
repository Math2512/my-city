<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Création d\'un article') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 space-y-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('articles.create_with_group') }}" method="POST">
                    @csrf
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner un channel de diffusion</label>
                    <select name="group" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Choissez un channel</option>
                        @foreach ($userGroups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4">Créer l'article</button>
                </form>
            </div>
        </div>
    </div>
    <x-action-button />
</x-app-layout>
