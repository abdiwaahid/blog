@props(['name' => '', 'label' => ''])
<div>
<label for="{{ $name }}" class="block text-sm font-medium text-gray-700"> {{ $label }} </label>
<textarea id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'p-2 mt-2 w-full rounded-lg border-gray-200 align-top shadow-sm sm:text-sm']) }}
    rows="4"></textarea>
</div>
