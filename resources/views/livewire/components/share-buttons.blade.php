<?php

use Livewire\Volt\Component;
use App\Models\Article;

new class extends Component {
    public Article $post;
    public $shareUrl;
    public $shareTitle;

    public function mount(Article $post)
    {
        $this->post = $post;
        $this->shareUrl = route('article', ['id' => $post->id, 'slug' => $post->slug]);
        $this->shareTitle = urlencode($post->title);
    }

    public function copyLink()
    {
        $this->dispatch('copyToClipboard', ['text' => $this->shareUrl]);
    }
};

?>

<div 
    class="flex items-center gap-2"
    x-data="{
        shareAvailable: typeof navigator !== 'undefined' && navigator.share,
        sharePost() {
            if (this.shareAvailable) {
                navigator.share({
                    title: '{{ $post->title }}',
                    text: 'Check out this article: {{ $post->title }}',
                    url: '{{ $shareUrl }}'
                }).catch(err => {
                    console.log('Error sharing:', err);
                });
            }
        }
    }"
>
    <span class="text-gray-700 dark:text-gray-300">Share this article:</span>
    
    <!-- Web Share API (Mobile) -->
    <button 
        x-show="shareAvailable"
        @click="sharePost"
        class="rounded-full p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
        title="Share"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
            <polyline points="16 6 12 2 8 6"/>
            <line x1="12" x2="12" y1="2" y2="15"/>
        </svg>
    </button>
    
    <!-- Twitter/X -->
    <a 
        href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" 
        target="_blank" 
        rel="noopener noreferrer"
        class="rounded-full p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
        title="Share on Twitter/X"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
        </svg>
    </a>
    
    <!-- Facebook -->
    <a 
        href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" 
        target="_blank" 
        rel="noopener noreferrer"
        class="rounded-full p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
        title="Share on Facebook"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
        </svg>
    </a>
    
    <!-- LinkedIn -->
    <a 
        href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" 
        target="_blank" 
        rel="noopener noreferrer"
        class="rounded-full p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
        title="Share on LinkedIn"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
            <rect width="4" height="12" x="2" y="9"/>
            <circle cx="4" cy="4" r="2"/>
        </svg>
    </a>
    
    <!-- Copy Link -->
    <button 
        class="rounded-full p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
        title="Copy Link"
        wire:click="copyLink"
        x-on:click="
            setTimeout(() => {
                $dispatch('notify', { type: 'success', message: 'Link copied to clipboard!' });
            }, 100);
        "
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
        </svg>
    </button>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('shareButtons', () => ({
            shareAvailable: typeof navigator !== 'undefined' && navigator.share,
            
            sharePost() {
                if (this.shareAvailable) {
                    navigator.share({
                        title: '{{ $post->title }}',
                        text: 'Check out this article: {{ $post->title }}',
                        url: '{{ $shareUrl }}'
                    }).catch(err => {
                        console.log('Error sharing:', err);
                    });
                }
            }
        }));
    });
</script>
@endpush