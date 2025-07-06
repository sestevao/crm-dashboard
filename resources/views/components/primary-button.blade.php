@php
    $theme = $theme ?? 'blue'; 

    $bgBase = "bg-{$theme}-600 dark:bg-{$theme}-700";
    $hover = "hover:bg-{$theme}-700 dark:hover:bg-{$theme}-600";
    $focus = "focus:bg-{$theme}-800 dark:focus:bg-{$theme}-700";
    $active = "active:bg-{$theme}-900 dark:active:bg-{$theme}-800";
@endphp

@props([
    'theme' => 'blue',
    'textColor' => 'text-white dark:text-gray-900',
])

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => "inline-flex items-center px-4 py-2 gap-2
        {$bgBase}
        border border-transparent rounded-md font-semibold text-xs
        {$textColor}
        uppercase tracking-widest
        {$hover} {$focus} {$active}
        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
        transition ease-in-out duration-150 shadow-lg"
]) }}>
    {{ $slot }}
</button>
