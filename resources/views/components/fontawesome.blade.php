@props(['name'])

<i class="fa-solid fa-{{ $name }} {{ $attributes->get('class') }}"></i>