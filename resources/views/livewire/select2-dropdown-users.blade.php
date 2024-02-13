<div >
    <label for="group_managers" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner un ou plusieurs responsables de cette diffusion <!--<a href="#" data-modal-target="myModal" data-modal-show="myModal" class="text-blue-600 hover:underline dark:text-blue-500">Ajouter des utilisateurs</a>--></label>

    <select name="group_managers[]" id="group_managers" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" multiple>
        @foreach($users as $user)
            <option value="{{ $user->id }}" wire:key="{{ $user->id }}" {{in_array($user->id, isset($group->users) ? $group->users->pluck('id')->toArray() : []) ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
</div>
