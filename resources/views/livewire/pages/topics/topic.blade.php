<?php
use Livewire\Volt\Component;
use App\Models\Topic;
use App\Models\Article;
new class extends Component {
    public $perPage = 9;
    public $topic;
    public function mount(string $slug)
    {
        $this->topic = Topic::where('slug', $slug)->firstOrFail();
    }

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function with()
    {
        return [
            'posts' => Article::where('topic_id', $this->topic->id)->latest()->paginate($this->perPage),
        ];
    }
};

?>
<div class=" ">

    <!-- Categories Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Articles in {{ $this->topic->name }}</h2>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Recent Posts (Generated with Alpine.js) -->
                @forelse ($posts as $post)
                    <livewire:components.article :article="$post" />
                @empty
                    <div class="lg:col-span-3 flex items-center justify-center h-full">
                        <div class="text-center">
                            <p class="text-gray-500 text-xl font-semibold">No articles.</p>
                            <p class="text-gray-400">Check back later.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</div>
