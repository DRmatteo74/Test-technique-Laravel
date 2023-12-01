<x-app-layout>
    <x-slot name="header">
        @if(isset($friend))
            <div class="flex min-w-0 gap-x-4 items-center ">
                <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ fake()->imageUrl }}" alt="">
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100">{{ $friend->name }}</p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400">{{ $friend->email  }}</p>
                </div>
            </div>
        @else
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Sélectionnez un ami') }}
            </h2>
        @endif
    </x-slot>

    <div class="sm:py-12 py-6">
        <div class="flex w-full flex-row flex-wrap flex-1 content-start gap-6">
            <div class="pt-4 px-2 sm:ms-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg h-fit sm:py-6 sm:px-5 w-full sm:w-auto">
                @if(isset($friend))
                    <x-friends-list :friends="$friends" :askFriends="$askFriends" :currentFriend="$friend" :route="'private.message.friend'"/>
                @else
                    <x-friends-list :friends="$friends" :askFriends="$askFriends" :route="'private.message.friend'"/>
                @endif
            </div>
            <div class="flex-grow max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full py-6 px-5 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mb-6">
                        {{ __("Messages") }}
                    </h2>

                    @if(isset($friend))
                        <form class="mb-4" method="POST" action="{{ route('private.message.send', isset($friend) ? $friend : \Illuminate\Support\Facades\Auth::user())}}">
                            @csrf
                            <x-text-area class="w-full mb-2" placeholder="{{ __('Nouveau message') }}" name="message"></x-text-area>
                            <div class="flex w-full justify-end">
                                <x-primary-button class="flex space-x-2 items-center px-3 py-2 rounded-md drop-shadow-md" >
                                    <svg class="dark:fill-black fill-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -960 960 960">
                                        <path d="M120-160v-240l320-80-320-80v-240l760 320-760 320Z"/>
                                    </svg>
                                    <span class="hidden sm:block">{{ __('Envoyer') }}</span>
                                </x-primary-button>
                            </div>
                        </form>

                        @if(isset($messages) and !$messages->isEmpty())
                            @foreach($messages as $message)
                                <x-message-template :user="$message->sender()->first()" :message="$message"></x-message-template>
                          @endforeach
                        @else
                            <p class="text-black dark:text-white">Aucun message</p>
                       @endif
                    @else
                        <p class="text-black dark:text-white">Sélectionnez un ami</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
