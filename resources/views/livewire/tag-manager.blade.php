<div x-data>
    <!-- Formulaire pour ajouter un nouveau tag -->
    <div>
        <div class="relative">
            <input wire:model="newTag" wire:keydown.enter.prevent="addTag;$refs.newTagInput.value = ''" x-ref="newTagInput" type="search" id="search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <button type="button" wire:click="addTag" @click="$refs.newTagInput.value = ''" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter un tag</button>
        </div>
    </div>
    <ul class="my-5">
        @foreach ($tags as $index => $tag)

            <input type="hidden" name="tags[]" value="{{ $tag }}" />
            <li class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                <span>{{ $tag }}</span>
                <button type="button" wire:click="removeTag({{ $index }})" class="ml-1 cursor-pointer">
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6m0 12L6 6"/>
                    </svg>
                </button>
            </li>
        @endforeach
    </ul>
</div>
