<?php

use Livewire\Volt\Component;
use App\Models\Article;
new class extends Component {
    public Article $post;
    public $likesCount;
    public $isLiked = false;

    public function mount(Article $post)
    {
        $this->post = $post;
        $this->likesCount = $post->likes_count;
        $this->isLiked = $post->isLikedBy(auth()->id());
    }

    public function toggleLike()
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }

        if ($this->isLiked) {
            $this->post->likes()->detach(['user_id' => auth()->id()]);
            $this->likesCount--;
        } else {
            $this->post->likes()->attach(['user_id' => auth()->id()]);
            $this->likesCount++;
        }

        $this->isLiked = !$this->isLiked;
    }
};

?>
<button wire:click="toggleLike"
    class="flex items-center gap-2 rounded-full  px-4 py-2 text-gray-700 transition-colors hover:bg-gray-100 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800"
    :class="{ ' text-red-600   dark:text-red-400 ': {{ $isLiked }} }"
    @click="toggleLike">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        :class="{ 'text-red-500 fill-red-500': {{ $isLiked }} }" stroke-linejoin="round">
        <path
            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
    </svg>
    <span>{{ $likesCount ?? 0 }}</span>
</button>
{{-- <button wire:click="toggleLike"
    class="flex items-center space-x-1 text-sm {{ $isLiked ? 'text-red-500' : 'text-gray-500 dark:text-gray-400' }}">
    <svg class="w-5 h-5" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
        </path>
    </svg>
    <span>{{ $likesCount ?? 0 }}</span>
</button> --}}
