<?php

namespace App\Livewire\Blog\Components;

use App\Models\Article;
use Livewire\Volt\Component;

new class extends Component {
    public Article $article;
};
?>


<article
    class="flex flex-col rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-800 dark:bg-gray-900">
    <div class="mb-2 flex items-center gap-2">
        <span
            class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-800 dark:text-gray-300">
            {{ $article->topic?->name }}
        </span>
        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $article->read_time ?? '5 minutes' }}</span>
    </div>
    <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white">
        <a href="{{ route('article', ['slug' => $article->slug]) }}"
            class="hover:text-gray-700 dark:hover:text-gray-300">{{ $article->title }}</a>
    </h3>
    <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">{{ $article->excerpt }}</p>
    <div class="mt-auto flex items-center">
        <img src="https://placehold.co/40x40" alt="Author" class="mr-3 h-6 w-6 rounded-full object-cover" />
        <div>
            <p class="text-xs font-medium text-gray-900 dark:text-white">{{ $article->user->name }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400" >{{ carbon($article->published_at ?? $article->created_at)->format('F j, Y ') }}</p>
        </div>
    </div>
</article>
