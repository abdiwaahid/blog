<?php

use Livewire\Volt\Component;
use App\Models\Article;
use App\Models\Comment;
new class extends Component {
    public $post;
    public $content = '';
    public $replyTo = null;
    public $editingComment = null;

    protected $rules = [
        'content' => 'required|min:3',
    ];

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
            'comment' => $this->content,
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
        $this->content = $comment->comment;
    }

    public function cancel()
    {
        $this->editingComment = null;
    }

    public function updateComment()
    {
        if (!$this->editingComment || $this->editingComment->user_id !== auth()->id()) {
            return;
        }

        $this->validate();

        $this->editingComment->update([
            'comment' => $this->content,
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
            'comments' => $this->post->comments()->with('user')->whereNull('parent_id')->latest()->get(),
        ];
    }
};

?>
<div>
    <!-- Comment Form -->
    <div class="mb-8">
        @auth
            <form wire:submit.prevent="submitComment" class="space-y-4">
                <textarea wire:model="content"
                    class="w-full px-4 py-2 rounded-lg border dark:border-gray-700 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500"
                    rows="3" placeholder="Write a comment..."></textarea>
                @error('content')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    {{ $replyTo ? 'Reply' : 'Comment' }}
                </button>
                @if ($replyTo)
                    <button type="button" wire:click="$set('replyTo', null)"
                        class="ml-2 text-gray-500 hover:text-gray-700">
                        Cancel
                    </button>
                @endif
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
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-xs" id="comment-{{ $comment->id }}">
                <div class="flex items-start space-x-4">
                    <img src="{{ avatar_path($post->author) }}" alt="{{ $comment->user->name }}"
                        class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <h4 class="font-semibold">{{ $comment->user->name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @if ($comment->user_id === auth()->id())
                                <div class="flex items-center space-x-2">
                                    <button wire:click="startEdit({{ $comment->id }})"
                                        class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button wire:click="deleteComment({{ $comment->id }})"
                                        class="text-red-500 hover:text-red-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                        @if (filled($editingComment) && $editingComment->id === $comment->id)
                            <form wire:submit.prevent="updateComment" class="space-y-4">
                                <flux:textarea  wire:model="content" rows="3"></flux:textarea>
                                <div>
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Update
                                    </button>
                                    <button type="button" wire:click="cancel()"
                                        class="ml-2 text-gray-500 hover:text-gray-700">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        @else
                            <p class="text-gray-600 dark:text-gray-300">{{ $comment->comment }}</p>
                        @endif

                        <!-- Reply Button -->
                        {{-- <button wire:click="$set('replyTo', {{ $comment->id }})"
                            class="text-sm text-gray-500 hover:text-gray-700 mt-2">
                            Reply
                        </button>

                        <!-- Nested Replies -->
                        @if (count($comment->replies ?? []) > 0)
                            <div class="mt-4 space-y-4 pl-8 border-l-2 border-gray-200 dark:border-gray-700">
                                @foreach ($comment->replies as $reply)
                                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                        <!-- Similar structure as parent comment -->
                                    </div>
                                @endforeach
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
