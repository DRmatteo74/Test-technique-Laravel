<div class="mb-4 rounded-lg bg-gray-200 dark:bg-gray-900 text-black dark:text-white p-6">
    <div class="flex">
        <img class="mr-4 h-12 w-12 rounded-full object-cover" src="{{ fake()->imageUrl }}" alt="profile" />
        <div class="w-full">
            <div class="flex flex-wrap gap-x-3 items-center">
                <h3 class="text-base font-semibold">{{ $user->name }}</h3>
                <span class="block text-xs font-normal text-gray-500 sm:block hidden">{{ $user->email }}</span>
                <span class="block text-xs font-normal text-gray-500 flex-grow text-end">{{ $message->created_at->format("d/m/Y H:i") }}</span>
            </div>
            <p class="text-sm font-normal mt-1">{{ $message->message }}</p>
        </div>
    </div>
</div>
