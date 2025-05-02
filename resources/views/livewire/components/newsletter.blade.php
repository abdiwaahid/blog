<div class="mt-8 xl:mt-0">
    <h3 class="text-sm font-semibold  tracking-wider uppercase">Subscribe to our newsletter
    </h3>
    <p class="mt-4 text-base ">The latest news, articles, and resources, sent to your inbox
        weekly.</p>

    <form class="mt-4 sm:flex sm:max-w-md items-center content-center" wire:submit="subscribe()">
        <flux:input type="email" wire:model="email" id="email" autocomplete="email" required
            class=" text-base text-gray-900 placeholder-gray-500 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white focus:border-white focus:placeholder-gray-400"
            placeholder="Enter your email" />
        <div class=" rounded-md sm:mt-0 sm:ml-3 sm:shrink-0">
            <flux:button type="submit" varient="primary"
                class="w-full bg-indigo-500 border border-transparent rounded-md py-2 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-600 focus:outline-hidden focus:ring-1 focus:ring-offset-2 focus:ring-offset-indigo-800 focus:ring-primary">
                Subscribe</flux:button>
        </div>
    </form>
</div>
