<div>

    @if (session()->has('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif
    <form wire:submit.prevent="save">
        <div class="my-5 p-6 space-y-6">

        <div x-data="fileUpload()">
            <div class="relative border-2 border-dashed border-gray-300 p-4 text-center flex flex-col justify-center items-center my-5"
                x-on:drop="isDropping = false" x-on:drop.prevent="handleFileDrop($event)"
                x-on:dragover.prevent="isDropping = true" x-on:dragleave.prevent="isDropping = false">
                <div class="absolute top-0 bottom-0 left-0 right-0 z-30 flex items-center justify-center bg-gradient-to-r from-cyan-500 to-blue-500 opacity-90"
                    x-show="isDropping">
                    <span class="text-3xl text-white">Relâchez pour télécharger !</span>
                </div>
                <label class="flex flex-col items-center justify-center cursor-pointer p-2" for="file-upload">
                    <p class="text-gray-600">Glissez-déposez vos photos ici ou <span class="underline font-bold">cliquez
                            ici</span> pour sélectionner des images.</p>
                    <input type="file" id="file-upload" multiple @change="handleFileSelect" class="hidden"
                        wire:model="files" />
                </label>
                <div class="bg-gray-200 h-[2px] w-1/3 mt-3" x-show="isUploading">
                    <div class="bg-green-500 h-[3px]" style="transition: width 2s" :style="`width: ${progress}%;`">
                    </div>
                </div>
                @if (count($files))
                    <ul class="mt-5 flex flex-col justify-center">
                        @foreach ($files as $key => $file)
                            <li class="relative flex justify-center mt-1">
                                <img src="{{ $file->temporaryUrl() }}" class="h-40 w-auto">
                                <button class="text-red-500 absolute -top-2 -right-2"
                                    wire:click="deleteToPhotos('{{ $key }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24" class="bg-white">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
        <div class="my-5">
            <label for="title"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre</label>
            <input type="text" id="title" name="title"  wire:model="title" value="{{old('title')}}"
                class="shadow-sm {{ $errors->has('title') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
            @error('title')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                        class="font-medium">Oops!</span> {{ $message }}</p>
            @enderror
        </div>
        <div class="my-5">
            <label for="description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <div wire:ignore>
                <div id="editor"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-b-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-48">
                </div>
                <textarea id="content-textarea" name="description" wire:model="description" class="hidden"></textarea>
            </div>
            <div >
                @error('description')
                    <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div x-data="{ isChecked: false, startDate: '', endDate: '' }" class="my-5 ">
            <label class="inline-flex items-center ml-1">
                <svg class="text-gray-500 transition duration-75 dark:text-gray-400 w-6 h-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5 5c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1h1c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1h1c.6 0 1-.4 1-1a1 1 0 1 1 2 0c0 .6.4 1 1 1a2 2 0 0 1 2 2v1c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V7c0-1.1.9-2 2-2ZM3 19v-7c0-.6.4-1 1-1h16c.6 0 1 .4 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6-6c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1Zm2 0a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Zm6 0c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1ZM7 17a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Zm6 0c0-.6-.4-1-1-1a1 1 0 1 0 0 2c.6 0 1-.4 1-1Zm2 0a1 1 0 1 1 2 0c0 .6-.4 1-1 1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                </svg>
                <span class="mr-2">Evenement ?</span>
                <input type="checkbox" x-model="isChecked" wire:model="isChecked" class="mr-2 cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </label>

            <div x-show="isChecked" class="flex items-center mt-2 p-6 md:p-8 border-gray-300 border-2 rounded-lg">
                <input name="start" type="date"
                    x-model="startDate"
                    wire:model="startDate"
                    x-on:change="endDate = startDate"
                    class="shadow-sm {{ $errors->has('startDate') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="Select date start">
                <span class="mx-4 text-gray-500">au</span>
                <div class="flex flex-col w-full">
                    <input name="end" type="date"
                        wire:model="endDate"
                        x-model="endDate"
                        class="shadow-sm {{ $errors->has('endDate') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Select date end">
                </div>
            </div>
            @error('startDate')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                        class="font-medium">Oops!</span> {{ $message }}</p>
            @enderror
            @error('endDate')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                        class="font-medium">Oops!</span> {{ $message }}</p>
            @enderror
        </div>

        <div x-data="{ isChecked: false, startDate: '', endDate: '' }" class="my-5 ">
            <label class="inline-flex items-center ml-1">
                <svg class="text-gray-500 transition duration-75 dark:text-gray-400 w-6 h-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M9 7V2.2a2 2 0 0 0-.5.4l-4 3.9a2 2 0 0 0-.3.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1 9a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Zm2-5c.6 0 1 .4 1 1v6a1 1 0 1 1-2 0v-6c0-.6.4-1 1-1Zm4 4a1 1 0 1 0-2 0v3a1 1 0 1 0 2 0v-3Z" clip-rule="evenodd"/>
                </svg>

                <span class="mr-2">Créer un sondage</span>
                <input type="checkbox" x-model="isChecked" wire:model="isSurvey" class="mr-2 cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </label>

            <div x-show="isChecked" class="mt-2 p-6 md:p-8 border-gray-300 border-2 rounded-lg">
                <div class="mb-5">
                    <label for="survey_question" wire:model="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre question</label>
                    <input type="text" wire:model="question" name="survey_question" id="survey_question" class="{{ $errors->has('question') ? 'bg-red-50 border border-red-500 text-red-900' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' }}  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    @error('question')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">Oops!</span> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="inline-flex items-center mb-5">
                        <span class="mr-2">Réponse choix multiple ?</span>
                        <input wire:model="multiple" type="checkbox" class="mr-2 cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </label>
                    <div>
                        <livewire:survey-response-manager />
                        @error('responses')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!</span> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-5">
                    <label for="deadline" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deadline</label>
                    <input name="deadline" id="deadline" type="date" wire:model="deadline"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Select date end">
                </div>
            </div>
        </div>

        <div class="my-5" wire:ignore>
            <label for="tags_choices" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner un ou plusieurs <span class="font-extrabold">Tags</span> pour ce post</label>
            <select class="test" id="tags_choices" wire:model="selectedTags" class="rounded-lg" multiple>
                @foreach($tags as $id => $tagName)
                    <option value="{{ $id }}">{{ $tagName }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-center mt-5">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Valider</button>
        </div>
    </form>

    <script>
        function fileUpload() {
            return {
                isDropping: false,
                isUploading: false,
                progress: 0,
                handleFileSelect(event) {
                    if (event.target.files.length) {
                        this.uploadFiles(event.target.files)
                    }
                },
                handleFileDrop(event) {
                    if (event.dataTransfer.files.length > 0) {
                        this.uploadFiles(event.dataTransfer.files)
                    }
                },
                uploadFiles(files) {
                    const $this = this;
                    this.isUploading = true;
                    @this.uploadMultiple('files', files,
                        function(success) {
                            $this.isUploading = false;
                            $this.progress = 0;
                        },
                        function(error) {
                            console.log('error', error);
                        },
                        function(event) {
                            $this.progress = event.detail.progress;
                        }
                    );
                }
            };
        }

    </script>
</div>
