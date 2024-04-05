@props(['name' => '', 'type' => 'text', 'label' => ''])
<div class="my-3 w-full">
    <label for="{{ $name }}" class="sr-only">{{ $label }}</label>
    <div class="relative">
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            {{ $attributes->merge(['class' => 'w-full border border-gray-200 rounded-lg  p-4 pe-12 text-sm shadow-sm']) }} />

        <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
            @isset($icon)
                {{ $icon }}
            @endisset
        </span>
    </div>
</div>
