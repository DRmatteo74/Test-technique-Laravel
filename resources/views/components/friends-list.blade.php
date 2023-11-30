
@if(!$usersWithPendingRequests->isEmpty())
<h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
    {{ __("Demande d'amis") }}
</h2>
<ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600 p-4">
@foreach($usersWithPendingRequests as $friend)
    <li class="flex justify-between gap-x-6 py-5">
        <div class="flex min-w-0 gap-x-4">
            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ fake()->imageUrl }}" alt="">
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100">{{ $friend->name }}</p>
                <p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400">{{ $friend->email  }}</p>
            </div>
        </div>

        <div class="shrink-0 flex sm:items-end items-center gap-2">
            <form method="POST" action="{{ route('friend.accept', $friend) }}">
                @csrf
                <button type="submit" class="space-x-2 rounded-md drop-shadow-md inline-flex items-center px-2 py-2 bg-green-600 border border-transparent font-semibold text-xs hover:bg-green-800 focus:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -960 960 960">
                        <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/>
                    </svg>
                </button>
            </form>
            <form method="POST" action="{{ route('friend.deny', $friend) }}">
                @csrf
                <button type="submit" class="space-x-2 rounded-md drop-shadow-md inline-flex items-center px-2 py-2 bg-red-600 border border-transparent font-semibold text-xs hover:bg-red-800 focus:bg-red-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -960 960 960">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                    </svg>
                </button>
            </form>
        </div>
    </li>
@endforeach
</ul>

<hr class="m-0 p-0 mx-6 mb-6">
@endif


<h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
    {{ __("Mes amis") }}
</h2>
<ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600 p-4">
    @foreach($uniqueFriendUsers as $friend)
        <li>
            <a class="flex justify-between gap-x-6 py-5 text-start hover:bg-gray-500 px-4 rounded-lg" href="{{route('users')}}">
                <div class="flex min-w-0 gap-x-4 items-center ">
                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ fake()->imageUrl }}" alt="">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100">{{ $friend->name }}</p>
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400">{{ $friend->email  }}</p>
                    </div>
                </div>
            </a>
        </li>
  @endforeach
  @if($uniqueFriendUsers->isEmpty())
     <a href="{{ route("users") }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
         {{ __("Trouver des amis") }}
     </a>
  @endif
</ul>

