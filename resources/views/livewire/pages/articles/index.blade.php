<?php
use Livewire\Volt\Component;
use App\Models\Article;
new class extends Component {
    public $perPage = 9;

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function with()
    {
        return [
            'articles' => Article::latest()->paginate($this->perPage),
        ];
    }
};

?>
<div class=" ">

    <!-- Categories Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Articles</h2>
            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <!-- Categories (Generated with Alpine.js) -->
                @foreach ($articles as $article)
                    <livewire:components.article :article="$article" />
                @endforeach
            </div>
        </div>
    </section>

</div>
