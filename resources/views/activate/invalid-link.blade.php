<x-guest-layout>

    <div class="mb-4 text-md text-gray-600 dark:text-gray-400 flex flex-col text-center my-5">
        {{ __('Le lien n\'est plus valide') }}

    @if (Route::has('password.request'))
        <a class="my-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="{{ route('password.request') }}">
            {{ __('Mot de passe oublié ?') }}
        </a>
    @endif
    <a class="mb-5 text-center font-medium text-sm items-center px-4 py-2.5 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-lg text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" href="{{ route('login') }}">
        {{ __('Se connecter') }}
    </a>
    </div>
</x-guest-layout>
