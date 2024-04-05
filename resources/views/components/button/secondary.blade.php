@props(['type' => 'button', 'isLink' => false, 'href' => '#'])

@if ($isLink)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600']) }}>
        {{ $slot }}
    </a>
@else
    <button type="submit"
        {{ $attributes->merge(['class' => 'rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600']) }}>
        {{ $slot }}
    </button>
@endif
