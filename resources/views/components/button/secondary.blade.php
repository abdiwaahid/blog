@props(['type' => 'button', 'isLink' => false, 'href' => '#'])

@if ($isLink)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'rounded-md border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700']) }}>
        {{ $slot }}
    </a>
@else
    <button type="submit"
        {{ $attributes->merge(['class' => 'rounded-md border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700']) }}>
        {{ $slot }}
    </button>
@endif
