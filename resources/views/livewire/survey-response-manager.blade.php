<div x-data>
    <div>
        <div class="relative">
            <input wire:model="newResponse" wire:keydown.enter.prevent="addResponse;$refs.newResponseInput.value = ''" x-ref="newResponseInput" type="search" id="search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <button type="button" wire:click="addResponse" @click="$refs.newResponseInput.value = ''" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter une reponse</button>
        </div>
    </div>
    <ul class="my-5">
        @foreach ($responses as $index => $response)
            <div class="relative mb-2">
                <a  wire:click="removeResponse({{ $index }})" class="text-white absolute end-2.5 bottom-2.5 focus:ring-4 focus:outline-none bg-red-600 hover:bg-red-500 active:bg-red-700 focus:ring-red-500  font-medium rounded-lg text-sm px-4 py-2 cursor-pointer">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8.6 2.6A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4c0-.5.2-1 .6-1.4ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                    </svg>
                </a>
                <input disabled value="{{$response}}" name="responses[]" type="search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" />
            </div>
        @endforeach
    </ul>
</div>
