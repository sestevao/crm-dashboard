@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center p-2 text-sm font-medium leading-5 bg-blue-50 border-r-4 border-r-[#3f8cff] text-[#3f8cff] dark:text-blue-100 focus:outline-none focus:border-[#3f8cff] transition duration-150 ease-in-out'
            : 'inline-flex items-center p-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-[#3f8cff] dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
