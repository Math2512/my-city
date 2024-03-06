<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <a href="{{ route('groups.index') }}" class="mr-4">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ajouter un channel') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('groups.store') }}" class="" enctype="multipart/form-data">
                    <div class="p-6 space-y-6">
                        @csrf
                        <input type="hidden" name="client_id" value="1">
                        <div x-data="{ photo: null }" class="mb-5 flex justify-center">
                            <!-- Bouton de prévisualisation -->
                            <label for="photo" class="cursor-pointer">
                                <div x-show="!photo" class="w-28 h-28 bg-gray-200 rounded-full overflow-hidden">
                                    <img src="{{ asset('test/4.png') }}" alt="Preview"
                                        class="w-full h-full object-cover rounded-full">
                                </div>
                                <template x-if="photo">
                                    <img :src="URL.createObjectURL(photo)" alt="Preview"
                                        class="w-28 h-28 object-cover rounded-full">
                                </template>
                            </label>

                            <!-- Champ de fichier caché -->
                            <input type="file" id="photo" name="group_avatar" class="hidden" accept="image/*"
                                x-on:change="photo = $event.target.files[0]">
                        </div>
                        <div class="mb-5">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" id="name" name="name"
                                class="shadow-sm {{ $errors->has('name') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="activity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                                d'Activitée</label>
                            <input type="text" id="activity" name="activity"
                                class="shadow-sm {{ $errors->has('activity') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                value="{{ old('activity') }}">
                            @error('activity')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="block p-2.5 w-full text-sm {{ $errors->has('description') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} rounded-lg border focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Ajouter une description...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="group_managers" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner un ou plusieurs responsables de cette diffusion <!--<a href="#" data-modal-target="myModal" data-modal-show="myModal" class="text-blue-600 hover:underline dark:text-blue-500">Ajouter des utilisateurs</a>--></label>
                            <select name="group_managers[]" id="choices" class="rounded-lg" multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut</label>
                            <div x-data="{ isChecked: true }">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" x-model="isChecked" class="sr-only peer" name="status" id="status">
                                    <div x-bind:class="{ 'bg-green-600': isChecked, 'bg-gray-200 dark:bg-gray-700': !isChecked }" class="w-11 h-6 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600"></div>
                                    <span x-text="isChecked ? 'Actif' : 'Inactif'" class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-5">
                            <livewire:tag-manager :groupId="null"/>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Valider
                            le diffuseur</button>
                </form>

            </div>
        </div>

        <!-- Edit user modal -->
        <div id="myModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <form class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Créer utilisateur
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="myModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form id="votre-formulaire">
                            @include('partials.forms._create_user')
                        </form>
                    </div>
            </div>
            </form>
        </div>

    </div>

    </div>

    <x-action-button />

</x-app-layout>

<script>

    window.addEventListener('DOMContentLoaded', () => {
        var form = document.querySelector('#votre-formulaire');
        form.addEventListener('submit', function(event) {
            // Empêche la soumission du formulaire par défaut
            event.preventDefault();
            alert()
        });
    });
    </script>
