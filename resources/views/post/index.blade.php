<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feed') }}
        </h2>
    </x-slot>

    <div class="py-8 lg:grid lg:grid-cols-3 lg:gap-4">

        @foreach ($posts as $post)
    <div class="mb-4 lg:mb-0 w-full max-w-lg mx-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#" wire:click.prevent="showPost({{ $post->id }})">
            <!-- Carousel wrapper -->
            <div class="relative h-80 w-full" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-full w-full overflow-hidden rounded-lg bg-gray-400">
                    @foreach ($post->pictures as $index => $picture)
                        <div class="hidden duration-700 ease-in-out carousel-item {{ $index === 0 ? 'block' : 'hidden' }}" data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset($picture->url) }}" class="absolute block h-auto w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                    @endforeach
                </div>
                <!-- Slider indicators -->
                @if ($post->pictures->count() > 1)
                    <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                        @foreach ($post->pictures as $index => $picture)
                            <button type="button" class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-blue-500' : 'bg-gray-300' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>

        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
            </a>
            <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">{!! $post->content !!}</p>
            <div class="mb-5">
                <ul>
                    @foreach ($post->tags as $index => $tag)
                        <li class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                            <span>{{ $tag->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Voir
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            <div class="my-5">
                {{ $post->signature() }}
            </div>
        </div>
    </div>
@endforeach


    </div>

    <x-action-button />
</x-app-layout>
