@props(['type' => 'submit', 'isLink' => false, 'href' => '#'])

@if ($isLink)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white shadow']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white shadow']) }}>
        {{ $slot }}
    </button>
@endif
