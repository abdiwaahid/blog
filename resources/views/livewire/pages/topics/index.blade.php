<?php
use Livewire\Volt\Component;
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
            'topics' => Topic::withCount('articles')->latest()->paginate($this->perPage),
        ];
    }
};

?>
<div class=" ">

    <!-- Categories Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Topics</h2>
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                <!-- Categories (Generated with Alpine.js) -->
                @foreach ($topics as $topic)
                    <a href="{{ route('topic', ['slug' => $topic->slug]) }}"
                        class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-white p-6 text-center shadow-sm transition-all hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                        <div class="mb-3 rounded-full bg-gray-100 p-3 dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-hash text-gray-700 dark:text-gray-300">
                                <line x1="4" x2="20" y1="9" y2="9" />
                                <line x1="4" x2="20" y1="15" y2="15" />
                                <line x1="10" x2="8" y1="3" y2="21" />
                                <line x1="16" x2="14" y1="3" y2="21" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white" >{{ $topic->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400" >
                            {{ $topic->articles_count }} articles
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

</div>
