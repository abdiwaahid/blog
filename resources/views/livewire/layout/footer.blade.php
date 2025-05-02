<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{

}; ?>

<footer class="border-t border-gray-200 bg-white py-12 dark:border-gray-800 dark:bg-gray-900">
  <div class="container mx-auto px-4">
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
      <!-- About -->
      <div>
        <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">About</h3>
        <p class="mb-4 text-gray-600 dark:text-gray-300">
          ModernBlog is a platform for writers and readers to connect, discover, and engage with high-quality content across various topics.
        </p>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <span class="sr-only">Twitter</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter">
              <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
            </svg>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <span class="sr-only">Facebook</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
            </svg>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <span class="sr-only">Instagram</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram">
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
              <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
            </svg>
          </a>
          <a href="#" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <span class="sr-only">LinkedIn</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
              <rect width="4" height="12" x="2" y="9"/>
              <circle cx="4" cy="4" r="2"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Quick Links</h3>
        <ul class="space-y-2 text-gray-600 dark:text-gray-300">
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Home</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">About Us</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Contact</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Privacy Policy</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Terms of Service</a></li>
        </ul>
      </div>

      <!-- Categories -->
      <div>
        <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Categories</h3>
        <ul class="space-y-2 text-gray-600 dark:text-gray-300">
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Technology</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Design</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Business</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Lifestyle</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Health</a></li>
          <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Travel</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Contact</h3>
        <ul class="space-y-2 text-gray-600 dark:text-gray-300">
          <li class="flex items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin mr-2 mt-1 h-4 w-4">
              <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <span>123 Blog Street, San Francisco, CA 94103</span>
          </li>
          <li class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail mr-2 h-4 w-4">
              <rect width="20" height="16" x="2" y="4" rx="2"/>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
            </svg>
            <span>contact@modernblog.com</span>
          </li>
          <li class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone mr-2 h-4 w-4">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
            <span>(123) 456-7890</span>
          </li>
        </ul>
      </div>
    </div>

    <div class="mt-8 border-t border-gray-200 pt-8 text-center dark:border-gray-800">
      <p class="text-sm text-gray-600 dark:text-gray-400">
        © <span x-text="new Date().getFullYear()"></span> ModernBlog. All rights reserved.
      </p>
    </div>
  </div>
</footer>
