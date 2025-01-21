@props(['url' => '/', 'active' => false, 'icon' => null, 'mobile' => false])

@if ($mobile)
    <a href={{ $url }}
        class="block md:hidden text-white bg-blue-900 px-4 py-2 hover:bg-blue-700 pb-4 space-y-2 {{ $active ? 'text-yellow-400 font-bold  ' : '' }}">
        @if ($icon)
            <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <a href={{ $url }}
        class="hover:underline py-2 {{ $active ? 'text-yellow-400 font-bold  ' : 'text-white' }}">
        @if ($icon)
            <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@endif
