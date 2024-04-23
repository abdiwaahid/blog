<?php

use App\Models\Post;
use Illuminate\Auth\Events\Login;
use function Laravel\Folio\{middleware, name};
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use function Livewire\Volt\state;

state(search: '', posts: Post::all());

$searchItem = function () {
    dd($this->search);
};

// new class extends Component {
//     public $search = '';

//     protected $rules = [
//         'search' => 'required|min:3',
//     ];

//     public function search()
//     {
//         dd('ok');
//         $this->validate();
//     }
// };

?>
<x-layout>
    <x-slot name='header'>
        <h4 class="text-lg font-bold text-start py-3">Posts</h4>
    </x-slot>

    <x-card class="mt-4 flex content-center justify-between">
        @volt
            <form wire:submit='searchItem' class="w-full flex gap-4">
                <x-form.input placeholder="Search something " wire:model='search'>
                    <x-slot name='icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </x-slot>
                </x-form.input>
                @error('search')
                    <span class="error">{{ $message }}</span>
                @enderror
                {{-- <button type="submit">search</button> --}}
                <x-button.primary type='submit' class="my-3" wire:click='search'> Search</x-button.primary>
            </form>
        @endvolt
    </x-card>

    @volt
        <div>
            @forelse ($posts as $post)
                <x-post :post="$post"></x-post>
            @empty
                <x-card class="mt-10 ring-transparent ">
                    No Posts Yet!!
                </x-card>
            @endforelse
        </div>
    @endvolt
</x-layout>
