@props([
    'url' => '/',
    'bgClass' => 'bg-yellow-400',
    'hoverClass' => 'hover:bg-yellow-600',
    'textClass' => 'text-black',
    'icon' => null,
])

<a href={{ $url }}
    class="{{ $bgClass }} {{ $hoverClass }} {{ $textClass }} px-4 py-2 rounded hover:shadow-md transition duration-300 {{ $bgClass }}">
    @if ($icon)
        <i class="fa fa-{{ $icon }}"></i>
    @endif
    {{ $slot }}
</a>
