<?php

use App\Models\Article;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;

new class extends Component {
    public string $slug;
    public Article $article;
    public $relatedArticles;

    public function mount(string $slug)
    {
        $this->article = Article::withCount('comments')->withCount('likes')->where('slug', $slug)->firstOrFail();
        $this->relatedArticles = Article::published()->where('topic_id', $this->article->topic_id)->where('id', '!=', $this->article->id)->limit(3)->get();

        if (!Cookie::get('article_viewed_' . $this->article->id)) {
            DB::table('articles')->where('id', $this->article->id)->increment('view_count');
            Cookie::queue('article_viewed_' . $this->article->id, true, 60 * 24);
        }
    }
};
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

    <article class="space-y-8 py-8">
        <header class="mb-8">
            <div class="mb-4 flex items-center gap-2">
                <span
                    class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-800 dark:text-gray-300">
                    {{ $article->topic?->name }}
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400">5 min read</span>
                <span
                    class="text-xs text-gray-500 dark:text-gray-400">{{ carbon($article->published_at ?? $article->created_at)->format('F j, Y ') }}</span>
            </div>
            <h1 class="mb-4 text-3xl font-bold leading-tight text-gray-900 sm:text-4xl md:text-5xl dark:text-white">
                {{ $article->title }}
            </h1>
            <p class="mb-6 text-xl text-gray-600 dark:text-gray-300">
                {{ $article->excerpt }}
            </p>

            <!-- Author Info -->
            <div class="flex items-center">
              <img 
                src="{{ avatar_path($article->user->avatar) }}" 
                alt="Alex Johnson" 
                class="mr-4 h-12 w-12 rounded-full object-cover"
              />
              <div>
                <p class="font-medium text-gray-900 dark:text-white capitalize">{{ $article->user->name }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $article->user->bio ?? 'N/A' }}</p>
              </div>
            </div>
        </header>

        
        <div>
            @if ($article->featured_image)
                <img src="{{ url('storage/' . $article->featured_image) }}" class="rounded-lg "
                    alt="{{ $article->title }}">
            @endif
        </div>
        <div class="content text-xl space-y-5 text-justify dark:text-gray-100 leading-9">
            {!! $article->content !!}
        </div>
    </article>

    <div
        class="my-8 flex flex-wrap items-center justify-between gap-4 border-t border-b border-gray-200 py-6 dark:border-gray-800">
        <!-- View Count -->
        <div class="flex items-center text-gray-500 dark:text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
            <span>{{ $article->view_count }} </span>
        </div>

        <!-- Like Button -->
        <div class="flex items-center space-x-4">
            <livewire:components.post-likes :post="$article" />
            <livewire:components.post-bookmark :post="$article" />
        </div>


        <livewire:components.share-buttons :post="$article" />
    </div>


    <livewire:components.comments :post="$article" />


    <!-- Related Posts -->
    <section class="border-t border-gray-300 dark:border-gray-700 my-8 pt-8">
        <h2 class="text-2xl font-bold mb-8 dark:text-gray-100">Related Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse ($relatedArticles as $relatedArticle)
                <article class="bg-white dark:bg-gray-800 rounded-xl shadow-xs hover:shadow-md transition-shadow">
                    <img src="{{ url('storage/' . $relatedArticle->cover_photo_path) }}"
                        alt="{{ $relatedArticle->title }}" class="w-full h-48 object-cover rounded-t-xl">
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
