<?php

use Livewire\Volt\Component;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Validation\Rule;

new class extends Component {
    public $post;
    public $content = '';
    public $reply = '';
    public $replyTo = null;
    public $editingComment = null;

    protected function rules(): array
    {
        return [
            'content' => ['min:3', Rule::requiredIf(fn() => !$this->replyTo)],
            'reply' => ['min:3', Rule::requiredIf(fn() => $this->replyTo)],
        ];
    }

    public function mount(Article $post)
    {
        $this->post = $post;
    }

    public function submitComment()
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }

        $this->validate();

        $comment = $this->post->comments()->create([
            'user_id' => auth()->id(),
            'content' => !$this->replyTo ? $this->content : $this->reply,
            'parent_id' => $this->replyTo,
        ]);

        $this->content = '';
        $this->replyTo = null;

        $this->dispatch('commentAdded');
    }

    public function startEdit(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return;
        }

        $this->editingComment = $comment;
        $this->content = $comment->content;
    }

    public function cancel()
    {
        $this->editingComment = null;
        $this->content = '';
    }

    public function updateComment()
    {
        if (!$this->editingComment || $this->editingComment->user_id !== auth()->id()) {
            return;
        }

        $this->validate();

        $this->editingComment->update([
            'content' => $this->content,
        ]);

        $this->editingComment = null;
        $this->content = '';
    }

    public function deleteComment(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return;
        }

        $comment->delete();
    }

    public function with(): array
    {
        return [
            'comments' => $this->post
                ->comments()
                ->with(['user', 'replies.user'])
                ->whereNull('parent_id')
                ->latest()
                ->get(),
            'authUser' => auth()->user(),
        ];
    }
};

?>

<section class="my-12">
    <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Comments ({{ $comments->count() }})</h2>

    <!-- Comment Form -->
    <div class="mb-8">
        @auth
            <form wire:submit.prevent="submitComment">
                <div class="mb-4">
                    <label for="comment" class="sr-only">Add a comment</label>
                    <textarea id="comment" rows="4" wire:model="content"
                        class="w-full rounded-lg border border-gray-300 p-3 text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                        placeholder="Add your thoughts..."></textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 dark:bg-gray-700 dark:hover:bg-gray-600"
                    :disabled="!content.trim()" :class="{ 'opacity-50 cursor-not-allowed': !content.trim() }">
                    Post Comment
                </button>
            </form>
        @else
            <p class="text-center text-gray-500 dark:text-gray-400">
                Please <a href="{{ route('auth.login') }}" class="text-blue-600 hover:underline">login</a>
                to leave a comment.
            </p>
        @endauth
    </div>

    <!-- Comments List -->
    <div class="space-y-6">
        @foreach ($comments as $comment)
            <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900"
                id="comment-{{ $comment->id }}">
                <div class="mb-4 flex items-start justify-between">
                    <div class="flex items-center">
                        <img src="{{ avatar_path($comment->user) }}" alt="{{ $comment->user->name }}"
                            class="mr-3 h-10 w-10 rounded-full object-cover" />
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @if ($comment->user_id === auth()->id())
                        <div class="flex items-center gap-2">
                            <button wire:click="startEdit({{ $comment->id }})"
                                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                            <button wire:click="deleteComment({{ $comment->id }})"
                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>

                @if ($editingComment && $editingComment->id === $comment->id)
                    <form wire:submit.prevent="updateComment" class="mb-4">
                        <textarea rows="3" wire:model="content"
                            class="w-full rounded-lg border border-gray-300 p-3 text-sm text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                        <div class="mt-2">
                            <button type="submit"
                                class="rounded-md bg-gray-900 px-3 py-1.5 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 dark:bg-gray-700 dark:hover:bg-gray-600">
                                Update
                            </button>
                            <button type="button" wire:click="cancel"
                                class="ml-2 rounded-md bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                                Cancel
                            </button>
                        </div>
                    </form>
                @else
                    <div class="mb-4 text-gray-700 dark:text-gray-300">{{ $comment->content }}</div>
                @endif

                <div class="flex items-center gap-4">
                    <button
                        class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                        wire:click="$set('replyTo', {{ $replyTo === $comment->id ? 'null' : $comment->id }})">
                        {{ $replyTo === $comment->id ? 'Cancel' : 'Reply' }}
                    </button>
                </div>

                <!-- Reply Form -->
                @if ($replyTo === $comment->id)
                    <div class="mt-4">
                        <form wire:submit.prevent="submitComment">
                            <div class="mb-3">
                                <textarea rows="3" wire:model="reply"
                                    class="w-full rounded-lg border border-gray-300 p-3 text-sm text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                    placeholder="Write your reply..."></textarea>
                                @error('reply')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="rounded-md bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600"
                                :class="{ 'opacity-50 cursor-not-allowed': !content.trim() }">
                                Post Reply
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Replies -->
                @if ($comment->replies->count() > 0)
                    <div class="mt-4 space-y-4 border-l-2 border-gray-100 pl-4 dark:border-gray-800">
                        @foreach ($comment->replies as $reply)
                            <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800/50">
                                <div class="mb-2 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="{{ avatar_path($reply->user) }}" alt="{{ $reply->user->name }}"
                                            class="mr-2 h-8 w-8 rounded-full object-cover" />
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                {{ $reply->user->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $reply->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @if ($reply->user_id === auth()->id())
                                        <div class="flex items-center gap-2">
                                            <button wire:click="deleteComment({{ $reply->id }})"
                                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18"></path>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-700 dark:text-gray-300">{{ $reply->content }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>
