@props(['name' => '', 'label' => ''])
<div>
<label for="{{ $name }}" class="block text-sm font-medium text-gray-700"> {{ $label }} </label>
<textarea id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'w-full rounded-lg border border-gray-300 p-3 text-sm text-gray-900 focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white']) }}
    rows="4"></textarea>
</div>
