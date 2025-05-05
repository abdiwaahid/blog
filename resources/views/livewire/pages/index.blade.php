<?php
use Livewire\Volt\Component;
use App\Models\Article;
use App\Models\Topic;
new class extends Component {
    public $perPage = 9;

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function with()
    {
        return [
            'posts' => Article::latest()->paginate($this->perPage),
            'topics' => Topic::withCount('articles')->latest()->take(6)->get(),
        ];
    }
};

?>
<div class=" ">
    <!-- Hero Section -->
    <section class="relative bg-gray-50 py-16 dark:bg-gray-800/50">
        <div class="container mx-auto px-4">
            <div class="mx-auto max-w-3xl text-center">
                <h1 class="mb-4 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl dark:text-white">
                    Insights for the modern world
                </h1>
                <p class="mb-8 text-lg text-gray-600 dark:text-gray-300">
                    Discover stories, thinking, and expertise from writers on any topic.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#featured"
                        class="rounded-md bg-gray-900 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 dark:bg-gray-700 dark:hover:bg-gray-600">
                        Start Reading
                    </a>
                    <a href="#newsletter"
                        class="rounded-md border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                        Subscribe
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Posts -->
    <section id="featured" class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Featured Posts</h2>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Featured Post 1 -->
                <article
                    class="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                    <a href="#" class="block overflow-hidden">
                        <img src="https://placehold.co/600x400" alt="Featured post"
                            class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                    </a>
                    <div class="p-6">
                        <div class="mb-2 flex items-center gap-2">
                            <span
                                class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-800 dark:text-gray-300">
                                Technology
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">5 min read</span>
                        </div>
                        <h3 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="#" class="hover:text-gray-700 dark:hover:text-gray-300">
                                The Future of Web Development in 2025
                            </a>
                        </h3>
                        <p class="mb-4 text-gray-600 dark:text-gray-300">
                            Explore the emerging trends and technologies that will shape the future of web development
                            in the coming years.
                        </p>
                        <div class="flex items-center">
                            <img src="https://placehold.co/40x40" alt="Author"
                                class="mr-3 h-8 w-8 rounded-full object-cover" />
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Alex Johnson</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">May 1, 2025</p>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Featured Post 2 -->
                <article
                    class="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                    <a href="#" class="block overflow-hidden">
                        <img src="https://placehold.co/600x400" alt="Featured post"
                            class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                    </a>
                    <div class="p-6">
                        <div class="mb-2 flex items-center gap-2">
                            <span
                                class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-800 dark:text-gray-300">
                                Design
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">8 min read</span>
                        </div>
                        <h3 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="#" class="hover:text-gray-700 dark:hover:text-gray-300">
                                Minimalist Design Principles for Modern Websites
                            </a>
                        </h3>
                        <p class="mb-4 text-gray-600 dark:text-gray-300">
                            Learn how to apply minimalist design principles to create clean, effective, and
                            user-friendly websites.
                        </p>
                        <div class="flex items-center">
                            <img src="https://placehold.co/40x40" alt="Author"
                                class="mr-3 h-8 w-8 rounded-full object-cover" />
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Sarah Miller</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">April 28, 2025</p>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Featured Post 3 -->
                <article
                    class="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                    <a href="#" class="block overflow-hidden">
                        <img src="https://placehold.co/600x400" alt="Featured post"
                            class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                    </a>
                    <div class="p-6">
                        <div class="mb-2 flex items-center gap-2">
                            <span
                                class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-800 dark:text-gray-300">
                                Productivity
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">6 min read</span>
                        </div>
                        <h3 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="#" class="hover:text-gray-700 dark:hover:text-gray-300">
                                10 Productivity Hacks for Remote Workers
                            </a>
                        </h3>
                        <p class="mb-4 text-gray-600 dark:text-gray-300">
                            Discover practical tips and strategies to boost your productivity while working remotely.
                        </p>
                        <div class="flex items-center">
                            <img src="https://placehold.co/40x40" alt="Author"
                                class="mr-3 h-8 w-8 rounded-full object-cover" />
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Michael Chen</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">April 25, 2025</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Recent Posts -->
    <section class="py-12 bg-gray-50 dark:bg-gray-800/50">
        <div class="container mx-auto px-4">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Recent Posts</h2>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Recent Posts (Generated with Alpine.js) -->
                @forelse ($posts as $post)
                    <livewire:components.article :article="$post" />
                @empty
                    <div class="lg:col-span-3 flex items-center justify-center h-full">
                        <div class="text-center">
                            <p class="text-gray-500 text-xl font-semibold">No posts found.</p>
                            <p class="text-gray-400">Check back later.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-8 text-center">
                <a href="#"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    View All 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right ml-2">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Browse by Topic</h2>
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                <!-- Categories (Generated with Alpine.js) -->
                @foreach ($topics as $topic)
                    <a href="{{ route('topic', $topic->slug) }}" wire:navigate
                        class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-white p-6 text-center shadow-sm transition-all hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                        <div class="mb-3 rounded-full bg-gray-100 p-3 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-hash text-gray-700 dark:text-gray-300">
                                <line x1="4" x2="20" y1="9" y2="9" />
                                <line x1="4" x2="20" y1="15" y2="15" />
                                <line x1="10" x2="8" y1="3" y2="21" />
                                <line x1="16" x2="14" y1="3" y2="21" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $topic->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $topic->articles_count }} articles</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section id="newsletter" class="bg-gray-900 py-16 text-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="mb-4 text-3xl font-bold">Subscribe to our newsletter</h2>
                <p class="mb-8 text-gray-300">
                    Get the latest articles, resources, and insights delivered straight to your inbox.
                </p>
                <form class="mx-auto flex max-w-md flex-col gap-2 sm:flex-row" x-data="{ email: '', submitted: false, error: '' }"
                    @submit.prevent="
                if (!email) {
                  error = 'Please enter your email';
                  return;
                }
                if (!email.includes('@')) {
                  error = 'Please enter a valid email';
                  return;
                }
                submitted = true;
                error = '';
              ">
                    <div class="relative flex-1">
                        <input type="email" placeholder="Enter your email"
                            class="w-full rounded-md border-gray-700 bg-gray-800 px-4 py-2.5 text-white placeholder-gray-400 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500"
                            x-model="email" :disabled="submitted" />
                        <p class="absolute -bottom-6 left-0 text-xs text-red-400" x-show="error" x-text="error"></p>
                    </div>
                    <button type="submit"
                        class="rounded-md bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900"
                        :disabled="submitted">
                        <span x-show="!submitted">Subscribe</span>
                        <span x-show="submitted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check inline">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                            Subscribed
                        </span>
                    </button>
                </form>
                <p class="mt-4 text-xs text-gray-400" x-show="submitted">
                    Thank you for subscribing! Check your email to confirm your subscription.
                </p>
            </div>
        </div>
    </section>


    <div class="mt-12 text-center">
        @if (count($posts) > $perPage)
            <button
                class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-primary bg-blue-100 hover:bg-blue-200">
                Load more
                <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        @endif

    </div>
</div>
