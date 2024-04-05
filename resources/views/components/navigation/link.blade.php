@props(['route' => '#'])
<li>
    <a {{ $attributes->merge(['class' => 'text-gray-500 transition hover:text-gray-500/75']) }}
        href="{{ $route }}">
        {{ $slot }} </a>
</li>
