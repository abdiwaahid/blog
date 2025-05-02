<div class="mt-4 ">
    <a href="{{ route('article', ['slug' => $post->slug]) }}" wire:navigate>
        <div class="aspect-2/1 w-full rounded-lg bg-gray-100 shadow-card transition group-hover:opacity-80">
            <img class="h-full w-full object-cover rounded-lg" src="{{ url('storage/' . $post->cover_photo_path) }}"
                alt="{{ $post->title }}">
        </div>
        <div class="mt-4">
            <flux:tooltip>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 line-clamp-2">{{ $post->title }}</h2>
                <flux:tooltip.content class="max-w-[20rem] space-y-2">
                    {{ $post->title }}
                </flux:tooltip.content>
            </flux:tooltip>
            <p class="mt-2 text-base text-gray-500 dark:text-gray-200 line-clamp-2">{{ $post->sub_title }}</p>
        </div>
    </a>
</div>
