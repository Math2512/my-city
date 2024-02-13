
<div class="p-6 space-y-6">
    @csrf
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
        <input type="file" id="photo" name="user_avatar" class="hidden" accept="image/*"
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
        <label for="mail"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="mail" id="mail" name="email"
            class="shadow-sm {{ $errors->has('email') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            value="{{ old('email') }}">
        @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                    class="font-medium">Oops!</span> {{ $message }}</p>
        @enderror
    </div>
    <div class="mb-5">
        <label for="mail"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Créer un mot de passe temporaire</label>
        <input type="password" id="password" name="password"
            class="shadow-sm {{ $errors->has('password') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
        @error('password')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                    class="font-medium">Oops!</span> {{ $message }}</p>
        @enderror
        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">L'utilisateur pourra le modifier plus tard.</p>
    </div>
    <div class="mb-5">
        <label for="role"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fonction</label>
        <input type="text" id="role" name="role"
            class="shadow-sm {{ $errors->has('role') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
            value="{{ old('role') }}">
        @error('role')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                    class="font-medium">Oops!</span> {{ $message }}</p>
        @enderror
    </div>
    @if (isset($groups))
        <div class="mb-5">
            @livewire('select2-dropdown-groups', ['groups'=>$groups])
        </div>
    @endif
    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Valider
        l'utilisateur</button>
</div>
