<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<header
    class="sticky top-0 z-40 w-full border-b border-gray-200 bg-white/80 backdrop-blur dark:border-gray-800 dark:bg-gray-900/80">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">
        <div class="flex items-center gap-2">
            <a href="/" class="text-xl font-bold text-gray-900 dark:text-white">
                ModernBlog
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="/"
                class="text-sm font-medium text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
                Home
            </a>
            <a href="#"
                class="text-sm font-medium text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
                Categories
            </a>
            <a href="#"
                class="text-sm font-medium text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
                About
            </a>
            <a href="#"
                class="text-sm font-medium text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
                Contact
            </a>
        </nav>

        <div class="flex items-center gap-4">
            <!-- Search Button -->
            <button class="rounded-full p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
                @click="searchOpen = !searchOpen">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-search">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </button>

            <!-- Dark Mode Toggle -->
            <button class="rounded-full p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
                @click="darkMode = !darkMode">
                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-moon">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                </svg>
                <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-sun">
                    <circle cx="12" cy="12" r="4" />
                    <path d="M12 2v2" />
                    <path d="M12 20v2" />
                    <path d="m4.93 4.93 1.41 1.41" />
                    <path d="m17.66 17.66 1.41 1.41" />
                    <path d="M2 12h2" />
                    <path d="M20 12h2" />
                    <path d="m6.34 17.66-1.41 1.41" />
                    <path d="m19.07 4.93-1.41 1.41" />
                </svg>
            </button>
            <button wire:navigate href="{{ route('auth.login') }}"
                class="rounded-full p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-log-in-icon lucide-log-in">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" data--h-bstatus="0OBSERVED" />
                    <polyline points="10 17 15 12 10 7" data--h-bstatus="0OBSERVED" />
                    <line x1="15" x2="3" y1="12" y2="12" data--h-bstatus="0OBSERVED" />
                </svg>
            </button>
            <!-- Mobile Menu Button -->
            <button
                class="rounded-full p-2 text-gray-500 hover:bg-gray-100 md:hidden dark:text-gray-400 dark:hover:bg-gray-800"
                @click="mobileMenuOpen = !mobileMenuOpen">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-menu">
                    <line x1="4" x2="20" y1="12" y2="12" />
                    <line x1="4" x2="20" y1="6" y2="6" />
                    <line x1="4" x2="20" y1="18" y2="18" />
                </svg>
                <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="md:hidden" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2">
        <div class="border-t border-gray-200 py-2 dark:border-gray-800">
            <nav class="container mx-auto flex flex-col space-y-1 px-4">
                <a href="/"
                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:text-gray-100 dark:hover:bg-gray-800">
                    Home
                </a>
                <a href="#"
                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:text-gray-100 dark:hover:bg-gray-800">
                    Categories
                </a>
                <a href="#"
                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:text-gray-100 dark:hover:bg-gray-800">
                    About
                </a>
                <a href="#"
                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:text-gray-100 dark:hover:bg-gray-800">
                    Contact
                </a>
            </nav>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="absolute inset-0 z-50 flex items-start justify-center pt-16 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm"
        x-show="searchOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click.self="searchOpen = false">
        <div class="container mx-auto px-4 pt-12">
            <div class="relative mx-auto max-w-2xl">
                <div class="flex items-center border-b-2 border-gray-300 dark:border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-search text-gray-500 dark:text-gray-400">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                    <input type="text" placeholder="Search articles..."
                        class="w-full bg-transparent py-2 pl-2 text-gray-900 placeholder-gray-500 focus:outline-none dark:text-white dark:placeholder-gray-400"
                        x-ref="searchInput" @keydown.escape="searchOpen = false" />
                    <button class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                        @click="searchOpen = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-x">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>

                </div>
            </div>
        </div>
    </div>
</header>
