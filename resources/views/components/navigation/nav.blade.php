<div class="md:flex md:items-center md:gap-12">
    <nav aria-label="Global" class="hidden md:block">
        <ul class="flex items-center gap-6 text-sm">
            {{ $items }}
        </ul>
    </nav>

    <div class="flex items-center gap-4">
        <div class="sm:flex sm:gap-4">
            <x-button.primary :isLink="true" href="{{ route('auth.login') }}">
                Login
            </x-button.primary>
        </div>

        <div class="block md:hidden">
            <button class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</div>
