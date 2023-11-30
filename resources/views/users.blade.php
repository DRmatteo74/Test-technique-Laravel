<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form class="sm:px-16 px-3 flex w-full mt-5 items-center" method="POST" action="{{ route('users.search') }}">
                    @csrf
                    <div class="flex-grow w-full">
                        <x-text-input id="search" class="block w-full"
                                      type="search"
                                      name="search"
                                      value="{{isset($search) ? $search : '' }}"
                                      placeholder="{{ __('Rechercher...') }}"
                        />
                    </div>
                    <div>
                        <x-primary-button class="ms-4">
                            <svg class="fill-white dark:fill-black block sm:hidden" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                                 viewBox="0 0 30 30">
                                <path
                                    d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
                                </path>
                            </svg>
                            <p class="hidden sm:block">{{ __('Recherche') }}</p>
                        </x-primary-button>
                    </div>
                </form>

                <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600 sm:p-10 p-3">
                    @foreach($users as $user)
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ fake()->imageUrl }}" alt="">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                                    <p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400">leslie.alexander@example.com</p>
                                </div>
                            </div>
                            @if(!in_array($user->id, $usersWithPendingRequests))
                                <form class="shrink-0 flex sm:items-end items-center" method="POST" action="{{ route('users.create.friend', $user) }}">
                                    @csrf
                                    <x-primary-button class="flex space-x-2 items-center px-3 py-2 rounded-md drop-shadow-md" >
                                        <svg class="dark:fill-black fill-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -960 960 960">
                                            <path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Z"/>
                                        </svg>
                                        <span class="hidden sm:block">Ajouter</span>
                                    </x-primary-button>
                                </form>
                            @else
                                <div class="shrink-0 flex sm:items-end items-center">
                                    <x-primary-button class="flex space-x-2 items-center px-3 py-2 rounded-md drop-shadow-md" disabled>
                                        <svg class="dark:fill-black fill-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -960 960 960">
                                            <path d="M702-480 560-622l57-56 85 85 170-170 56 57-226 226Zm-342 0q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Z"/>
                                        </svg>
                                        <span class="hidden sm:block">Envoyé</span>
                                    </x-primary-button>
                                </div>
                            @endif
                        </li>
                    @endforeach
                    @if($users->isEmpty())
                        <x-input-label class="text-lg">{{ __('Aucun résultat')}}</x-input-label>
                    @endif
                </ul>

            </div>
        </div>
    </div>
</x-app-layout>
