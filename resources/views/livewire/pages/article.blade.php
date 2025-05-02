<?php

use App\Models\Article;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;

new class extends Component
{
    public string $slug;
    public Article $article;
    public $relatedArticles;

    public function mount(string $slug)
    {
        $this->article = Article::withCount('comments')->where('slug', $slug)->firstOrFail();
        $this->relatedArticles = Article::published()->where('topic_id', $this->article->topic_id)
            ->where('id', '!=', $this->article->id)
            ->limit(3)
            ->get();

        if (!Cookie::get('article_viewed_' . $this->article->id)) {
            DB::table('articles')->where('id', $this->article->id)->increment('view_count');
            Cookie::queue('article_viewed_' . $this->article->id, true, 60 * 24);
        }
    }
}
?>
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "{{ $article->title }}",
      "datePublished": "{{ $article->published_at ?? $article->created_at }}",
      "author": {
        "@type": "Person",
        "name": "{{ $article->user->name }}",
      }
    }
    </script>
<div class="container sm:w-[70%] mx-auto">

    <article class="space-y-8">
        <div class="w-full space-y-1 py-4">

            <div class="flex flex-col md:flex-row items-start md:items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-4">
                <div>
                    @if ($article->topic_id)
                        <span
                            class="text-sm font-semibold text-gray-400 tracking-wider uppercase">{{ $article->topic->name }}
                        </span>
                        <span class="hidden md:inline">•</span>
                    @endif
                </div>
                <span>{{ carbon($article->published_at ?? $article->created_at)->format('F j, Y \a\t H:m a') }}</span>
                {{-- <span>•</span>
                    <span>{{ $article->read_time }} min read</span> --}}
            </div>
            <h1 class="text-2xl tracking-tight font-extrabold text-gray-900 dark:text-gray-50 sm:text-3xl md:text-5xl ">
                {{ $article->title }}
            </h1>
        </div>
        <div class="flex justify-between border-b border-t px-3 py-2 dark:border-gray-700">
            <div>
                <span class="text-sm font-semibold text-gray-400 tracking-wider uppercase">By
                    {{ $article->user->name }}</span>
            </div>
            <div class="flex items-center space-x-4">
                <livewire:components.post-likes :post="$article" />
                <livewire:components.post-bookmark :post="$article" />
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span>{{ $article->views ?? 1 }}</span>
                </div>
            </div>
        </div>
        <div>
            <img src="{{ url('storage/' . $article->featured_image) }}" class="rounded-lg " alt="{{ $article->title }}">
        </div>
        <div class="text-xl space-y-5 text-justify dark:text-gray-100 leading-9">
            {!! $article->content !!}
        </div>
    </article>

    <!-- Share Buttons -->
    <div class="flex items-center space-x-4 mb-12 mt-8">
        <span class="text-gray-500 dark:text-gray-400">Share this post:</span>
        <livewire:components.share-buttons :post="$article" />
    </div>

    <!-- Comments Section -->
    <section class="my-12">
        <h2 class="text-2xl font-bold mb-8 dark:text-gray-100">Comments ({{ $article->comments_count }})</h2>
        <livewire:components.comments :post="$article" />
    </section>

    <!-- Related Posts -->
    <section class="border-t border-gray-300 dark:border-gray-700 my-8 pt-8">
        <h2 class="text-2xl font-bold mb-8 dark:text-gray-100">Related Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse ($relatedArticles as $relatedArticle)
                <article class="bg-white dark:bg-gray-800 rounded-xl shadow-xs hover:shadow-md transition-shadow">
                    <img src="{{ url('storage/' . $relatedArticle->cover_photo_path) }}" alt="{{ $relatedArticle->title }}"
                        class="w-full h-48 object-cover rounded-t-xl">
                    <div class="py-3">
                        <h3 class="text-xl font-semibold mb-2">
                            <a href="" class="hover:text-blue-600 dark:hover:text-blue-400">
                                {{ $relatedArticle->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ $relatedArticle->excerpt }}
                        </p>
                    </div>
                </article>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400 col-span-full">
                    No related posts.
                </p>
            @endforelse
        </div>
</div>
