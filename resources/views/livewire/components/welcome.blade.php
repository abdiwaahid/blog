<div class="border-b text-center min-h-[30vh] content-center py-12 dark:border-gray-700">
    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-gray-100 sm:text-5xl md:text-6xl">Maaro Blog</h1>
    <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">New product
        features, the latest in technology, solutions, and updates.</p>
    {{-- <div class="mt-5  max-w-md mx-auto  md:mt-8" x-data="{
        showSearchArea: false
    }">
        <div class="mt-3 w-full relative rounded-md shadow-sm sm:mt-0 sm:ml-3">
            <input type="text" placeholder="Search..." x-on:focus="showSearchArea = true" x-on:blur="showSearchArea = false"
                class="w-full px-5 py-3  border border-gray-300 rounded-md focus:outline-hidden focus:ring-2 focus:ring-primary">
        </div>
        <div x-show="showSearchArea" class="absolute bottom-0 left-0 mt-3 w-full rounded-md shadow-sm sm:mt-0 sm:ml-3 p-6">
            This the result area
        </div>
    </div> --}}
    <livewire:blog.components.search />
</div>
