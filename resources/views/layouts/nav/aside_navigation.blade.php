<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full  sm:translate-x-0 bg-gray-800 border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{route('dashboard')}}"
                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900 ' : 'text-white'  }} group">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-gray-900  {{request()->routeIs('dashboard') ? 'text-gray-900' : 'text-gray-400'  }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('client.index')}}"
                    class="flex items-center p-2 rounded-lg {{request()->routeIs('client.index') ? 'bg-gray-100 text-gray-900 ' : 'text-white'  }} hover:bg-gray-100 hover:text-gray-900 group">
                    <svg class="flex-shrink-0 w-5 h-5 transition duration-75 {{request()->routeIs('client.index') ? 'text-gray-900' : 'text-gray-400'  }} group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path fill-rule="evenodd" d="M4 4c0-.6.4-1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1c0 .6.4 1 1 1h1c.6 0 1-.4 1-1V7c0-.6-.4-1-1-1H9Zm5 0a1 1 0 0 0-1 1v1c0 .6.4 1 1 1h1c.6 0 1-.4 1-1V7c0-.6-.4-1-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1c0 .6.4 1 1 1h1c.6 0 1-.4 1-1v-1c0-.6-.4-1-1-1H9Zm5 0a1 1 0 0 0-1 1v1c0 .6.4 1 1 1h1c.6 0 1-.4 1-1v-1c0-.6-.4-1-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Ma commune</span>
                </a>
            </li>
            <li>
                <a href="{{route('articles.index')}}"
                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 hover:text-gray-900 group {{request()->routeIs('articles.index') ? 'bg-gray-100 text-gray-900 ' : 'text-white'  }}">
                    <svg class="flex-shrink-0 w-5 h-5 transition duration-75 {{request()->routeIs('articles.index') ? 'text-gray-900' : 'text-gray-400'  }}  group-hover:text-gray-800"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Feed</span>
                    <span
                        class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                </a>
            </li>

            @can('viewAny', App\Models\Group::class)
            <li>
                <a href="{{route('groups.index')}}"
                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 hover:text-gray-900 {{request()->routeIs('groups.index') || request()->routeIs('groups.edit') || request()->routeIs('groups.create') ? 'bg-gray-100 text-gray-900 ' : 'text-white'  }} group">
                    <svg class="flex-shrink-0 w-5 h-5 {{request()->routeIs('groups.index') || request()->routeIs('groups.edit') || request()->routeIs('groups.create') ? 'text-gray-900 ' : 'text-gray-400'  }} group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M18.5 3.1c.3.2.5.5.5.9v16a1 1 0 0 1-1.6.8L12 17V7.1l5.4-4a1 1 0 0 1 1 0ZM22 12a4 4 0 0 1-2 3.5v-7c1.2.7 2 2 2 3.5ZM10 8H4a1 1 0 0 0-1 1v6c0 .6.4 1 1 1h6V8Zm0 9H5v3c0 .6.4 1 1 1h3c.6 0 1-.4 1-1v-3Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ms-3">Channels</span>
                </a>
            </li>
            @endcan
            @can('viewAny', App\Models\User::class)
                <li>
                    <a href="{{route('users.index')}}"
                    class="flex items-center p-2 rounded-lg hover:text-gray-900 hover:bg-gray-100 {{request()->routeIs('users.index') || request()->routeIs('users.create') ? 'bg-gray-100 text-gray-900' : 'text-white'  }} group">
                        <svg class="flex-shrink-0 w-5 h-5 {{request()->routeIs('users.index') || request()->routeIs('users.create') ? 'text-gray-900' : 'text-gray-400'  }} transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Managers</span>
                    </a>
                </li>
            @endcan
            <li>
                <a href="{{route('articles.create')}}"
                    class="flex items-center p-2 hover:text-gray-900 rounded-lg hover:bg-gray-100 {{request()->routeIs('articles.create') ? 'bg-gray-100 text-gray-900' : 'text-white'  }} group">
                    <svg class="flex-shrink-0 w-5 h-5 {{request()->routeIs('articles.create') ? 'text-gray-900' : 'text-gray-400'  }} transition duration-75 group-hover:text-gray-900"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path d="M5 12H19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 19L12 5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ms-3">Créer article</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                    <span
                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                        <path
                            d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Mes groupes</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
                </a>
            </li>
            <li>
                <a href="#"
                data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 26">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a7 7 0 0 0-7 7 3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V9a5 5 0 1 1 10 0v7.083A2.919 2.919 0 0 1 14.083 19H14a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a2 2 0 0 0 1.732-1h.351a4.917 4.917 0 0 0 4.83-4H19a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3 7 7 0 0 0-7-7Zm1.45 3.275a4 4 0 0 0-4.352.976 1 1 0 0 0 1.452 1.376 2.001 2.001 0 0 1 2.836-.067 1 1 0 1 0 1.386-1.442 4 4 0 0 0-1.321-.843Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Support</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
