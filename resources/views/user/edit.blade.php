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
                {{ __('Editer ').$user->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('users.update', $user->id) }}" class="" enctype="multipart/form-data">
                    <div class="p-6 space-y-6">
                        @method('PUT')
                        @csrf
                        <div x-data="{ photo: null }" class="mb-5 flex justify-center">
                            <!-- Bouton de prévisualisation -->
                            <label for="photo" class="cursor-pointer">
                                <div x-show="!photo" class="w-28 h-28 bg-gray-200 rounded-full overflow-hidden">
                                    <img src="{{ asset($user->picture->url ?? 'test/4.png' ) }}" alt="Preview"
                                        class="w-full h-full object-cover rounded-full">
                                </div>
                                <template x-if="photo">
                                    <img :src="URL.createObjectURL(photo)" alt="Preview"
                                        class="w-28 h-28 object-cover rounded-full">
                                </template>
                            </label>

                            <!-- Champ de fichier caché -->
                            <input type="file" id="photo" name="user_avatar" class="hidden" accept="image/*"
                                x-on:change="photo = $event.target.files[0]">
                        </div>
                        <div class="mb-5">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input type="text" id="name" name="name"
                                class="shadow-sm {{ $errors->has('name') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                value="{{ $user->name }}">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="mail"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="mail" id="mail" name="email"
                            id="disabled-input" aria-label="disabled input" class="mb-5 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled
                                value="{{ $user->email }}">
                        </div>

                        <div class="mb-5">
                            <label for="role"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fonction</label>
                            <input type="text" id="role" name="role"
                                class="shadow-sm {{ $errors->has('role') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                value="{{ $user->role }}">
                            @error('role')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="user_groups" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner un ou plusieurs channel dont l'utilisateursera responsable <!-- <a href="#" data-modal-target="myModal" data-modal-show="myModal" class="text-blue-600 hover:underline dark:text-blue-500">Ajouter des utilisateurs</a>--></label>

                            <select id="choices" name="user_groups[]" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"" multiple>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" wire:key="{{ $group->id }}" {{ in_array($group->id, isset($user->groups) ? $user->groups->pluck('id')->toArray() : []) ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Valider
                            l'utilisateur</button>
                </form>

            </div>
        </div>

    </div>

    <x-action-button />

</x-app-layout>
