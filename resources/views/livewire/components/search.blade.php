<div class="relative mt-5  max-w-md mx-auto  md:mt-8">

    <div class="mt-3 w-full relative rounded-md shadow-sm sm:mt-0 sm:ml-3">
        <input type="text" placeholder="Search..." wire:model.live="query" x-on:blur="$wire.resetAll()" x-on:keyup="$wire.search()"
            class="w-full px-5 py-3  border border-gray-300 rounded-md focus:outline-hidden focus:ring-2 focus:ring-primary">
    </div>
    @if (strlen($query)>3)
        <div class="bg-gray-50  absolute z-10  mt-3 w-full rounded-b-md shadow-sm sm:mt-0 sm:ml-3 p-6">
            @forelse ($searchPosts as $post)
                <x-searched-post :post="$post" />
            @empty
                <div class="lg:col-span-3 flex items-center justify-center h-full">
                    <div class="text-center">
                        <p class="text-gray-500 text-lg ">No posts found.</p>
                        <p class="text-gray-400">Try different keywords.</p>
                    </div>
                </div>
            @endforelse
        </div>
    @endif

</div>
