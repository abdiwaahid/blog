<?php

use Livewire\Volt\Component;
use App\Models\Article;
new class extends Component {
    public $post;
    public $isBookmarked;

    public function mount(Article $post)
    {
        $this->post = $post;
        $this->isBookmarked = $post->isBookmarkedBy(auth()->id());
    }

    public function toggleBookmark()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->isBookmarked) {
            $this->post->bookmarks()->detach(['user_id' => auth()->id()]);
        } else {
            $this->post->bookmarks()->attach(['user_id' => auth()->id()]);
        }

        $this->isBookmarked = !$this->isBookmarked;
    }
};

?>
<button wire:click="toggleBookmark"
    class="flex items-center space-x-1 text-sm {{ $isBookmarked ? 'text-yellow-500' : 'text-gray-500 dark:text-gray-400' }}">
    <svg class="w-5 h-5" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
    </svg>
    <span>{{ $isBookmarked ? 'Bookmarked' : 'Bookmark' }}</span>
</button>
