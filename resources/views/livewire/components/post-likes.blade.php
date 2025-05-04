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
    class="flex items-center space-x-1 text-sm {{ $isLiked ? 'text-red-500' : 'text-gray-500 dark:text-gray-400' }}">
    <svg class="w-5 h-5" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
        </path>
    </svg>
    <span>{{ $likesCount ?? 0 }}</span>
</button>
